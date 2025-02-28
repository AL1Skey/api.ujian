<?php

namespace App\Http\Middleware;

use Closure;
use Exception;
use Illuminate\Http\Request;
use App\Helper\JwtHelper;
use App\Models\Guru;
use App\Models\Peserta;
use Illuminate\Support\Facades\Hash;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Retrieve the token from the Authorization header
        $token = $request->bearerToken();

        if (!$token) {
            return response()->json(['error' => 'Token not provided'], 401);
        }

        try {
            // Validate and decode the token using our helper
            $decoded = JwtHelper::verifyToken($token);
            $user = null;
            $role = explode('/', $request->path())[1];
            // dd($role,isset($decoded['nomor_peserta']));
            // dd($decoded);
            
            switch ($role) {
                case 'admin':
                    if (isset($decoded['username'])) {
                        $user = Guru::where('username', $decoded['username'])->first();
                        // dd($decoded['password'], $user->password);
                        $verifyPassword = Hash::check($decoded['password'], $user->password);
                        if (!$verifyPassword) {
                            return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                    } else {
                        return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
                    }
                    break;
                case 'siswa':
                    if (isset($decoded['nomor_peserta'])) {
                        $user = Peserta::where('nomor_peserta', $decoded['nomor_peserta'])->first();
                        $verifyPassword = Hash::check($decoded['password'], $user->password);
                        if (!$verifyPassword) {
                            return response()->json(['error' => 'invalid_credentials'], 400);
                        }
                    } else {
                        return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
                    }
                    break;
                default:
                    return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
            }
            // dd($request);

            //  attach the decoded payload to the request (accessible in controllers)
            $request->attributes->add(['jwt_payload' => $user]);

            return $next($request);
        } catch (Exception $e) {
            return response()->json(['error' => 'Invalid token','err'=>$e->getMessage()], 401);
        }
       
    }
}
