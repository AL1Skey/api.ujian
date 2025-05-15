<?php

namespace App\Http\Controllers;

use App\Models\Guru;
use App\Models\Peserta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Helper\JwtHelper;

trait AuthGuruTrait
{
    public function guruRegister(Request $request)
    {
        try {
            $data = $this->handleRequest($request);
            // $data['password'] = Hash::make($data['password']);
            // dd($data);
            $guru = Guru::create(
                $data
            );

            return response()->json(compact('guru'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function guruLogin(Request $request)
    {
        try {
            $request->validate([
                "username" => "required",
                "password"=> "required",
            ]);
            $credentials = $request->only('username', 'password');

            $guru = Guru::where('username', $credentials['username'])->first();

            if (!$guru) {
                return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
            }

            // $verifyPassword = Hash::check($credentials['password'], $guru->password);
            $verifyPassword = $guru->password == $credentials['password'];
            if(!$verifyPassword) {
                return response()->json(['error'=> 'invalid_credentials'],400);
            }
            $data = $guru->toArray();
            $data['password'] = $credentials['password'];
            $token = JwtHelper::generateToken($data, 19200);

            return response()->json(compact('guru', 'token'), 200);



        } catch (\Exception $e) {
             return response()->json(['error' => 'could_not_create_token','msg'=>$e->getMessage()], 500);
        }
    }

    public function guruLogout(Request $request)
    {
        try {
            // JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_logout'], 500);
        }
    }

    private function validateGuruRequest(Request $request)
    {
        return $request->validate([
            'username' => 'required|string|unique:guru',
            'password' => 'required|string|min:6',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'jurusan_id' => 'required|integer',
            'agama_id' => 'required|integer'
        ]);
    }
}

trait AuthPesertaTrait
{
    public function pesertaRegister(Request $request)
    {
        try {
            $data = $this->handleRequest($request);
            // $data['password'] = Hash::make($data['password']);
            // dd($data);
            $peserta = Peserta::create(
                $data
            );

            return response()->json(compact('peserta'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function pesertaLogin(Request $request)
    {
        try {
            $request->validate([
                "nomor_peserta" => "required",
                "password"=> "required",
            ]);
            $credentials = $request->only('nomor_peserta', 'password');
            $peserta = Peserta::where('nomor_peserta', $credentials['nomor_peserta'])->first();
            
            if (!$peserta) {
                return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
            }
            
            // dd($peserta->password);
            if(!($peserta->password == $credentials['password'])) {
                // $verifyPassword = Hash::check($credentials['password'], $peserta->password);
                $verifyPassword = $peserta->password == $credentials['password'];
                if(!$verifyPassword) {
                    return response()->json(['error'=> 'invalid_credentials'],400);
                }
            }
            $data = $peserta->toArray();
            $data['password'] = $credentials['password'];
            $token = JwtHelper::generateToken($data, 19200);

            return response()->json(compact('peserta', 'token'), 200);



        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_create_token','err'=>$e->getMessage()], 500);
        }
    }

    public function pesertaLogout(Request $request)
    {
        try {
            // JWTAuth::invalidate(JWTAuth::getToken());
            return response()->json(['message' => 'Successfully logged out'], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_logout'], 500);
        }
    }

    private function validatePesertaRequest(Request $request)
    {
        return $request->validate([
            'nomor_peserta' => 'required|string|unique:peserta',
            'password' => 'required|string|min:6',
            'nama' => 'required|string',
            'alamat' => 'required|string',
            'jurusan_id' => 'required|integer',
            'agama_id' => 'required|integer',
            'kelas_id' => 'required|integer'
        ]);
    }
}

class AuthController extends Controller
{
    use AuthGuruTrait, AuthPesertaTrait;

    

}