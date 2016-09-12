<?php

namespace Src\Routing;

class Route
{
    public $httpMethod;
    public $regex;
    public $variables;
    public $handler;
    public $middleware;

    /**
     * Constructs a route (value object).
     *
     * @param string $httpMethod
     * @param mixed  $handler
     * @param string $regex
     * @param array  $variables
     */
    public function __construct($httpMethod, $handler, $middleware, $regex, $variables)
    {
        $this->httpMethod = $httpMethod;
        $this->handler = $handler;
        $this->middleware = $middleware;
        $this->regex = $regex;
        $this->variables = $variables;
    }

    /**
     * Tests whether this route matches the given string.
     *
     * @param string $str
     *
     * @return bool
     */
    public function matches($str)
    {
        $regex = '~^' . $this->regex . '$~';
        return (bool) preg_match($regex, $str);
    }
}

