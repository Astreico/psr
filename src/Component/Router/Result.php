<?php

namespace Component\Router;

class Result
{
    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $handler;

    /**
     * @var array
     */
    private $attributes = [];

    public function __construct($name, $handler, $attributes = [])
    {
        $this->name = $name;
        $this->handler = $handler;
        $this->attributes = $attributes;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

}
