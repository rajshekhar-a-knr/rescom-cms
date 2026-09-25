<?php

namespace App\Services;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use Aws\S3\S3Client;

class SchoolStorageService
{
    protected $client;
    protected $bucket;
    protected $endpoint;
    protected $disk;

    public function __construct()
    {
        $this->client = new S3Client([
            'version'     => 'latest',
            'region'      => env('DO_SPACES_REGION'),
            'endpoint'    => env('DO_SPACES_ENDPOINT'),
            'credentials' => [
                'key'    => env('DO_SPACES_KEY'),
                'secret' => env('DO_SPACES_SECRET'),
            ],
        ]);

        $this->bucket = env('DO_SPACES_NAME');
        $this->endpoint = env('DO_SPACES_PATH');
    }

    private function resolvePathForType($type)
    {
        $paths = config('dospaces.paths');
        return $paths[$type] ?? $type;
    }

    private function buildKey($schoolCode, $academicYear, $type, $filename)
    {
        $folder = $this->resolvePathForType($type);
        return "{$schoolCode}/{$academicYear}/{$folder}/{$filename}";
    }

    public function uploadFile($schoolCode, $academicYear, $type, $filePath, $filename, $acl = 'public-read')
    {
        $key = $this->buildKey($schoolCode, $academicYear, $type, $filename);

        try {
            // Check for null bytes in file path
            if (strpos($filePath, "\0") !== false) {
                throw new \Exception("File path must not contain null bytes.");
            }

            $stream = fopen($filePath, 'r');

            if (!$stream) {
                throw new \Exception("Cannot open file at path: {$filePath}");
            }

            $mime = mime_content_type($filePath);

            $this->client->putObject([
                'Bucket'      => $this->bucket,
                'Key'         => $key,
                'Body'        => $stream,
                'ACL'         => $acl,
                'ContentType' => $mime,
            ]);

            fclose($stream);

            $url = "{$this->endpoint}/{$key}";

            return [
                'success' => true,
                'key' => $key,
                'url' => $url,
            ];

        } catch (\Exception $e) {
            Log::error('Upload Failed: ' . $e->getMessage());
            return [
                'success' => false,
                'message' => 'Upload failed: ' . $e->getMessage(),
            ];
        }
    }

    public function getPresignedUrlByKey($key, $expires = 5, $forceDownload = true, $downloadFilename = null)
    {
        try {
            $disposition = $forceDownload ? 'attachment' : 'inline';
            if ($downloadFilename) {
                $disposition .= '; filename="' . basename($downloadFilename) . '"';
            }

            $params = [
                'Bucket' => $this->bucket,
                'Key'    => $key,
            ];

            // Add ResponseContentDisposition to force download when generating the presigned URL
            $params['ResponseContentDisposition'] = $disposition;

            $cmd = $this->client->getCommand('GetObject', $params);
            $request = $this->client->createPresignedRequest($cmd, "+{$expires} minutes");

            return (string) $request->getUri();
        } catch (\Exception $e) {
            Log::error('Presigned URL Error: ' . $e->getMessage());
            return false;
        }
    }

    public function getPublicUrl($schoolCode, $academicYear, $type, $filename)
    {
        $key = $this->buildKey($schoolCode, $academicYear, $type, $filename);
        return $this->disk->url($key);
    }

    public function getSignedUrl($schoolCode, $academicYear, $type, $filename, $expires = 2, $forceDownload = false)
    {
        $key = $this->buildKey($schoolCode, $academicYear, $type, $filename);
        $options = [
            'ResponseContentDisposition' => $forceDownload ? 'attachment; filename="' . $filename . '"' : 'inline',
        ];

        try {
            return $this->disk->temporaryUrl($key, now()->addMinutes($expires), $options);
        } catch (\Exception $e) {
            Log::error('Signed URL Error: ' . $e->getMessage());
            return false;
        }
    }

   

    public function deletePublicFile($schoolCode, $academicYear, $type, $fileUrl)
{
    try {
        // Extract the full key from the URL path
        $parsedPath = parse_url($fileUrl, PHP_URL_PATH);

        // Remove leading slash if present
        $key = ltrim($parsedPath, '/');

        // Perform the delete operation
        $this->client->deleteObject([
            'Bucket' => $this->bucket,
            'Key'    => $key,
        ]);

        return true;
    } catch (\Exception $e) {
        Log::error('Delete Failed: ' . $e->getMessage());
        return false;
    }
}



    public function listFiles($schoolCode, $academicYear, $type)
    {
        $prefix = $this->buildKey($schoolCode, $academicYear, $type, '');
        try {
            return $this->disk->files($prefix);
        } catch (\Exception $e) {
            Log::error('List Error: ' . $e->getMessage());
            return false;
        }
    }

    public function insertStorageDetails($emp_id, $file_name, $file_size, $file_type, $upload_status, $type)
    {
        return DB::table('storage_details_log')->insert([
            'user_id'             => $emp_id,
            'uploaded_file_name' => $file_name,
            'uploaded_file_type' => $file_type,
            'uploaded_file_size' => $file_size,
            'type'                => $type,
            'status'              => $upload_status,
            'file_status'         => 1,
        ]);
    }

    public function updateStorageDetails($file_name)
    {
        return DB::table('storage_details_log')
            ->where('uploaded_file_name', $file_name)
            ->update(['file_status' => 0]);
    }

    public function fileUploadRules($type)
    {
        $rules = config("dospaces.upload_rules");

        if (!isset($rules[$type])) {
            Log::warning("Upload rules not defined for type: $type");
            return [
                'file_rules'    => 'mimes:pdf,jpg,png,doc,xlsx,csv',
                'file_max_size' => 2048,
            ];
        }

        return [
            'file_rules'    => 'mimes:' . implode(',', $rules[$type]['types']),
            'file_max_size' => $rules[$type]['max_size'],
        ];
    }

    public function generateSafeFilename($originalName, $schoolCode)
    {
        $extension = pathinfo($originalName, PATHINFO_EXTENSION);
        $baseName = pathinfo($originalName, PATHINFO_FILENAME);

        // Sanitize base name (replace non-alphanumeric characters with underscores)
        $sanitizedBaseName = preg_replace('/[^A-Za-z0-9_\-]/', '_', $baseName);

        $uuid = $this->generateUuidV4(); // Call internal method

        return "{$schoolCode}_{$uuid}_{$sanitizedBaseName}.{$extension}";
    }

    protected function generateUuidV4()
    {
        $data = random_bytes(16);

        // Set version to 0100 (UUID v4)
        $data[6] = chr((ord($data[6]) & 0x0f) | 0x40);
        // Set variant to 10xx
        $data[8] = chr((ord($data[8]) & 0x3f) | 0x80);

        return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
    }
}