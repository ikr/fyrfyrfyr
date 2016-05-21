<?php

class FlipTest extends PHPUnit_Framework_TestCase
{
    public function testWorks()
    {
        $betterParseUrl = F\flip('parse_url');
        $this->assertSame('ikr.su', $betterParseUrl(PHP_URL_HOST, 'https://ikr.su/'));
    }
}