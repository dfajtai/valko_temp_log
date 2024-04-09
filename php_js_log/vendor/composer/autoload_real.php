<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInitd92e8dddd9bb15eeabddf0335c66a39d
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        require __DIR__ . '/platform_check.php';

        spl_autoload_register(array('ComposerAutoloaderInitd92e8dddd9bb15eeabddf0335c66a39d', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInitd92e8dddd9bb15eeabddf0335c66a39d', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInitd92e8dddd9bb15eeabddf0335c66a39d::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}