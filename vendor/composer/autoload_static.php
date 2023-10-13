<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf64c3bf68a90012faa6ca6861860eae2
{
    public static $prefixLengthsPsr4 = array (
        'L' => 
        array (
            'LazyCode404\\laravelwebinstaller\\' => 32,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'LazyCode404\\laravelwebinstaller\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf64c3bf68a90012faa6ca6861860eae2::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf64c3bf68a90012faa6ca6861860eae2::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf64c3bf68a90012faa6ca6861860eae2::$classMap;

        }, null, ClassLoader::class);
    }
}
