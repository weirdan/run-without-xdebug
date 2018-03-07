<?php
namespace Weirdan\RunWithoutXdebug\Tests\Integration;

use PHPUnit\Framework\TestCase;

class PHPUnitTest extends TestCase
{
    public function testNoXdebugWithoutIsolation()
    {
        $this->assertFalse(extension_loaded("xdebug"));
    }

    /**
     * @runInSeparateProcess
     */
    public function testNoXdebugWithIsolation()
    {
        $this->assertFalse(extension_loaded("xdebug"));
    }
}
