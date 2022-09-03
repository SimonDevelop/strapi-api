<?php

/*
 * This file is the strapi-api package.
 *
 * (c) Simon Micheneau <contact@simon-micheneau.fr>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace SimonDevelop\Strapi;

use SimonDevelop\Strapi\Setup;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;

class CollectionType
{
    /**
     * @var Setup
     */
    private Setup $setup;

    /**
     * @var Client
     */
    private Client $client;

    /**
     * @param Setup $setup
     */
    public function __construct(Setup $setup)
    {
        $this->setup  = $setup;
        $this->client = new Client();
    }

    /**
     * @param string $collection
     * @return array|string
     */
    public function get(string $collection)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $response = $this->client->request('GET', $this->setup->getUrl() . "/$collection", [
                'headers' => [
                    'authorization' => 'Bearer '.$this->setup->getToken()
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
            // @codeCoverageIgnoreEnd
        } catch (ClientException $e) {
            // @codeCoverageIgnoreStart
            $json = json_decode($e->getResponse()->getBody()->getContents(), true);

            return $json['error']['message'];
            // @codeCoverageIgnoreEnd
        } catch (ConnectException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @param string $collection
     * @param int    $id
     * @return array|string
     */
    public function getById(string $collection, int $id)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $response = $this->client->request('GET', $this->setup->getUrl() . "/$collection/$id", [
                'headers' => [
                    'authorization' => 'Bearer '.$this->setup->getToken()
                ]
            ]);

            return json_decode($response->getBody()->getContents(), true);
            // @codeCoverageIgnoreEnd
        } catch (ClientException $e) {
            // @codeCoverageIgnoreStart
            $json = json_decode($e->getResponse()->getBody()->getContents(), true);

            return $json['error']['message'];
            // @codeCoverageIgnoreEnd
        } catch (ConnectException $e) {
            return $e->getMessage();
        }
    }

    /**
     * @return Setup Current setup
     */
    public function getSetup(): Setup
    {
        return $this->setup;
    }

    /**
     * @param Setup $setup
     * @return CollectionType
     */
    public function setSetup(Setup $setup): self
    {
        $this->setup = $setup;

        return $this;
    }
}
