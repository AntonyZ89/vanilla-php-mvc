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
        $this->setQueryParams($_GET ?? []);
        $this->post = $_POST ?? [];
        $this->headers = getallheaders();
        $this->method = $_SERVER['REQUEST_METHOD'] ?? '';
        $this->setUri($_SERVER['REQUEST_URI'] ?? '');
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function setUri(string $uri): void
    {
        $exUri = explode('?', $uri);

        $uri = $exUri[0];
        $params = $exUri[1] ?? [];

        $this->uri = $uri;
        $this->setQueryParams($params);
    }

    public function getUri(): string
    {
        if (preg_match("/^\/.+/", $this->uri)) {
            $this->uri = substr($this->uri, 1);
        }

        return $this->uri;
    }


    /**
     * @param string|array $params
     * @return void
     */
    public function setQueryParams($params)
    {
        if (is_string($params)) {
            $params = explode('&', $params);

            foreach ($params as $param) {
                $exParam = explode('=', $param);

                $key = $exParam[0];
                $value = $exParam[1] ?? null;

                if (!empty($key)) {
                    $this->queryParams[$key] = $value;
                }

            }
        } else {
            $this->queryParams = array_merge($this->queryParams, $params);
        }

    }

    public function getQueryParams(): array
    {
        return $this->queryParams;
    }

    /**
     * Get POST variables
     *
     * @return array|string
     */
    public function getPost($field = null, $default = null)
    {
        if ($field === null) {
            return $this->post;
        } else {
            return $this->post[$field] ?? $default;
        }
    }


    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function isPost(): bool
    {
        return $this->getMethod() === 'POST';
    }

    public function isGet(): bool
    {
        return $this->getMethod() === 'GET';
    }
}
