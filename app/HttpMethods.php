<?php

namespace App;

enum HttpMethods: string
{
   case POST = 'POST';
   case GET = 'GET';
   case PUT = 'PUT';
   case DELETE = 'DELETE';
   case HOST = 'HTTP_HOST';
}
