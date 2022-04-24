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
        $setup = new Setup('https://strapi.subdomain.com/api');

        $this->assertEquals('https://strapi.subdomain.com/api', $setup->getUrl());
        $this->assertEquals(null, $setup->getToken());

        return $setup;
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
    public function testSetInvalidUrl($setup): void
    {
        $this->expectException(\InvalidArgumentException::class);
        $setup->setUrl('');
    }

    /**
     * setUrl test valid argument
     * @depends testInitConstructor
     * @covers ::setUrl
     */
    public function testSetValidUrl($setup): void
    {
        $setup->setUrl('https://strapi.subdomain.fr/api');
        $this->assertEquals('https://strapi.subdomain.fr/api', $setup->getUrl());
    }

    /**
     * setToken test invalid argument
     * @depends testInitConstructor
     * @covers ::setToken
     */
    public function testSetToken($setup): void
    {
        $setup->setToken('test');
        $this->assertEquals('test', $setup->getToken());
    }
}
