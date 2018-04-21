<?php

$dirToParse = 'apps';
$dirIterator = new DirectoryIterator(__DIR__ . '/' . $dirToParse);

$bundledApps = [
    'comments',
    'dav',
    'federatedfilesharing',
    'federation',
    'files',
    'files_external',
    'files_sharing',
    'files_trashbin',
    'files_versions',
    'provisioning_api',
    'systemtags',
    'testing',
    'updatenotification'
];

$excludeDirs = [
    'lib/composer',
    'build',
    'apps/files_external/3rdparty'
];

foreach ($dirIterator as $fileinfo) {
    $filename = $fileinfo->getFilename();
    if ($fileinfo->isDir() && !$fileinfo->isDot() && !in_array($filename, $bundledApps)) {
        $excludeDirs[] = $dirToParse . '/' . $filename;
    }
}

$finder = PhpCsFixer\Finder::create()
    ->exclude($excludeDirs)
    ->in(__DIR__)
;

return PhpCsFixer\Config::create()
    ->setRules([
        'native_function_invocation' => true
    ])
    ->setFinder($finder)
;