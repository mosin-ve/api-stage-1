<?php

namespace App\Middlewares;

use App\Api;
use App\HttpRequest;

class MethodNotAllowedMiddleware
{
public array $allowedMethods = [];
 public function __construct(Api $api)
 {
     $this->fillAllowedMethods($api);
 }
    private function fillAllowedMethods(Api $api): void
    {
        foreach ($api->getRoutes() as $method => $value) {
            if ($method !== 'GET') {
                $urls = [];
                foreach ($value as $route) {
                    $urls[] = $route->getUriPattern();
                }
                $this->allowedMethods[$method] = $urls;
            }
        }
    }

    public function checkIfMethodAllowed(HttpRequest $request): bool
    {
        if (!array_key_exists($request->get_method(), $this->allowedMethods)) {
            return false;
        }
        if (!in_array($request->get_uri(), $this->allowedMethods[$request->get_method()])) {
            return false;
        }
        return true;
    }
}