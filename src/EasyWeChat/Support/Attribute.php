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
 *Attributes.php.
 *
 * @author    overtrue <i@overtrue.me>
 * @copyright 2015 overtrue <i@overtrue.me>
 *
 * @link      https://github.com/overtrue
 * @link      http://overtrue.me
 */

namespace EasyWeChat\Support;

use InvalidArgumentException;

/**
 * Class Attributes.
 */
abstract class Attribute extends Collection
{
    /**
     * Attributes alias.
     *
     * @var array
     */
    protected $aliases = [];

    /**
     * Constructor.
     *
     * @param array $attributes
     */
    public function __construct($attributes = [])
    {
        parent::__construct($attributes);
    }

    /**
     * Set attribute.
     *
     * @param string $attribute
     * @param string $value
     *
     * @return Attribute
     */
    public function setAttribute($attribute, $value)
    {
        $this->add($attribute, $value);

        return $this;
    }

    /**
     * Get attribute.
     *
     * @param string $attribute
     * @param mixed  $default
     *
     * @return mixed
     */
    public function getAttribute($attribute, $default)
    {
        return $this->get($attribute, $default);
    }

    /**
     * Set attribute.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return Attribute
     */
    public function with($attribute, $value)
    {
        $attribute = Str::snake($attribute);

        if (!$this->validate($attribute, $value)) {
            throw new InvalidArgumentException("Invalid attribute '{$attribute}'.");
        }

        $this->set($attribute, $value);

        return $this;
    }

    /**
     * Attribute validation.
     *
     * @param string $attribute
     * @param mixed  $value
     *
     * @return bool
     */
    protected function validate($attribute, $value)
    {
        return true;
    }

    /**
     * Override parent set() method.
     *
     * @param string $attribute
     * @param mixed  $value
     */
    public function set($attribute, $value = null)
    {
        if ($alias = array_search($attribute, $this->aliases, true)) {
            $attribute = $alias;
        }

        return parent::set($attribute, $value);
    }

    /**
     * Override parent get() method.
     *
     * @param string $attribute
     * @param mixed  $default
     */
    public function get($attribute, $default = null)
    {
        if ($alias = array_search($attribute, $this->aliases, true)) {
            $attribute = $alias;
        }

        return parent::get($attribute, $default);
    }

    /**
     * Magic call.
     *
     * @param string $method
     * @param array  $args
     *
     * @return Attribute
     */
    public function __call($method, $args)
    {
        if (stripos($method, 'with') === 0) {
            $method = substr($method, 4);
        }

        return $this->with($method, array_shift($args));
    }

    /**
     * Magic set.
     *
     * @param string $property
     * @param mixed  $value
     *
     * @return Attribute
     */
    public function __set($property, $value)
    {
        return $this->with($property, $value);
    }
}
