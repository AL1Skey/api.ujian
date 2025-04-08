<?php

use Illuminate\Support\Facades\Route;

require __DIR__ . '/version/v0.php';

Route::get("/something", function(){
    return response()->json(["message" => "Server is up"]);
});
