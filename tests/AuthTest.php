<?php

namespace SimonDevelop\Strapi\Test;

use \PHPUnit\Framework\TestCase;
use \SimonDevelop\Strapi\Setup;
use \SimonDevelop\Strapi\Auth;

/**
 * @coversDefaultClass \SimonDevelop\Strapi\Auth
 * @covers ::__construct
 */
class AuthTest extends TestCase
{
    /**
     * Constructor Setup valid
     * @uses \SimonDevelop\Strapi\Setup
     * @uses \SimonDevelop\Strapi\Auth
     * @covers ::getSetup
     * @covers ::setSetup
     */
    public function testInitConstructor(): Setup
    {
        $setup = new Setup('https://strapi.subdomain.fr/api');
        $auth = new Auth($setup);

        $this->assertEquals($setup->getUrl(), $auth->getSetup()->getUrl());
        $this->assertIsObject($auth->setSetup($setup));

        return $setup;
    }

    /**
     * authentication test
     * @depends testInitConstructor
     * @covers ::authentication
     */
    public function testAuthentication($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('authentication')
            ->with('simondevelop', 'password')
            ->willReturn([
                'jwt' => "token",
                'user' => [
                    'id' => 1,
                    'username' => "simondevelop",
                    'email' => "contact@simon-micheneau.fr",
                    'provider' => "local",
                    'confirmed' => true,
                    'blocked' => false,
                    'createdAt' => "2022-04-20T15:52:08.659Z",
                    'updatedAt' => "2022-04-22T12:39:51.479Z",
                ]
        ]);

        $this->assertEquals('token', $stub->authentication('simondevelop', 'password')['jwt']);
        $this->assertEquals(
            1,
            $stub->authentication('simondevelop', 'password')['user']['id']
        );
    }

    /**
     * authentication failed
     * @depends testInitConstructor
     * @covers ::authentication
     */
    public function testAuthenticationFailed($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('authentication')
            ->with('simondevelop', 'badPassword')
            ->willReturn('Identifier or password is incorrect');

        $this->assertEquals(
            'Identifier or password is incorrect',
            $stub->authentication('simondevelop', 'badPassword')
        );
    }

    /**
     * authentication error url
     * @depends testInitConstructor
     * @covers ::authentication
     */
    public function testAuthenticationErrorUrl($setup): void
    {
        $auth = new Auth($setup);
        $this->assertEquals(
            'Connection refused for URI ' . $setup->getUrl() . Auth::AUTH_URL,
            $auth->authentication('simondevelop', 'password')
        );
    }

    /**
     * register test
     * @depends testInitConstructor
     * @covers ::register
     */
    public function testRegister($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('register')
            ->with('simondevelop', 'contact@simon-micheneau.fr', 'password')
            ->willReturn([
                'user' => [
                    'id' => 1,
                    'username' => "simondevelop",
                    'email' => "contact@simon-micheneau.fr",
                    'provider' => "local",
                    'confirmed' => false,
                    'blocked' => false,
                    'createdAt' => "2022-04-20T15:52:08.659Z",
                    'updatedAt' => "2022-04-22T12:39:51.479Z",
                ]
        ]);

        $this->assertEquals(
            1,
            $stub->register('simondevelop', 'contact@simon-micheneau.fr', 'password')['user']['id']
        );
    }

    /**
     * register failed
     * @depends testInitConstructor
     * @covers ::register
     */
    public function testRegisterFailed($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('register')
            ->with('simondevelop', 'contact@simon-micheneau.fr', 'password')
            ->willReturn('Email is already taken');

        $this->assertEquals(
            'Email is already taken',
            $stub->register('simondevelop', 'contact@simon-micheneau.fr', 'password')
        );
    }

    /**
     * register error url
     * @depends testInitConstructor
     * @covers ::register
     */
    public function testRegisterErrorUrl($setup): void
    {
        $auth = new Auth($setup);
        $this->assertEquals(
            'Connection refused for URI ' . $setup->getUrl() . Auth::REGISTER_URL,
            $auth->register('simondevelop', 'contact@simon-micheneau.fr', 'password')
        );
    }

    /**
     * forgotPassword test
     * @depends testInitConstructor
     * @covers ::forgotPassword
     */
    public function testForgotPassword($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('forgotPassword')
            ->with('contact@simon-micheneau.fr')
            ->willReturn(true);

        $this->assertEquals(true, $stub->forgotPassword('contact@simon-micheneau.fr'));
    }

