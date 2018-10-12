<?php

namespace Component\Router\Exception;

class RouteNotFoundException extends \LogicException
{
    private $name;
    private $params = [];

    public function __construct($name, $params)
    {
        parent::__construct("Route {$name} not found.");
        $this->name = $name;
        $this->params = $params;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return array|int
     */
    public function getParams()
    {
        return $this->params;
    }

}