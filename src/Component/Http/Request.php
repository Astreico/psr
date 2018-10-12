<?php

namespace Component\Http;

class Request
{

    /**
     * @var array
     */
    private $query = [];

    /**
     * @var array
     */
    private $body = [];

    /**
     * @param array $query
     * @param array $body
     * @return $this
     */
    public static function createFromGlobals($query = [], $body = [])
    {
        return (new self())
                ->setQuery($query)
                ->setBody($body);
    }

    /**
     * @return array
     */
    public function getQuery(): array
    {
        return $this->query;
    }

    /**
     * @param array $query
     * @return $this
     */
    public function setQuery(array $query)
    {
        $this->query = $query;
        return $this;
    }

    /**
     * @return array
     */
    public function getBody(): array
    {
        return $this->body;
    }

    /**
     * @param array $body
     * @return $this
     */
    public function setBody(array $body)
    {
        $this->body = $body;
        return $this;
    }
}
