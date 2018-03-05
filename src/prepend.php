<?php
namespace Weirdan\RunWithoutXdebug;
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // standalone
    require __DIR__ . '/../vendor/autoload.php';
} else if (file_exists(__DIR__ . '/../../../vendor/autoload.php')) {
    // global or project
    require __DIR__ . '/../../../vendor/autoload.php';
}
(new \Composer\XdebugHandler\XdebugHandler('RUNWITHOUTXDEBUG'))->check();
