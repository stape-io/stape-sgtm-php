<?php

namespace Stape\Tests;

use PHPUnit\Framework\TestCase;
use Stape\Sgtm\Transforms;

class StapeSGTMTransformsTest extends TestCase
{
    public function testBase64(): void
    {
        $str = 'test';
        $this->assertEquals(\base64_encode($str), Transforms::base64($str));
    }

    public function testTrim(): void
    {
        $str = '   test   ';
        $this->assertEquals(\trim($str), Transforms::trim($str));
    }

    public function testSha256base64(): void
    {
        $str = 'test';
        $this->assertEquals(\hash('sha256', \strtolower(\base64_encode($str))), Transforms::sha256base64($str));
    }

    public function testSha256hex(): void
    {
        $str = 'test';
        $this->assertEquals(\hash('sha256', \strtolower($str)), Transforms::sha256hex($str));
    }

    public function testMd5(): void
    {
        $str = 'test';
        $this->assertEquals(\md5(\strtolower($str)), Transforms::md5($str));
    }

    public function testToLowerCase(): void
    {
        $str = 'TEST';
        $this->assertEquals(\strtolower($str), Transforms::toLowerCase($str));
    }
}
