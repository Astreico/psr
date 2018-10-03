<?php

namespace Component\Http;

class Response
{

    /**
     * @var array
     */
    private $headers = [];

    /**
     * @var int
     */
    private $statusCode;

    /**
     * @var string
     */
    private $reasonPhrase;

    /**
     * @var string
     */
    private $content = [];

    public static $phrases = [
        200 => 'OK',
        301 => 'Moved Permanently',
        400 => 'Bad Request',
        403 => 'Forbidden',
        404 => 'Not Found',
        500 => 'Internal Server Error',
    ];

    public function __construct($content = '', $status = 200)
    {
        $this->statusCode = $status;
        $this->content = $content;
    }

    /**
     * @return array
     */
    public function getHeaders(): array
    {
        return $this->headers;
    }

    /**
     * @param array $headers
     */
    public function setHeaders(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return int
     */
    public function getStatusCode(): int
    {
        return $this->statusCode;
    }

    /**
     * @param int $statusCode
     */
    public function setStatusCode(int $statusCode)
    {
        $this->statusCode = $statusCode;
    }

    /**
     * @return string
     */
    public function getReasonPhrase(): string
    {
        if (!$this->reasonPhrase && isset(self::$phrases[$this->statusCode])) {
            $this->reasonPhrase = self::$phrases[$this->statusCode];
        }
        return $this->reasonPhrase;
    }

    /**
     * @return string
     */
    public function getContent(): string
    {
        return $this->content;
    }

    /**
     * @param string $content
     */
    public function setContent(string $content)
    {
        $this->content = $content;
    }

    /**
     * @return bool
     */
    public function hasHeader($header)
    {
        return isset($this->headers[$header]);
    }

    /**
     * @param string $header
     * @param string $value
     * @return $this
     */
    public function setHeader(string $header, string $value)
    {
        $this->headers[$header] = $value;
        return $this;
    }

    /**
     * @param string $header
     * @return string
     */
    public function getHeader(string $header)
    {
        return $this->hasHeader($header) ? $this->headers[$header] : '';
    }



}