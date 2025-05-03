<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\DaftarKelasController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelompokUjianController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SesiSoalController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NilaiUjianController;
use App\Http\Controllers\HasilUjianController;
use App\Http\Middleware\JwtMiddleware;


Route::prefix("/admin")->group(function () {
    Route::post("/login", [AuthController::class, "guruLogin"]);
    Route::post("/register", [AuthController::class, "guruRegister"]);
    Route::post("/logout", [AuthController::class, "guruLogout"]);

    Route::middleware([JwtMiddleware::class])->group(function(){
        // Peserta
        Route::get("/peserta", [PesertaController::class, "index"]);
        Route::get("/peserta/{id}", [PesertaController::class, "show"]);
        Route::post("/peserta", [PesertaController::class, "store"]);
        Route::put("/peserta/{id}", [PesertaController::class, "update"]);
        Route::delete("/peserta/{id}", [PesertaController::class, "destroy"]);

        // Agama
        Route::get("/agama", [AgamaController::class, "index"]);
        Route::get("/agama/{id}", [AgamaController::class, "show"]);
        Route::post("/agama", [AgamaController::class, "store"]);
        Route::put("/agama/{id}", [AgamaController::class, "update"]);
        Route::delete("/agama/{id}", [AgamaController::class, "destroy"]);

        // Guru
        Route::get("/guru", [GuruController::class, "index"]);
        Route::get("/guru/{id}", [GuruController::class, "show"]);
        Route::post("/guru", [GuruController::class, "store"]);
        Route::put("/guru/{id}", [GuruController::class, "update"]);
        Route::delete("/guru/{id}", [GuruController::class, "destroy"]);

        
        // Jurusan
        Route::get("/jurusan", [JurusanController::class, "index"]);
        Route::get("/jurusan/{id}", [JurusanController::class, "show"]);
        Route::post("/jurusan", [JurusanController::class, "store"]);
        Route::put("/jurusan/{id}", [JurusanController::class, "update"]);
        Route::delete("/jurusan/{id}", [JurusanController::class, "destroy"]);

        // Kelompok Ujian
        Route::get("/kelompok_ujian", [KelompokUjianController::class, "index"]);
        Route::get("/kelompok_ujian/{id}", [KelompokUjianController::class, "show"]);
        Route::post("/kelompok_ujian", [KelompokUjianController::class, "store"]);
        Route::put("/kelompok_ujian/{id}", [KelompokUjianController::class, "update"]);
        Route::delete("/kelompok_ujian/{id}", [KelompokUjianController::class, "destroy"]);

        // Mapel
        Route::get("/mapel", [MapelController::class, "index"]);
        Route::get("/mapel/{id}", [MapelController::class, "show"]);
        Route::post("/mapel", [MapelController::class, "store"]);
        Route::put("/mapel/{id}", [MapelController::class, "update"]);
        Route::delete("/mapel/{id}", [MapelController::class, "destroy"]);

        // Peserta
        Route::get("/peserta", [PesertaController::class, "index"]);
        Route::get("/peserta/{id}", [PesertaController::class, "show"]);
        Route::post("/peserta", [PesertaController::class, "store"]);
        Route::put("/peserta/{id}", [PesertaController::class, "update"]);
        Route::delete("/peserta/{id}", [PesertaController::class, "destroy"]);

        // Sesi Soal
        Route::get("/sesi_soal", [SesiSoalController::class, "index"]);
        Route::get("/sesi_soal/{id}", [SesiSoalController::class, "show"]);
        Route::post("/sesi_soal", [SesiSoalController::class, "store"]);
        Route::put("/sesi_soal/{id}", [SesiSoalController::class, "update"]);
        Route::delete("/sesi_soal/{id}", [SesiSoalController::class, "destroy"]);

        // Soal
        Route::get("/soal", [SoalController::class, "index"]);
        Route::get("/soal/{id}", [SoalController::class, "show"]);
        Route::post("/soal", [SoalController::class, "store"]);
        Route::put("/soal/{id}", [SoalController::class, "update"]);
        Route::delete("/soal/{id}", [SoalController::class, "destroy"]);

        // Ujian
        Route::get("/ujian", [UjianController::class, "index"]);
        Route::get("/ujian/edit/{id}", [UjianController::class, "show"]);
        Route::post("/ujian", [UjianController::class, "store"]);
        Route::put("/ujian/{id}", [UjianController::class, "update"]);
        Route::delete("/ujian/{id}", [UjianController::class, "destroy"]);

        // Daftar Kelas
        Route::get("/daftar_kelas", [DaftarKelasController::class, "index"]);
        Route::get("/daftar_kelas/{id}", [DaftarKelasController::class, "show"]);
        Route::post("/daftar_kelas", [DaftarKelasController::class, "store"]);
        Route::put("/daftar_kelas/{id}", [DaftarKelasController::class, "update"]);
        Route::delete("/daftar_kelas/{id}", [DaftarKelasController::class, "destroy"]);

        // Nilai Ujian
        Route::get("/nilai_ujian", [NilaiUjianController::class, "index"]);

        // Hasil Ujian
        Route::get("/hasil_ujian", [HasilUjianController::class, "index"]);
        Route::get("/hasil_ujian/migrate", [HasilUjianController::class, "migrate"]);
        Route::get("/hasil_ujian/reevaluate", [HasilUjianController::class, "reevaluate"]);
    });

    Route::prefix("/public")->group(function(){
        Route::get("/agama", [AgamaController::class, "index"]);
        Route::get("/kelas", [DaftarKelasController::class, "index"]);
        Route::get("/guru", [GuruController::class, "index"]);
        Route::get("/jurusan", [JurusanController::class, "index"]);
        Route::get("/kelompok_ujian", [KelompokUjianController::class, "index"]);
        Route::get("/mapel", [MapelController::class, "index"]);
        Route::get("/peserta", [PesertaController::class, "index"]);
        Route::get("/sesi_soal", [SesiSoalController::class, "index"]);
        Route::get("/soal", [SoalController::class, "index"]);
        Route::get("/ujian", [UjianController::class, "index"]);
        Route::get("/daftar_kelas", [DaftarKelasController::class, "index"]);
    });

});

Route::prefix("/siswa")->group(function(){
    Route::post("/login", [AuthController::class, "pesertaLogin"]);
    Route::post("/register", [AuthController::class, "pesertaRegister"]);
    Route::post("/logout", [AuthController::class, "pesertaLogout"]);

    Route::middleware([JwtMiddleware::class])->group(function(){
        Route::get("/peserta", [PesertaController::class, "getSelf"]);
        
        Route::get("/ujian", [UjianController::class, "index"]);
        Route::get("/sesi_soal", [SesiSoalController::class, "index"]);
        Route::post("/submit_ujian", [App\Http\Controllers\v1\UjianController::class, "submitUjian"]);
        Route::post("/sesi_soal", [SesiSoalController::class, "store"]);
    });
});


