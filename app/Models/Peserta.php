<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;

class Peserta extends Model implements
AuthenticatableContract,
AuthorizableContract,
CanResetPasswordContract,
JWTSubject
{
    //
    use Authenticatable, Authorizable, CanResetPassword;
    protected $table = 'pesertas';
    protected $fillable = ['nomor_peserta', 'password', 'nama', 'alamat', 'kelas_id', 'jurusan_id', 'agama_id'];

    // Get the name of the unique identifier for the user
    public function getAuthIdentifierName()
    {
        return 'nomor_peserta';
    }

    // Get the unique identifier for the user
    public function getAuthIdentifier()
    {
        return $this->getKey();
    }

    // Get the password for the user
    public function getAuthPassword()
    {
        return $this->password;
    }

    // Get the "remember me" token value
    public function getRememberToken()
    {
        return $this->remember_token;
    }

    // Set the "remember me" token value
    public function setRememberToken($value)
    {
        $this->remember_token = $value;
    }

    // Get the column name for the "remember me" token
    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    // Check if the user has a given ability
    public function can($abilities, $arguments = [])
    {
        // Implement your logic here
    }

    // Get the identifier that will be stored in the JWT token
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    // Return a key-value array, containing any custom claims to be added to the JWT
    public function getJWTCustomClaims()
    {
        return [];
    }

    public function kelas()
    {
        return $this->belongsTo(Daftar_Kelas::class);
    }

    public function jurusan()
    {
        return $this->belongsTo(Jurusan::class);
    }

    public function agama()
    {
        return $this->belongsTo(Agama::class);
    }
}
