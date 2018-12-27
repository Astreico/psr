<?php

namespace Component\Container;


use Psr\Container\ContainerInterface;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private $definitions = [];
    /**
     * @var array
     */
    private $results = [];

    public function __construct($config)
    {
        $this->definitions = $config;
    }

    public function get($id)
    {
        if (array_key_exists($id, $this->results)) {
            return $this->results[$id];
        }
        if (!array_key_exists($id, $this->definitions)) {
            if (class_exists($id)) {
                $object = new $id();
                $this->results[$id] = $object;
                return $object;
            }
            throw new \Exception('Invalid parameter ' . $id);
        }
        $definition = $this->definitions[$id] instanceof \Closure ? $this->definitions[$id]($this) : $this->definitions[$id];
        $this->results[$id] = $definition;
        return $definition;
    }

    public function set($id, $value)
    {
        if (array_key_exists($id, $this->results)) {
            unset($this->results[$id]);
        }
        $this->definitions[$id] = $value;
    }

    public function has($id)
    {
        return (in_array($id, $this->definitions) || class_exists($id));
    }
}