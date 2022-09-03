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

class Setup
{
    /**
     * @var string Url of strapi api (example: https://strapi.subdomain.com/api)
     */
    private $url;

    /**
     * @var string Token JWT
     */
    private $token;

    /**
     * @param string $url Url of strapi api
     * @param string $token Token JWT
     */
    public function __construct(string $url, string $token = null)
    {
        if (false === !filter_var($url, FILTER_VALIDATE_URL)) {
            $this->url = $url;
        } else {
            throw new \InvalidArgumentException('Unable build: Argument is not valid');
        }

        $this->token = $token;
    }

    /**
     * @return string Current url
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    /**
     * @param string $url of strapi api
     * @return Setup
     */
    public function setUrl(string $url): self
    {
        if (false === !filter_var($url, FILTER_VALIDATE_URL)) {
            $this->url = $url;

            return $this;
        } else {
            throw new \InvalidArgumentException('Unable to "setUrl": Argument is not valid');
        }
    }

    /**
     * @return string Current token JWT
     */
    public function getToken(): ?string
    {
        return $this->token;
    }

    /**
     * @param string|null $token JWT
     * @return Setup
     */
    public function setToken(?string $token): self
    {
        $this->token = $token;

        return $this;
    }
}
