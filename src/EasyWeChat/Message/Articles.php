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
 * Articles.php.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace EasyWeChat\Message;

use Closure;

/**
 * Class Articles.
 */
class Articles extends AbstractMessage
{
    /**
     * Message type.
     *
     * @var string
     */
    protected $type = 'news';

    /**
     * Properties.
     *
     * @var array
     */
    protected $items = [];

    /**
     * Constructor.
     *
     * @param array $items
     */
    public function __construct(array $items = [])
    {
        if (!empty($items)) {
            $this->items($items);
        }
    }

    /**
     * Add article.
     *
     * @param Article $item
     *
     * @return News
     */
    public function item(Article $item)
    {
        array_push($this->items, $item);

        return $this;
    }

    /**
     * Set articles.
     *
     * @param array|Closure $items
     *
     * @return News
     */
    public function items($items)
    {
        if ($items instanceof Closure) {
            $items = $items();
        }

        array_map([$this, 'item'], (array) $items);

        return $this;
    }

    /**
     * Return all items.
     *
     * @return array
     */
    public function getItems()
    {
        return $this->items;
    }

    /**
     * Clean items.
     */
    public function clean()
    {
        $this->items = [];
    }
}
