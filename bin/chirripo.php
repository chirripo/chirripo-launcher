<?php

/**
 * Launcher main function.
 */
function chirripo_launcher_main()
{
    define('CHIRRIPO_LAUNCHER_VERSION', '1.2');

    set_time_limit(0);

    $autoloaders = [
      __DIR__ . '/../../../autoload.php',
      __DIR__ . '/../vendor/autoload.php',
    ];

    foreach ($autoloaders as $file) {
        if (file_exists($file)) {
            $autoloader = $file;
            break;
        }
    }

    if (isset($autoloader)) {
        require_once $autoloader;
    } else {
        echo 'You must set up the project dependencies using `composer install`' . PHP_EOL;
        exit(1);
    }

    $var = false;
    $version = false;
    $version_launcher = false;
    $proxy_up = false;
    $proxy_down = false;
    $chirripo_version = null;

    if (isset($_SERVER['argv'][1])) {
        $arg = $_SERVER['argv'][1];
        switch ($arg) {
            case "--version":
                $version = true;
                break;
            case "--launcher-version":
                $version_launcher = true;
                break;
            case "proxy-up":
                $proxy_up = true;
                break;
            case "proxy-down":
                $proxy_down = true;
                break;
        }
    }

    if ($proxy_up || $proxy_down) {
      $command = $proxy_up ? 'chirripo-proxy up' : 'chirripo-proxy down';
      exec($command, $output, $return_var);
      if ($return_var) {
          echo 'You need to install the proxy as a global package (composer global require chirripo/chirripo-proxy) and add the bin to the $PATH variable';
          exit($return_var);
      }
      echo implode("", $output);
      exit(0);
    }

    $cwd = getcwd();
    $root = chirripo_find_project_root($cwd);

    if ($root) {
        if (file_exists("${root}/vendor/chirripo/chirripo/")) {
            require_once "${root}/vendor/chirripo/chirripo/bin/chirripo.php";

            if ($version || $version_launcher) {
                $chirripo_version = chirripo_version();
                echo "Chirripo Launcher Version: " . CHIRRIPO_LAUNCHER_VERSION . PHP_EOL;
                echo "Chirripo Version: {$chirripo_version}" . PHP_EOL;
                exit(0);
            }

            exit(chirripo_main());
        }
    } else {
        echo 'The Chirripo launcher could not find a local Chirripo in your Drupal site.' . PHP_EOL;
        echo 'Please add Chirripo with Composer to your project.' . PHP_EOL;
        echo 'Run \'composer require --dev chirripo/chirripo\' in project root' . PHP_EOL;
        exit(1);
    }
}

/**
 * Find valid project root for project using Chirripo.
 */
function chirripo_find_project_root($path)
{
    if (chirripo_is_valid_project_root($path)) {
        return $path;
    } else {
        $path = chirripo_path_up($path);
        if ($path) {
            return chirripo_find_project_root($path);
        } else {
            return null;
        }
    }
}

/**
 * Return whether given path is valid root or not.
 */
function chirripo_is_valid_project_root($path)
{
    if (file_exists($path . '/composer.json')) {
        return file_exists("${path}/vendor/chirripo/chirripo/bin/chirripo");
    }
    return false;
}

/**
 * Return path one level up.
 */
function chirripo_path_up($path)
{
    $parent = dirname($path);
    return in_array($parent, ['.', $path]) ? false : $parent;
}
