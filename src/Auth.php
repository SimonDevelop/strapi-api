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

/**
 * Class Auth
 * Authentication, register and more function.
 */
class Auth
{
    /**
     * @const url for authentication
     */
    const AUTH_URL = '/auth/local';

    /**
     * @const url for register
     */
    const REGISTER_URL = '/auth/local/register';

    /**
     * @const url for forgot password
     */
    const FORGOT_PASSWORD_URL = '/auth/forgot-password';

    /**
     * @const url for reset password
     */
    const RESET_PASSWORD_URL = '/auth/reset-password';

    /**
     * @const url for send email confirmation
     */
    const SEND_CONFIRMATION_URL = '/auth/send-email-confirmation';

    /**
     * @var Setup
     */
    private $setup;

    /**
     * @var Client
     */
    private $client;

    /**
     * @param Setup $setup
     */
    public function __construct(Setup $setup)
    {
        $this->setup = $setup;
        $this->client = new Client();
    }

    /**
     * @param string $identifier
     * @param string $password
     * @return array|string
     */
    public function authentication(string $identifier, string $password)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $response = $this->client->request('POST', $this->setup->getUrl() . self::AUTH_URL, [
                'json' => [
                    'identifier' => $identifier,
                    'password'   => $password
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
     * @param string $username
     * @param string $email
     * @param string $password
     * @return array|string
     */
    public function register(string $username, string $email, string $password)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $response = $this->client->request('POST', $this->setup->getUrl() . self::REGISTER_URL, [
                'json' => [
                    'username' => $username,
                    'email'    => $email,
                    'password' => $password
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
     * @param string $email
     * @return bool|string
     */
    public function forgotPassword(string $email)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $this->client->request('POST', $this->setup->getUrl() . self::FORGOT_PASSWORD_URL, [
                'json' => [
                    'email' => $email
                ]
            ]);

            return true;
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
     * @param string $code
     * @param string $newPassword
     * @param string $newPasswordConfirm
     * @return array|string
     */
    public function resetPassword(string $code, string $newPassword, string $newPasswordConfirm)
    {
        // Function tested with mock
        if ($newPassword !== $newPasswordConfirm) {
            throw new \InvalidArgumentException(
                'Unable to "resetPassword": $newPassword and $newPasswordConfirm are not equals'
            );
        }

        try {
            // @codeCoverageIgnoreStart
            $response = $this->client->request('POST', $this->setup->getUrl() . self::RESET_PASSWORD_URL, [
                'json' => [
                    'code' => $code,
                    'password' => $newPassword,
                    'passwordConfirmation' => $newPasswordConfirm
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
     * @param string $email
     * @return bool|string
     */
    public function sendEmailConfirmation(string $email)
    {
        // Function tested with mock
        try {
            // @codeCoverageIgnoreStart
            $this->client->request('POST', $this->setup->getUrl() . self::SEND_CONFIRMATION_URL, [
                'json' => [
                    'email' => $email
                ]
            ]);

            return true;
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
     * @return Auth
     */
    public function setSetup(Setup $setup): self
    {
        $this->setup = $setup;

        return $this;
    }
}
