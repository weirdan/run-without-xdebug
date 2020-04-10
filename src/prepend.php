<?php

namespace Weirdan\RunWithoutXdebug;

if (file_exists(__DIR__ . '/../vendor/autoload.php')) {
    // standalone
    require __DIR__ . '/../vendor/autoload.php';
} elseif (file_exists(__DIR__ . '/../../../autoload.php')) {
    // global or project
    require __DIR__ . '/../../../autoload.php';
}

call_user_func(function () {
    $x = new \Composer\XdebugHandler\XdebugHandler('RWX');
    if ($logFile = getenv('RWX_DEBUG_LOG')) {
        if (!class_exists(Logger::class, false)) {
            class Logger extends \Psr\Log\AbstractLogger
            {
                private $filename;
                public function __construct($filename)
                {
                    $this->filename = $filename;
                }
                public function log($level, $message, array $context = array())
                {
                    $formatted = '[' . $level . '] '
                        . $message
                        . " : "
                        . strtr(var_export($context, true), ["\r" => '', "\n" => ''])
                        . PHP_EOL;
                    file_put_contents($this->filename, $formatted, FILE_APPEND);
                }
            }
        }
        $logger = new Logger($logFile);
    } else {
        $logger = new \Psr\Log\NullLogger();
    }

    // we don't have to detect command line code as auto_prepend_file doesn't work in that case
    $mainScript = in_array($_SERVER['argv'][0], ['-', 'Standard input code'], true)
                    ? '--'
                    : $_SERVER['argv'][0];

    $logger->debug('argv[0]: ' . $_SERVER['argv'][0]);
    $logger->debug('Main script: ' . $mainScript);

    $x
        ->setMainScript($mainScript)
        ->setPersistent()
        ->setLogger($logger)
        ->check();
});
