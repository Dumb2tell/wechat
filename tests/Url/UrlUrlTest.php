<?php

/*
 * This file is part of the EasyWeChat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

use EasyWeChat\Url\Url;

class UrlUrlTest extends TestCase
{
    /**
     * Test shorten().
     */
    public function testShorten()
    {
        $http = Mockery::mock(EasyWeChat\Core\Http::class);
        $http->shouldReceive('setExpectedException')->andReturn($http);
        $http->shouldReceive('json')->andReturnUsing(function ($api, $params) {
            return ['short_url' => $params['long_url']];
        });

        $url = new Url($http);

        $this->assertEquals('http://easywechat.org', $url->shorten('http://easywechat.org'));
    }
}
