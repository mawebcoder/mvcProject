<?php

namespace App\http\Controllers;

class Controller
{

    protected function view(string $view, $data = [])
    {

        if (sizeof($data)) {
            extract($data);
        }

        $this->checkViewExists($view);

        $viewPath = $this->getViewPath($view);

        require_once $viewPath;

    }

    private function checkViewExists(string $view)
    {

        $viewPath = $this->getViewPath($view);

        if (!file_exists($viewPath)) {
            echo "view <b>$view</b> not found";
            die();
        }
    }

    /**
     * @param string $view
     * @return string
     */
    private function getViewPath(string $view): string
    {
        return VIEW_BASE_URL . '/' . $view . '.php';
    }
}