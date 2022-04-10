<?php

namespace App\bootstrap;

use App\http\Controllers\Controller;
use ReflectionMethod;
use ReflectionException;

class Routing
{
    public array $uri;


    public function __construct()
    {
        $this->uri = array_filter(explode('/', explode('?', trim($_SERVER['REQUEST_URI'], '/'))[0]));
    }

    private function getControllerName()
    {
        return sizeof($this->uri) ? $this->uri[0] : 'HomeController';
    }


    private function getControllerObject()
    {
        $this->validateControllerExists();

        $this->requireController();

        $controllerNamespace = "App\\http\\Controllers\\" . $this->getControllerName();

        return new $controllerNamespace();
    }

    private function validateMethodExistsOnController()
    {
        $methodName = $this->getMethodName();

        $controllerObject = $this->getControllerObject();

        $controllerName = $this->getControllerName();

        if (!method_exists($controllerObject, $methodName)) {
            echo "method <b>$methodName</b> not exists in controller <b>$controllerName</b>";
            die();
        }
    }

    /**
     * @return string
     */
    private function getControllerPath(): string
    {
        return DOCUMENT_ROOT . '/app/http/Controllers/' . $this->getControllerName() . '.php';
    }


    private function requireController(): void
    {
        $controllerPath = $this->getControllerPath();

        require_once $controllerPath;
    }

    private function getMethodName()
    {
        return sizeof($this->uri) > 1 ? $this->uri[1] : 'index';
    }

    /**
     * @return array
     * @throws ReflectionException
     */
    private function getMethodArguments(): array
    {
        $this->validateMethodExistsOnController();

        $methodName = $this->getMethodName();

        $controllerObject = $this->getControllerObject();

        $reflectionMethod = new ReflectionMethod($controllerObject, $methodName);

        $numberOfRequiredArguments = $reflectionMethod->getNumberOfRequiredParameters();

        if (sizeof($this->uri) < 3) {
            $arguments = [];
        } else {
            unset($this->uri[0]);
            unset($this->uri[1]);

            $arguments = array_values($this->uri);
        }

        if (sizeof($arguments) < $numberOfRequiredArguments) {
            echo "arguments that has been passed are not enough for <b>$methodName</b> method";
            die();
        }


        return $arguments;


    }

    private function validateControllerExists()
    {
        $controllerName = $this->getControllerName();

        if (!file_exists($this->getControllerPath())) {
            echo "<b>$controllerName</b>  controller not found";
            die();
        }
    }

    /**
     * @throws ReflectionException
     */
    private function callMethodInController(Controller $controller, string $methodName)
    {


        $arguments = $this->getMethodArguments();

        call_user_func_array([$controller, $methodName], $arguments);
    }



    /**
     * @throws ReflectionException
     */
    public function run()
    {

        $this->validateControllerExists();

        $this->validateMethodExistsOnController();

        $controllerObject = $this->getControllerObject();

        $methodName = $this->getMethodName();


        $this->callMethodInController($controllerObject, $methodName);

    }

}