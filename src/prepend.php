<?php
namespace Weirdan\RunWithoutXdebug;
if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // standalone
    require __DIR__ . '/../vendor/autoload.php';
} else if (file_exists(__DIR__ . '/../../../autoload.php')) {
    // global or project
    require __DIR__ . '/../../../autoload.php';
}

call_user_func(function() {
    $x = new \Composer\XdebugHandler\XdebugHandler('RWX');
    if ($logFile = getenv('RWX_DEBUG_LOG')) {
        $logger = new \Monolog\Logger('rwx', [new \Monolog\Handler\StreamHandler($logFile)]);
    } else {
        $logger = new \Psr\Log\NullLogger;
    }

    // we don't have to detect command line code as auto_prepend_file doesn't work in that case
    $mainScript = in_array($_SERVER['argv'][0], ['-', 'Standard input code'], true)
                    ? '--'
                    : $_SERVER['argv'][0];

    $logger->debug('argv[0]: ' . $_SERVER['argv'][0]);
    $logger->debug('Main script: ' . $mainScript);

    $x->setMainScript($mainScript);

    $x->setLogger($logger);
    $x->check();
});
