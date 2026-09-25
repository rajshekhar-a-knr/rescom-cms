<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Media;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MediaController extends Controller {
    public function index(Request $request) {
        $query = Media::orderBy('created_at','desc');
        if ($request->folder) $query->where('folder',$request->folder);
        if ($request->search) $query->where('original_name','like','%'.$request->search.'%');
        $media = $query->paginate(40);
        return view('admin.pages.media.index', compact('media'));
    }
    public function upload(Request $request) {
        $request->validate([
            'files'   => 'required_without:file|array',
            'files.*' => 'file|max:10240',
            'file'    => 'required_without:files|file|max:10240',
            'folder'  => 'nullable|string|max:100',
        ]);
        $folder = $request->folder ?? 'uploads';
        $uploaded = [];
        $files = $request->hasFile('files') ? $request->file('files') : [$request->file('file')];
        foreach ($files as $file) {
            if (!$file) continue;
            $path = upload_to_storage($file, $folder);
            $media = Media::create([
                'filename'      => basename($path),
                'original_name' => $file->getClientOriginalName(),
                'path'          => $path,
                'mime_type'     => $file->getMimeType(),
                'size'          => $file->getSize(),
                'folder'        => $folder,
                'uploaded_by'   => Auth::id(),
            ]);
            $uploaded[] = ['media' => $media, 'url' => media_url($path)];
        }
        return response()->json(['success'=>true,'items'=>$uploaded]);
    }
    public function destroy($id) {
        $media = Media::findOrFail($id);
        $storageService = app(\App\Services\SchoolStorageService::class);
        $storageService->deletePublicFile(env('COMPANY_CODE', 'SITE'), date('Y'), 'uploads', $media->path);
        $media->delete();
        return response()->json(['success'=>true]);
    }
    public function browse(Request $request) {
        $media = Media::where('mime_type','like','image/%')->orderBy('created_at','desc')->paginate(30);
        return view('admin.pages.media.browse', compact('media'));
    }
}
