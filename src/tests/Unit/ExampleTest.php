<?php

use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    public function testAllSetUp()
    {
        $title = 'test';
        $validation = new \App\Validation\Validation();
        $rules = $validation->validation([$title => 'int|date']);


    }
}