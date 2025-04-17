<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/version/v1.php';

Route::get("/something", function(){
    return response()->json(["message" => "Server is up"]);
});
