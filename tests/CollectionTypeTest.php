<?php

namespace SimonDevelop\Strapi\Test;

use \PHPUnit\Framework\TestCase;
use \SimonDevelop\Strapi\Setup;
use \SimonDevelop\Strapi\CollectionType;

/**
 * @coversDefaultClass \SimonDevelop\Strapi\CollectionType
 * @covers ::__construct
 */
class CollectionTypeTest extends TestCase
{
    /**
     * Constructor Setup valid
     * @uses \SimonDevelop\Strapi\Setup
     * @uses \SimonDevelop\Strapi\CollectionType
     * @covers ::getSetup
     * @covers ::setSetup
     */
    public function testInitConstructor(): Setup
    {
        $setup      = new Setup('https://strapi.subdomain.fr/api');
        $collection = new CollectionType($setup);

        $this->assertEquals($setup->getUrl(), $collection->getSetup()->getUrl());
        $this->assertIsObject($collection->setSetup($setup));

        return $setup;
    }

    /**
     * getter test
     * @depends testInitConstructor
     * @covers ::get
     */
    public function testGet($setup): void
    {
        $stub = $this->getMockBuilder(CollectionType::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('get')
            ->with('users')
            ->willReturn([
                [
                    'id' => 1,
                    'username' => "simondevelop",
                    'email' => "contact@simon-micheneau.fr",
                    'provider' => "local",
                    'confirmed' => true,
                    'blocked' => false,
                    'createdAt' => "2022-04-20T15:52:08.659Z",
                    'updatedAt' => "2022-04-22T12:39:51.479Z",
                ], [
                    'id' => 2,
                    'username' => "test",
                    'email' => "test@gmail.com",
                    'provider' => "local",
                    'confirmed' => true,
                    'blocked' => false,
                    'createdAt' => "2022-04-20T15:52:08.659Z",
                    'updatedAt' => "2022-04-22T12:39:51.479Z",
                ],
        ]);

        $this->assertEquals(
            1,
            $stub->get('users')[0]['id']
        );
    }

    /**
     * getter by id test
     * @depends testInitConstructor
     * @covers ::getById
     */
    public function testGetById($setup): void
    {
        $stub = $this->getMockBuilder(CollectionType::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('getById')
            ->with('users', 1)
            ->willReturn([
                'id' => 1,
                'username' => "simondevelop",
                'email' => "contact@simon-micheneau.fr",
                'provider' => "local",
                'confirmed' => true,
                'blocked' => false,
                'createdAt' => "2022-04-20T15:52:08.659Z",
                'updatedAt' => "2022-04-22T12:39:51.479Z",
        ]);

        $this->assertEquals(
            1,
            $stub->getById('users', 1)['id']
        );
    }
}
