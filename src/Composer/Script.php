<?php

/**
 * Created by PhpStorm.
 * User: cg
 * Date: 2018/7/20
 * Time: 17:17
 */

namespace Skreh\Composer;

class Script
{
    const ASSETS_DIR = 'assets';
    const BIN_DIR = 'bin';
    const CONFIG_DIR = 'config';
    const PUBLIC_DIR = 'public';
    const TEMPLATES_DIR = 'templates';
    const TESTS_DIR = 'tests';
    const TRANSLATIONS_DIR = 'translations';
    const VAR_DIR = 'var';

    public static function test()
    {
        $project_dir = dirname(dirname(__DIR__));
        echo $project_dir;
    }

    public static function preUpdate()
    {

        $project_dir = dirname(dirname(__DIR__));

        self::checkDir($project_dir . '\\' . self::ASSETS_DIR);
        self::checkDir($project_dir . '\\' . self::BIN_DIR);
        self::checkDir($project_dir . '\\' . self::CONFIG_DIR);
        self::checkDir($project_dir . '\\' . self::PUBLIC_DIR);
        self::checkDir($project_dir . '\\' . self::TEMPLATES_DIR);
        self::checkDir($project_dir . '\\' . self::TESTS_DIR);
        self::checkDir($project_dir . '\\' . self::TRANSLATIONS_DIR);
        self::checkDir($project_dir . '\\' . self::VAR_DIR);

    }

    public static function postUpdate(Event $event)
    {
        echo 'ok';
        $composer = $event->getComposer();

        $project_dir = dirname(dirname(__DIR__));
        $assets_dir = $project_dir . '/' . self::ASSETS_DIR;
        is_dir($assets_dir) ?? mkdir($assets_dir);

    }

    public static function postPackageInstall(Event $event)
    {
        $installedPackage = $event->getOperation()
                                  ->getPackage();
        // do stuff
    }

    public static function warmCache(Event $event)
    {
        // make cache toasty
    }

    public static function checkDir($dir, int $permission=null)
    {
        if (!is_dir($dir)){
            mkdir($dir);
        }
        $permission = $permission==null ?? 077;
        if ($permission == null){
            $permission = 770;
        }
        chmod($dir, $permission);
    }
}