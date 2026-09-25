<?php
$dir = __DIR__ . '/../public/presentations';
if (!is_dir($dir)) {
    mkdir($dir, 0777, true);
}

foreach (glob($dir . '/*.html') as $file) {
    $baseName = basename($file, '.html');
    copy($file, $dir . '/' . $baseName);
    if (str_ends_with($baseName, '-presentation')) {
        $short = substr($baseName, 0, -13);
        copy($file, $dir . '/' . $short);
    }
}

echo "All aliases generated successfully in public/presentations!\n";
