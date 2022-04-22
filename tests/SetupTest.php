<?php

namespace SimonDevelop\Strapi\Test;

use \PHPUnit\Framework\TestCase;
use \SimonDevelop\Strapi\Setup;

/**
 * @coversDefaultClass \SimonDevelop\Strapi\Setup
 * @covers ::__construct
 */
class SetupTest extends TestCase
{
    /**
     * Constructor test
     * @covers ::getUrl
     * @covers ::getToken
     * @uses \SimonDevelop\Strapi\Setup
     */
    public function testInitConstructor(): Setup
    {
        $Setup = new Setup('https://strapi.subdomain.com/api');
        $this->assertEquals('https://strapi.subdomain.com/api', $Setup->getUrl());
        $this->assertEquals(null, $Setup->getToken());
        return $Setup;
    }

    /**
     * Constructor test invalid argument
     * @uses \SimonDevelop\Strapi\Setup
     */
    public function testInitConstructorInvalidUrl(): void
    {
        $this->expectException(\InvalidArgumentException::class);
        new Setup('');
    }

    /**
     * setUrl test invalid argument
     * @depends testInitConstructor
     * @covers ::setUrl
     */
    public function testSetInvalidUrl($Setup): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $Setup->setUrl('');
    }

    /**
     * setUrl test valid argument
     * @depends testInitConstructor
     * @covers ::setUrl
     */
    public function testSetValidUrl($Setup): void
    {
        $Setup->setUrl('https://strapi.subdomain.fr/api');
        $this->assertEquals('https://strapi.subdomain.fr/api', $Setup->getUrl());
    }

    /**
     * setToken test invalid argument
     * @depends testInitConstructor
     * @covers ::setToken
     */
    public function testSetToken($Setup): void
    {
        $Setup->setToken('test');
        $this->assertEquals('test', $Setup->getToken());
    }
}
