<?php

namespace Bonfim\Router;

class Response
{
    public function withJson(array $json, int $code = 200)
    {
        echo json_encode($json);
        return http_response_code($code);
    }

    public function withRedirect(string $url)
    {
        return header("Location: $url");
    }
}
