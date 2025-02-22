<?php

namespace App\Models;

// Import necessary classes and interfaces
use Illuminate\Database\Eloquent\Model;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;

// Define the Guru class which extends the Eloquent Model and implements several authentication-related contracts
class Guru extends Model implements 
    AuthenticatableContract, // Interface for authentication
    AuthorizableContract,    // Interface for authorization
    CanResetPasswordContract, // Interface for password reset
    JWTSubject               // Interface for JWT authentication
{
    // Use traits to include methods for authentication, authorization, and password reset
    use Authenticatable, Authorizable, CanResetPassword;

    // Define the table associated with the model
    protected $table = 'gurus';

    // Define the attributes that are mass assignable
    protected $fillable = ['username', 'password', 'nama', 'alamat', 'mapel_id', 'is_active', 'agama_id'];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    // Get the name of the unique identifier for the user
    public function getAuthIdentifierName()
    {
        return 'username';
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

    // Define a relationship to the Mapel model
    public function mapel()
    {
        return $this->belongsTo(Mapel::class);
    }
}