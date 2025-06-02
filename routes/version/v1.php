<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AgamaController;
use App\Http\Controllers\DaftarKelasController;
use App\Http\Controllers\TingkatanController;
use App\Http\Controllers\GuruController;
use App\Http\Controllers\JurusanController;
use App\Http\Controllers\KelompokUjianController;
use App\Http\Controllers\MapelController;
use App\Http\Controllers\PesertaController;
use App\Http\Controllers\SesiSoalController;
use App\Http\Controllers\SoalController;
use App\Http\Controllers\UjianController;
use App\Http\Controllers\AuthController;
// use App\Http\Controllers\NilaiUjianController;
use App\Http\Controllers\HasilUjianController;
use App\Http\Controllers\SesiUjianController;
use App\Http\Middleware\JwtMiddleware;


Route::prefix("/admin")->group(function () {
    Route::post("/login", [AuthController::class, "guruLogin"]);
    Route::post("/register", [AuthController::class, "guruRegister"]);
    Route::post("/logout", [AuthController::class, "guruLogout"]);
    
    //middleware([JwtMiddleware::class])->
    Route::group([], function(){
    // Route::middleware([JwtMiddleware::class])->group(function(){
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

        Route::post("/import_guru", [GuruController::class, "import"]);

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

        Route::get("/print_kartu_ujian/{id}", [PesertaController::class, "kartuUjian"]);
        Route::post("/import_peserta", [PesertaController::class, "import"]);

        // Sesi Soal
        Route::get("/sesi_soal", [SesiSoalController::class, "index"]);
        Route::get("/sesi_soal/{id}", [SesiSoalController::class, "show"]);
        Route::post("/sesi_soal", [SesiSoalController::class, "upstore"]);
        Route::put("/sesi_soal/{id}", [SesiSoalController::class, "update"]);
        Route::delete("/sesi_soal/{id}", [SesiSoalController::class, "destroy"]);

        // Soal
        Route::get("/soal", [SoalController::class, "indexAll"]);
        Route::get("/soal/show/{id}", [SoalController::class, "show"]);
        Route::post("/soal", [SoalController::class, "store"]);
        Route::post("/soal/edit/{id}", [SoalController::class, "update"]);
        Route::delete("/soal/delete/{id}", [SoalController::class, "destroy"]);

        Route::post("/import-soal",[SoalController::class,"import"]);
        // Route::delete("/delete-soal-by-ujian/{ujian_id}", [SoalController::class, "destroyByUjian"]);

        // Ujian
        Route::get("/ujian", [UjianController::class, "index"]);
        Route::get("/ujian_ids", [UjianController::class, "getAllIds"]);
        Route::get("/ujian/{id}", [UjianController::class, "show"]);
        Route::post("/ujian", [UjianController::class, "store"]);
        Route::put("/ujian/{id}", [UjianController::class, "update"]);
        Route::delete("/ujian/{id}", [UjianController::class, "destroy"]);

        // Daftar Kelas
        Route::get("/daftar_kelas", [DaftarKelasController::class, "index"]);
        Route::get("/daftar_kelas/{id}", [DaftarKelasController::class, "show"]);
        Route::post("/daftar_kelas", [DaftarKelasController::class, "store"]);
        Route::put("/daftar_kelas/{id}", [DaftarKelasController::class, "update"]);
        Route::delete("/daftar_kelas/{id}", [DaftarKelasController::class, "destroy"]);

        // Tingkat Kelas
        Route::get("/tingkatan", [TingkatanController::class, "index"]);
        Route::get("/tingkatan/{id}", [TingkatanController::class, "show"]);
        Route::post("/tingkatan", [TingkatanController::class, "store"]);
        Route::put("/tingkatan/{id}", [TingkatanController::class, "update"]);
        Route::delete("/tingkatan/{id}", [TingkatanController::class, "destroy"]);

        // Sesi Ujian
        Route::get("/sesi_ujian", [SesiUjianController::class, "index"]);
        Route::get("/sesi_ujian/{id}", [SesiUjianController::class, "show"]);
        Route::post("/sesi_ujian", [SesiUjianController::class, "store"]);
        Route::put("/sesi_ujian/{id}", [SesiUjianController::class, "update"]);
        Route::delete("/sesi_ujian/{id}", [SesiUjianController::class, "destroy"]);


        // Submit Ujian
        Route::post("/submit_ujian",[\App\Http\Controllers\v1\SubmitUjian\UjianController::class, "submitUjian"]);

        // // Nilai Ujian
        // Route::get("/nilai_ujian", [NilaiUjianController::class, "index"]);

        // Hasil Ujian
        Route::get("/hasil_ujian", [HasilUjianController::class, "index"]);
        Route::get("/hasil_ujian/show/{id}",[HasilUjianController::class, "show"]);
        Route::put("/hasil_ujian/update/{id}",[HasilUjianController::class,"update"]);
        
        Route::get("/hasil_ujian/siswa/{nomor_peserta}/ujian/{ujian_id}",[HasilUjianController::class,"hasilUjianSiswa"]);
        
        Route::get("/hasil_ujian/analysis/{id}",[HasilUjianController::class,"hasilUjianAnalysis"]);
        Route::get("/hasil_ujian/analisa_butir_soal/{id}",[HasilUjianController::class,"analisaButirSoal"]);
        Route::get("/hasil_ujian/ujian/{ujian_id}/kelas/{kelas_id}",[HasilUjianController::class,"hasilUjianSiswaByUjianKelas"]);
        Route::get("/hasil_ujian/ujian/{ujian_id}",[HasilUjianController::class,"hasilUjianSiswaByUjian"]);


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
    Route::get("/something", function(){
    return response()->json(["message" => "Server is up"]);
    });
    //middleware([JwtMiddleware::class])->
  Route::group([],function(){
    //Route::middleware([JwtMiddleware::class])->group(function(){
        Route::get("/peserta", [PesertaController::class, "getSelf"]);

        // Sesi Ujian
        Route::get("/sesi_ujian", [SesiUjianController::class, "index"]);
        Route::get("/sesi_ujian/{id}", [SesiUjianController::class, "show"]);
        Route::post("/sesi_ujian", [SesiUjianController::class, "store"]);
        Route::put("/sesi_ujian/{id}", [SesiUjianController::class, "update"]);
        
        Route::get("/ujian", [UjianController::class, "indexSiswa"]);
        Route::get("/ujian/{id}", [UjianController::class, "show"]);
        Route::get("/soal", [SoalController::class, "index"]);
        Route::get("/sesi_soal", [SesiSoalController::class, "index"]);
        Route::post("/submit_ujian", [App\Http\Controllers\v1\SubmitUjian\UjianController::class, "submitUjian"]);
        
        // Calculate the value
        Route::get("/hasil_ujian/migrate", [HasilUjianController::class, "migrate"]);
        Route::get("/hasil_ujian/reevaluate", [HasilUjianController::class, "reevaluate"]);
    });
});


