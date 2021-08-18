<?php

namespace app\http;

class Response
{
    /**
     *
     * HTTP Status Code
     *
     * @var integer
     */
    private $code = 200;


    /**
     *
     * Response Headers
     *
     * @var array
     */
    private $headers = [];


    /**
     *
     * Response Content-Type
     *
     * @var string
     */
    private $contentType = 'text/html';


    /**
     *
     * Response content
     *
     * @var mixed
     */
    private $content;

    /**
     * @param string $code
     * @param mixed $content
     * @param string $contentType
     */
    public function __construct($code, $content, $contentType = 'text/html')
    {
        $this->code = $code;
        $this->content = $content;
        $this->setContentType($contentType);
    }

    public function setContentType($contentType)
    {
        $this->contentType = $contentType;
        $this->addHeader('Content-Type', $contentType);
    }

    public function addHeader($key, $value)
    {
        $this->headers[$key] = $value;
    }

    /**
     * Send headers to client
     *
     * @return void
     */
    protected function sendHeaders()
    {
        http_response_code($this->code);

        foreach ($this->headers as $key => $value) {
            header("$key: $value");
        }
    }

    public function send()
    {
        $this->sendHeaders();

        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                break;

            default:
                # code...
                break;
        }
    }
}
