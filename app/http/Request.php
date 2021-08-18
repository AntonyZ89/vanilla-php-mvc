<?php

namespace app\http;

class Request
{
    /**
     * @var string
     */
    private $method;

    /**
     * @var string
     */
    private $uri;

    /**
     * @var array
     */
    private $queryParams = [];

    /**
     * @var array
     */
    private $post = [];

    /**
     * @var array
     */
    private $headers = [];

    public function __construct()
    {
        $this->queryParams = $_GET ?? [];
        $this->post = $_POST ?? [];
        $this->headers = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->uri = $_SERVER['REQUEST_URI'] ?? '';
    }

    public function getMethod(): string
    {
        return $this->method;
    }


    public function getUri(): string
    {
        if(preg_match("/^\/.+/", $this->uri)) {
            $this->uri = substr($this->uri, 1);
        }

        return $this->uri;
    }


    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    public function getPost(): array
    {
        return $this->post;
    }


    public function getHeaders(): array
    {
        return $this->headers;
    }
}
