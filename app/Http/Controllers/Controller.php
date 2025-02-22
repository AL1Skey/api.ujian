<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

abstract class Controller
{
    //
    public function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags($input));
    }

    public function handleRequest(Request $request)
    {
        $data = $request->all();
        foreach ($data as $key => $value) {
            if (is_string($value)) {
                $data[$key] = $this->sanitizeInput($value);
            }
        }
        return $data;
    }
}
