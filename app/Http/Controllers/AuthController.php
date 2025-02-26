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
            $data['password'] = Hash::make($data['password']);
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

            $verifyPassword = Hash::check($credentials['password'], $guru->password);

            if(!$verifyPassword) {
                return response()->json(['error'=> 'invalid_credentials'],400);
            }
            $data = $guru->toArray();
            $data['password'] = $guru->password;
            $token = JwtHelper::generateToken($data, 3600);

            return response()->json(compact('guru', 'token'), 200);



        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
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
            $data = $this->validatePesertaRequest($request);
            $peserta = Peserta::create([
                'nomor_peserta' => $data['nomor_peserta'],
                'password' => Hash::make($data['password']),
                'nama' => $data['nama'],
                'alamat' => $data['alamat'],
                'jurusan_id' => $data['jurusan_id'],
                'agama_id' => $data['agama_id'],
                'kelas_id' => $data['kelas_id']
            ]);

            $data = $peserta->toArray();
            $token = JwtHelper::generateToken($data, 3600);
            return response()->json(compact('peserta', 'token'), 201);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }

    public function pesertaLogin(Request $request)
    {
        $credentials = $request->only('nomor_peserta', 'password');
        try {

            $peserta = Peserta::where('nomor_peserta', $credentials['nomor_peserta'])->first();

            if (!$peserta) {
                return response()->json(['error' => 'invalid_credentials. User not Found'], 400);
            }

            $verifyPassword = Hash::check($credentials['password'], $peserta->password);

            if(!$verifyPassword) {
                return response()->json(['error'=> 'invalid_credentials'],400);
            }
            $data = $peserta->toArray();
            $data['password'] = $peserta->password;
            $token = JwtHelper::generateToken($data, 3600);

            return response()->json(compact('peserta', 'token'), 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'could_not_create_token'], 500);
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