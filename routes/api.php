<?php

use Illuminate\Support\Facades\Route;

<<<<<<< HEAD
require __DIR__ . '/version/v1.php';
=======
require __DIR__ . '/version/v0.php';
>>>>>>> f6925f0209e602d33cfce465645b0879fee9227d

Route::get("/something", function(){
    return response()->json(["message" => "Server is up"]);
});
