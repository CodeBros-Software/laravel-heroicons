<?php

$iconsSource = __DIR__.'/../icons/src';
$outputDir = __DIR__.'/../resources/views/components';

if (! is_dir($iconsSource)) {
    die('Icons source directory not found: '.$iconsSource);
}

// Clean existing generated blade files (keep icon.blade.php)
foreach (['16', '20', '24', 'solid', 'outline'] as $subDir) {
    $path = $outputDir.'/'.$subDir;
    if (is_dir($path)) {
        $files = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($path, RecursiveDirectoryIterator::SKIP_DOTS),
            RecursiveIteratorIterator::CHILD_FIRST
        );
        foreach ($files as $file) {
            $file->isDir() ? rmdir($file->getPathname()) : unlink($file->getPathname());
        }
        rmdir($path);
    }
}

$sizeClassMap = [
    '16' => 'size-4',
    '20' => 'size-5',
    '24' => 'size-6',
];

// Process all icon sizes and styles
$sizes = new DirectoryIterator($iconsSource);
foreach ($sizes as $sizeDir) {
    if (! $sizeDir->isDir() || $sizeDir->isDot()) {
        continue;
    }

    $size = $sizeDir->getFilename();
    $sizeClass = $sizeClassMap[$size] ?? 'size-6';

    $styles = new DirectoryIterator($sizeDir->getPathname());
    foreach ($styles as $styleDir) {
        if (! $styleDir->isDir() || $styleDir->isDot()) {
            continue;
        }

        $style = $styleDir->getFilename();
        $targetDir = $outputDir.'/'.$size.'/'.$style;

        if (! is_dir($targetDir)) {
            mkdir($targetDir, 0755, true);
        }

        $svgFiles = glob($styleDir->getPathname().'/*.svg');
        foreach ($svgFiles as $svgFile) {
            $name = basename($svgFile, '.svg');
            $content = file_get_contents($svgFile);

            // Add Blade attributes merge with appropriate size class
            $content = preg_replace(
                '/<svg\b/',
                '<svg {{ $attributes->merge([\'class\' => \''.$sizeClass.'\']) }}',
                $content,
                1
            );

            // Replace hardcoded fill colors with currentColor (preserve fill="none")
            $content = preg_replace('/fill="(?!none|currentColor)[^"]*"/', 'fill="currentColor"', $content);

            // Replace hardcoded stroke colors with currentColor (preserve stroke="none")
            $content = preg_replace('/stroke="(?!none|currentColor)[^"]*"/', 'stroke="currentColor"', $content);

            $bladePath = $targetDir.'/'.$name.'.blade.php';
            if (file_put_contents($bladePath, $content) !== false) {
                echo 'Generated: '.$size.'/'.$style.'/'.$name.'.blade.php'.PHP_EOL;
            } else {
                echo 'Error: '.$svgFile.PHP_EOL;
            }
        }

        // Create backward-compatible aliases for 24px icons (solid/ and outline/)
        if ($size === '24') {
            $aliasDir = $outputDir.'/'.$style;
            if (! is_dir($aliasDir)) {
                mkdir($aliasDir, 0755, true);
            }

            $bladeFiles = glob($targetDir.'/*.blade.php');
            foreach ($bladeFiles as $bladeFile) {
                $aliasPath = $aliasDir.'/'.basename($bladeFile);
                copy($bladeFile, $aliasPath);
            }
            echo 'Created backward-compatible aliases: '.$style.'/'.PHP_EOL;
        }
    }
}

echo PHP_EOL.'Done! Icons generated successfully.'.PHP_EOL;
