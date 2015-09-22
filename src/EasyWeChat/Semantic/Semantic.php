<?php

/*
 * This file is part of the EasyWeChat.
 *
 * (c) overtrue <i@overtrue.me>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

/**
 * Semantic.php.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace EasyWeChat\Semantic;

use EasyWeChat\Core\Http;
use EasyWeChat\Support\Collection;

/**
 * Class Semantic.
 */
class Semantic
{
    /**
     * Http client.
     *
     * @var Http
     */
    protected $http;

    /**
     * App id.
     *
     * @var string
     */
    protected $appId;

    const API_SEARCH = 'https://api.weixin.qq.com/semantic/semproxy/search';

    /**
     * Constructor.
     *
     * @param string $appId
     * @param Http   $http
     */
    public function __construct($appId, Http $http)
    {
        $this->appId = $appId;
        $this->http  = $http->setExpectedException(SemanticHttpException::class);
    }

    /**
     * Get the semantic content of giving string.
     *
     * @param string       $keyword
     * @param array|string $categories
     * @param array        $other
     *
     * @return Collection
     */
    public function query($keyword, $categories, array $other = [])
    {
        $params = [
                   'query'    => $keyword,
                   'category' => implode(',', (array) $categories),
                   'appid'    => $this->appId,
                  ];

        return new Collection($this->http->json(self::API_SEARCH, array_merge($params, $other)));
    }
}
