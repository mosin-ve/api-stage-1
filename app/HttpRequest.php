<?php

namespace App;

class HttpRequest
{
    private HttpMethods $method;
    private array $params;

    private mixed $body = [];

    private string $uri;


    /**
     * @param HttpMethods $method
     * @param array $params
     * @param mixed $body
     */
    public function __construct()
    {
        $this->method = HttpMethods::from($_SERVER['REQUEST_METHOD']);
        $this->uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        parse_str(file_get_contents("php://input"),$put_body);
        $this->body =  $put_body ?: $_POST;
        $this->host = 'http://'.$_SERVER['HTTP_HOST'].'/';
    }

    /**
     * @return string
     */
    public function get_method(): string
    {
        return $this->method->value;
    }

    /**
     * @return array
     */
    public function get_params(): array
    {
        return $this->params;
    }

    /**
     * @return mixed
     */
    public function get_body(): mixed
    {
        return $this->body;
    }

    /**
     * @return string
     */
    public function get_uri(): string
    {
        return $this->uri;
    }

    /**
     * @param array $params
     */
    public function set_params(array $params): void
    {
        $this->params = $params;
    }
}
