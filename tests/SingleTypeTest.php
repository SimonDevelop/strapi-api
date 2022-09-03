<?php

namespace SimonDevelop\Strapi\Test;

use \PHPUnit\Framework\TestCase;
use \SimonDevelop\Strapi\Setup;
use \SimonDevelop\Strapi\SingleType;

/**
 * @coversDefaultClass \SimonDevelop\Strapi\SingleType
 * @covers ::__construct
 */
class SingleTypeTest extends TestCase
{
    /**
     * Constructor Setup valid
     * @uses \SimonDevelop\Strapi\Setup
     * @uses \SimonDevelop\Strapi\SingleType
     * @covers ::getSetup
     * @covers ::setSetup
     */
    public function testInitConstructor(): Setup
    {
        $setup  = new Setup('https://strapi.subdomain.fr/api');
        $single = new SingleType($setup);

        $this->assertEquals($setup->getUrl(), $single->getSetup()->getUrl());
        $this->assertIsObject($single->setSetup($setup));

        return $setup;
    }

    /**
     * getter test
     * @depends testInitConstructor
     * @covers ::get
     */
    public function testGet($setup): void
    {
        $stub = $this->getMockBuilder(SingleType::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('get')
            ->with('homepage')
            ->willReturn([
                'data' => [
                    'id' => 1,
                    'attributes' => [
                        'content'     => '<h1>title of page</h1>',
                        'createdAt'   => '2022-04-27T15:17:07.028Z',
                        'updatedAt'   => '2022-04-27T15:17:07.028Z',
                        'publishedAt' => '2022-04-27T15:17:07.028Z',
                        'locale'      => 'en',
                    ]
                ],
                'meta' => []
        ]);

        $this->assertEquals(
            '<h1>title of page</h1>',
            $stub->get('homepage')['data']['attributes']['content']
        );
    }
}
