<?php
// File: /home/felix/Apola/PI/App/Core/Config.php

namespace App\Core;

use Dotenv\Dotenv;
use RuntimeException;



class SessionManager {
    public static function start(): void {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
}

class Config
{
    private static bool $initialized = false;
    private static array $settings = [];

    public static function initialize(): void
    {
        if (!self::$initialized) {
            $rootPath = dirname(__DIR__, 2); // /home/felix/Apola/PI

            // Load .env if exists
            if (!file_exists($rootPath . '/.env')) {
                throw new RuntimeException('.env file not found at ' . $rootPath);
            }

            $dotenv = Dotenv::createImmutable($rootPath);
            $dotenv->safeLoad();

            // Validate .env values
            $dotenv->required([
                'DB_HOST',
                'DB_DATABASE',
                'DB_USERNAME',
                'DB_PASSWORD'
            ])->notEmpty();

            // Define custom project paths
            self::$settings = [
                'ROOT_PATH'   => $rootPath,
                'VIEW_PATH'   => $rootPath . '/Pages/user/',
                'ASSET_PATH'  => $rootPath . '/public/assets/',
                'UPLOAD_PATH' => $rootPath . '/storage/uploads/',
                'TEMPLATE_EXT' => '.php'
            ];

            self::$initialized = true;
        }
    }

    public static function get(string $key, mixed $default = null): mixed
    {
        self::initialize();

        // First check in project-defined settings
        if (isset(self::$settings[$key])) {
            return self::$settings[$key];
        }

        // Then check in .env
        return $_ENV[$key] ?? $default;
    }
}

