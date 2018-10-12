<?php

namespace Component\Router;

use Psr\Http\Message\ServerRequestInterface;

class Route
{
    /**
     * @var
     */
    private $name;

    /**
     * @var
     */
    private $pattern;

    /**
     * @var
     */
    private $handler;

    /**
     * @var array
     */
    private $tokens = [];

    /**
     * @var array
     */
    private $methods = [];

    public function __construct($name, $pattern, $handler, $methods = [], $tokens = [])
    {
        $this->name = $name;
        $this->pattern = $pattern;
        $this->handler = $handler;
        $this->methods = $methods;
        $this->tokens = $tokens;
    }

    public function match(ServerRequestInterface $request)
    {
        if ($this->getMethods() && !in_array($request->getMethod(), $this->getMethods())) {
            return null;
        }

        $pattern = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) {
            $argument = $matches[1];
            $replace = $this->getTokens()[$argument] ?? '[^}]+';
            $res = '(?P<' . $argument . '>' . $replace . ')';
            return $res;
        }, $this->getPattern());

        if (preg_match('~^' . $pattern . '$~i', $request->getUri()->getPath(), $matches)) {
            return new Result(
                $this->getName(),
                $this->getHandler(),
                array_filter($matches, '\is_string', ARRAY_FILTER_USE_KEY)
            );
        }
        return null;
    }

    public function generate($name, $params = [])
    {
        if ($this->getName() != $name) {
            return null;
        }

        $url = preg_replace_callback('~\{([^\}]+)\}~', function ($matches) use(&$params) {
            $argument = $matches[1];
            if (!array_key_exists($argument, $params)) {
                throw new \InvalidArgumentException("Missing parameter {$argument}");
            }
            return $params[$argument];
        }, $this->getPattern());

        if ($url !== null) {
            return $url;
        }
        return null;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     * @return $this
     */
    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getPattern()
    {
        return $this->pattern;
    }

    /**
     * @param mixed $pattern
     * @return $this
     */
    public function setPattern($pattern)
    {
        $this->pattern = $pattern;
        return $this;
    }

    /**
     * @return mixed
     */
    public function getHandler()
    {
        return $this->handler;
    }

    /**
     * @param mixed $handler
     * @return $this
     */
    public function setHandler($handler)
    {
        $this->handler = $handler;
        return $this;
    }

    /**
     * @return array
     */
    public function getTokens(): array
    {
        return $this->tokens;
    }

    /**
     * @param array $tokens
     * @return $this
     */
    public function setTokens(array $tokens)
    {
        $this->tokens = $tokens;
        return $this;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     * @return $this
     */
    public function setMethods(array $methods)
    {
        $this->methods = $methods;
        return $this;
    }


}
