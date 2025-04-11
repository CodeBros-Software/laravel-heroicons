<?php

$directory = __DIR__.'/../resources/views/components';

if (! is_dir($directory)) {
    die('Directory not found: ' . $directory);
}

// Recursive retrieve all SVG files
$files = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

foreach ($files as $file) {
    if ($file->isFile() && $file->getExtension() === 'svg') {
        $oldPath = $file->getPathname();
        $newPath = $file->getPath().'/'.$file->getBasename('.svg').'.blade.php';

        // Read the file content
        $content = file_get_contents($oldPath);

        // Replace <svg with <svg {{ $attributes->merge() }}
        $updatedContent = str_replace('<svg', '<svg {{ $attributes->merge([\'class\' => \'size-6\']) }}', $content);

        // Write the updated content to the new file
        if (file_put_contents($newPath, $updatedContent) !== false) {
            // Remove the old file
            unlink($oldPath);
            echo 'Updated and renamed: ' . $newPath . PHP_EOL;
        } else {
            echo 'Error updating: ' . $oldPath . PHP_EOL;
        }
    }
}