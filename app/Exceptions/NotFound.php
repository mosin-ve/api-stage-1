<?php
namespace App\Exceptions;

class NotFound extends \Exception
{
    protected $message = 'Error: Todo not found';
    protected $code = 404;
}