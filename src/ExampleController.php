<?php


namespace TestApp;

use TestApp\interfaces\IController;


class ExampleController implements IController
{
    public function show()
    {
        view('index.twig', ['name' => 'Tuan']);
    }
}