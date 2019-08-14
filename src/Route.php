<?php

namespace Quiz;

class Route
{

    /** @var string $controllerName */
    private $controllerName;

    /** @var string $functionName */
    private $functionName;

    public function __construct(string $controllerName, string $functionName = 'index')
    {
        $this->controllerName = $controllerName;
        $this->functionName = $functionName;
    }

    public function handle()
    {
        $controller = new $this->controllerName;
        $response = call_user_func([$controller, $this->functionName]);

        echo $response;
        die;
    }
}