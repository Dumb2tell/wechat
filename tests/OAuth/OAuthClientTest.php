<?php

/*
 * This file is part of the EasyWeChat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use EasyWeChat\OAuth\User;

class OAuthUserTest extends TestCase
{
    /**
     * Test getOpenId().
     */
    public function testGetOpenId()
    {
        $user = new User(['openid' => 'foo']);

        $this->assertEquals('foo', $user->getOpenId());
    }

    /**
     * Test getNickname().
     */
    public function testGetNickName()
    {
        $user = new User(['nickname' => 'foo']);

        $this->assertEquals('foo', $user->getNickname());
        $this->assertEquals('foo', $user->getUsername());
        $this->assertEquals('foo', $user->getName());
    }

    /**
     * Test getAvatar().
     */
    public function testGetAvatar()
    {
        $user = new User(['headimgurl' => 'foo']);

        $this->assertEquals('foo', $user->getAvatar());
    }

    /**
     * Test setToken() and getToken().
     */
    public function testTokenGetterAndSetter()
    {
        $user = new User();
        $user->setToken('foo');

        $this->assertEquals('foo', $user->getToken());
        $this->assertEquals('foo', $user->getAccessToken());
    }

    /**
     * Test setRefreshToken() and getRefreshToken().
     */
    public function testRefreshTokenGetterAndSetter()
    {
        $user = new User();
        $user->setRefreshToken('foo');

        $this->assertEquals('foo', $user->getRefreshToken());
    }
}
