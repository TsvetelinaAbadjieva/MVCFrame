<?php

class Controller
{

    public function index() {
        echo 'Please implement index method to your controller';
        die;
    }

    protected function loadView($path, $data = [])
    {
        //Тази функция намира view файла и го зарежда. Всички елементи от
        // масива дата стават като отделни променливи които могат да бъдат достъпени.
        extract($data);
        $path = __DIR__.'/../views/admin/'.$path.'.php';
        require_once $path;
    }


}