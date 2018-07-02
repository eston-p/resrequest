<?php

namespace App\Validation;

class Validation
{
    protected $data = [];

    protected $errors = [];

    protected $rules = [];

    public function validation($input, $rules = [])
    {
        $this->rules = $this->extractRules($input);
        $this->data = $this->extractData($input);

        foreach ($input as $value => $rules) {
           $this->errors = $this->validateData($value, $rules);
        }
        return $this->errors;
    }

    public function extractRules(array $array)
    {
        $rules = [];

        foreach ($array as $input) {
            $rules = $input;
        }

        return $rules;
    }

    public function extractData(array $array)
    {
        $data = [];

        foreach ($array as $key => $input) {
            $data = $key;
        }

        return $data;
    }

    public function validateData($value, $rules)
    {
        $errors = [];
        $fields = explode('|', $rules);

        foreach ($fields as $field) {
            $continue = call_user_func(array($this, $field),$value);
            ($continue === false) ? $errors[] = $continue : true  ;
        }

        return $errors;
    }

    function required($value)
    {
        $value = preg_replace('/^[\pZ\pC]+|[\pZ\pC]+$/u', '', $value);
        return !empty($value) ? true : 'This is required';
    }

    public function int($value)
    {
        return (is_numeric($value) && (int)$value == $value)  ? true : 'Must be a number';
    }

    public function date($value)
    {
        if ($value instanceof \DateTime) {
            return true;
        }
        if (strtotime($value) === false) {
            return false;
        }
        $date = date_parse($value);
        return checkdate($date['month'], $date['day'], $date['year'])  ? true : 'Must be a valid date';
    }

    public function email($value)
    {
        return filter_var($value, FILTER_VALIDATE_EMAIL) !== false ? true : 'Must be a valid email address';
    }


}