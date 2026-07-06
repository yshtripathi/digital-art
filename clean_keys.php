<?php

if (!function_exists('__')) {
    function __($str) {
        return $str;
    }
}

$viewsPath = __DIR__ . '/resources/views';
$appPath = __DIR__ . '/app';
$enCommonPath = __DIR__ . '/resources/lang/en/common.php';
$jaCommonPath = __DIR__ . '/resources/lang/ja/common.php';

function getFiles($dir, $ext) {
    $files = [];
    $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($dir));
    foreach ($iterator as $file) {
        if ($file->isFile() && str_ends_with($file->getFilename(), $ext)) {
            $files[] = $file->getPathname();
        }
    }
    return $files;
}

$searchFiles = array_merge(getFiles($viewsPath, '.php'), getFiles($appPath, '.php'));
$allContents = '';
foreach ($searchFiles as $file) {
    $allContents .= file_get_contents($file);
}

function cleanLangFile($path, $allContents) {
    $array = include $path;
    $usedKeys = [];
    
    foreach ($array as $key => $val) {
        if (strpos($allContents, "common.{$key}") !== false) {
            $usedKeys[$key] = $val;
        }
    }
    
    // Write array using var_export and format it properly
    $export = var_export($usedKeys, true);
    // Replace array ( with [ and ) with ]
    $export = preg_replace('/^array\s*\(/m', '[', $export);
    $export = preg_replace('/^\)/m', ']', $export);
    
    $content = "<?php\n\nreturn " . $export . ";\n";
    file_put_contents($path, $content);
    return [count($array), count($usedKeys)];
}

$enCounts = cleanLangFile($enCommonPath, $allContents);
$jaCounts = cleanLangFile($jaCommonPath, $allContents);

echo "EN common.php: reduced from {$enCounts[0]} to {$enCounts[1]} keys.\n";
echo "JA common.php: reduced from {$jaCounts[0]} to {$jaCounts[1]} keys.\n";

?>
