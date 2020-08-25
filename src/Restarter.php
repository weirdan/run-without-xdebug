<?php

namespace Weirdan\RunWithoutXdebug;

use Composer\XdebugHandler\XdebugHandler;

class Restarter extends XdebugHandler
{
    /** @param string $command */
    protected function restart($command)
    {
        assert(null !== $this->tmpIni);
        $contents = file_get_contents($this->tmpIni);
        $contents = preg_replace('/^auto_prepend_file="' . preg_quote(__DIR__ . '/prepend.php', '/') . '"/m', '', $contents, -1, $count);
        var_dump($count);
        file_put_contents($this->tmpIni, $contents);
        parent::restart($command);
    }
}
