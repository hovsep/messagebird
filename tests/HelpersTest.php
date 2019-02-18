<?php

use PHPUnit\Framework\TestCase;

/**
 * Created by PhpStorm.
 * User: hovsep
 * Date: 18.02.19
 * Time: 4:54
 */

final class HelpersTest extends TestCase {

    public function testCamelCase()
    {
        $this->assertEquals('fooBar', str_camel_case('foo_bar'));
        $this->assertEquals('fooBar', str_camel_case('foo bar'));
        $this->assertEquals('fooBar', str_camel_case('foo BAR'));
        $this->assertEquals('fooBar', str_camel_case('FOO BAR'));
        $this->assertEquals('', str_camel_case(''));
    }
}