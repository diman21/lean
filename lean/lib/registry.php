<?php
namespace lean;
/*
 * Copyright (C) 2012 Michael Saller
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated
 * documentation files (the "Software"), to deal in the Software without restriction, including without limitation
 * the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software,
 * and to permit persons to whom the Software is furnished to do so, subject to the following conditions:
 * The above copyright notice and this permission notice shall be included in all copies or substantial portions
 * of the Software.
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO
 * THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF
 * CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
 * OTHER DEALINGS IN THE SOFTWARE.
 */

/**
 *
 */
class Registry extends Registry_State {
    const NAMESPACE_SEPARATOR = '\\';

    private static $instances = [];

    /**
     * @return static
     */
    public static function instance() {
        return isset(self::$instances[__NAMESPACE__ . self::NAMESPACE_SEPARATOR . __CLASS__])
            ? self::$instances[__NAMESPACE__ . self::NAMESPACE_SEPARATOR . __CLASS__]
            : self::$instances[__NAMESPACE__ . self::NAMESPACE_SEPARATOR . __CLASS__] = new self();
    }
}

/**
 * Provides the actual registration state
 */
class Registry_State {
    /**
     * @var array
     */
    private $components;

    public function __construct() {
        $this->components = array();
    }
    public function set($name, $component) {
        $this->components[$name] = $component;
    }
    public function get($name) {
        return $this->components[$name];
    }
}