    /**
     * forgotPassword failed
     * @depends testInitConstructor
     * @covers ::forgotPassword
     */
    public function testForgotPasswordFailed($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('forgotPassword')
            ->with('contact@simon-micheneau.com')
            ->willReturn('This email does not exist');

        $this->assertEquals(
            'This email does not exist',
            $stub->forgotPassword('contact@simon-micheneau.com')
        );
    }

    /**
     * forgotPassword error url
     * @depends testInitConstructor
     * @covers ::forgotPassword
     */
    public function testForgotPasswordErrorUrl($setup): void
    {
        $auth = new Auth($setup);
        $this->assertEquals(
            'Connection refused for URI ' . $setup->getUrl() . Auth::FORGOT_PASSWORD_URL,
            $auth->forgotPassword('contact@simon-micheneau.fr')
        );
    }

    /**
     * resetPassword test
     * @depends testInitConstructor
     * @covers ::resetPassword
     */
    public function testResetPassword($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('resetPassword')
            ->with('code', 'newPassword', 'newPassword')
            ->willReturn([
                'jwt' => "token",
                'user' => [
                    'id' => 1,
                    'username' => "simondevelop",
                    'email' => "contact@simon-micheneau.fr",
                    'provider' => "local",
                    'confirmed' => true,
                    'blocked' => false,
                    'createdAt' => "2022-04-20T15:52:08.659Z",
                    'updatedAt' => "2022-04-22T12:39:51.479Z",
                ]
        ]);

        $this->assertEquals('token', $stub->resetPassword('code', 'newPassword', 'newPassword')['jwt']);
        $this->assertEquals(
            1,
            $stub->resetPassword('code', 'newPassword', 'newPassword')['user']['id']
        );
    }

    /**
     * resetPassword not equals
     * @depends testInitConstructor
     * @covers ::resetPassword
     */
    public function testResetPasswordNotEquals($setup): void
    {
        $auth = new Auth($setup);

        $this->expectException(\InvalidArgumentException::class);
        $auth->resetPassword('code', 'newPassword', 'newPasswordConfirm');
    }

    /**
     * resetPassword failed
     * @depends testInitConstructor
     * @covers ::resetPassword
     */
    public function testResetPasswordFailed($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('resetPassword')
            ->with('badCode', 'newPassword', 'newPassword')
            ->willReturn('Incorrect code provided');

        $this->assertEquals(
            'Incorrect code provided',
            $stub->resetPassword('badCode', 'newPassword', 'newPassword')
        );
    }

    /**
     * resetPassword error url
     * @depends testInitConstructor
     * @covers ::resetPassword
     */
    public function testResetPasswordErrorUrl($setup): void
    {
        $auth = new Auth($setup);
        $this->assertEquals(
            'Connection refused for URI ' . $setup->getUrl() . Auth::RESET_PASSWORD_URL,
            $auth->resetPassword('code', 'newPassword', 'newPassword')
        );
    }

    /**
     * sendEmailConfirmation test
     * @depends testInitConstructor
     * @covers ::sendEmailConfirmation
     */
    public function testSendEmailConfirmation($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('sendEmailConfirmation')
            ->with('contact@simon-micheneau.fr')
            ->willReturn(true);

        $this->assertEquals(true, $stub->sendEmailConfirmation('contact@simon-micheneau.fr'));
    }

    /**
     * sendEmailConfirmation failed
     * @depends testInitConstructor
     * @covers ::sendEmailConfirmation
     */
    public function testSendEmailConfirmationFailed($setup): void
    {
        $stub = $this->getMockBuilder(Auth::class)->setConstructorArgs([$setup])->getMock();
        $stub->method('sendEmailConfirmation')
            ->with('contact@simon-micheneau.com')
            ->willReturn('Invalid login: 535 5.7.8 Error: authentication failed');

        $this->assertEquals(
            'Invalid login: 535 5.7.8 Error: authentication failed',
            $stub->sendEmailConfirmation('contact@simon-micheneau.com')
        );
    }

    /**
     * sendEmailConfirmation error url
     * @depends testInitConstructor
     * @covers ::sendEmailConfirmation
     */
    public function testSendEmailConfirmationErrorUrl($setup): void
    {
        $auth = new Auth($setup);
        $this->assertEquals(
            'Connection refused for URI ' . $setup->getUrl() . Auth::SEND_CONFIRMATION_URL,
            $auth->sendEmailConfirmation('contact@simon-micheneau.fr')
        );
    }
}
