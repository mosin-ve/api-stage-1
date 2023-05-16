<?php
namespace App\Exceptions;

class RouteNotDefined extends \Exception
{
    protected $message = 'Error: route not defined';
    protected $code = 405;
}