<?php
namespace Weirdan\RunWithoutXdebug;
require __DIR__ . '/../vendor/autoload.php';
(new \Composer\XdebugHandler\XdebugHandler('RUNWITHOUTXDEBUG'))->check();
