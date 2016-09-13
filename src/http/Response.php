<?php

namespace Src\Http;

interface Response
{
    public function setStatusCode($statusCode, $statusText = null);

    public function getStatusCode();

    public function addHeader($name, $value);

    public function setHeader($name, $value);

    public function getHeaders();

    public function addCookie(Cookie $cookie);

    public function deleteCookie($cookie);

    public function getCookies();

    public function setContent($content);

    public function getContent();

    public function redirect($url);
}