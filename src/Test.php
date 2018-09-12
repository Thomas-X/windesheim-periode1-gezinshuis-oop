<?php


namespace TestApp;

use TestApp\interfaces\Controller;


class Test implements Controller
{
    public function show()
    {
        view('index.twig', ['name' => 'Tuan']);
    }
}