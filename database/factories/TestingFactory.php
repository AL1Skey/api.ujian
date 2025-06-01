<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class TestingFactory extends Factory
{
    /**
     * Define the model's default state.
     * Here we use the "ujian" state as the default.
     *
     * @return array
     */
    public function definition(): array
    {
        return $this->ujian();
    }

    // Factory for table: hasil__ujians
    public function hasilUjian(): array
    {
        return [
            'nomor_peserta' => $this->faker->numberBetween(1000, 9999),
            'ujian_id'      => $this->faker->numberBetween(1, 100),
            'soal_id'       => $this->faker->numberBetween(1, 100),
            'sesi_soal_id'  => $this->faker->numberBetween(1, 100),
            'isTrue'        => $this->faker->boolean,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }

    // Factory for table: sesi__soals
    public function sesiSoal(): array
    {
        return [
            'nomor_peserta' => $this->faker->numberBetween(1000, 9999),
            'ujian_id'      => $this->faker->numberBetween(1, 100),
            'soal_id'       => $this->faker->numberBetween(1, 100),
            'tipe_soal'     => $this->faker->word,
            'jawaban'       => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']),
            'isTrue'        => $this->faker->boolean,
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }

    // Factory for table: ujians
    public function ujian(): array
    {
        return [
            'kelompok_id' => $this->faker->numberBetween(1, 100),
            'mapel_id'    => $this->faker->numberBetween(1, 100),
            'kelas_id'    => $this->faker->numberBetween(1, 100),
            'nama'        => $this->faker->sentence,
            'id_sekolah'  => $this->faker->bothify('SCH####'),
            'start_date'  => $this->faker->dateTime,
            'end_date'    => $this->faker->dateTime,
            'duration'    => $this->faker->numberBetween(30, 180),
            'status'      => $this->faker->boolean,
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }
    // Factory for table: sesi_ujians
    public function sesiUjian(): array
    {
        return [
            'ujian_id'      => $this->faker->numberBetween(1, 100),
            'nomor_peserta' => $this->faker->numberBetween(1000, 9999),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }

    // Factory for table: gurus
    public function guru(): array
    {
        return [
            'username'       => $this->faker->unique()->userName,
            'password'       => bcrypt('password'),
            'remember_token' => Str::random(10),
            'nama'           => $this->faker->name,
            'alamat'         => $this->faker->address,
            'mapel_id'       => $this->faker->numberBetween(1, 100),
            'is_active'      => $this->faker->boolean,
            'agama_id'       => $this->faker->numberBetween(1, 100),
            'isDeleted'      => $this->faker->boolean,
            'created_at'     => now(),
            'updated_at'     => now(),
        ];
    }

    // Factory for table: soals
    public function soal(): array
    {
        return [
            'ujian_id'    => $this->faker->numberBetween(1, 100),
            'soal'        => $this->faker->text,
            'image'       => $this->faker->imageUrl,
            'tipe_soal'   => $this->faker->randomElement(['pilihan_ganda', 'essai']),
            'pilihan_a'   => $this->faker->word,
            'pilihan_b'   => $this->faker->word,
            'pilihan_c'   => $this->faker->word,
            'pilihan_d'   => $this->faker->word,
            'pilihan_e'   => $this->faker->word,
            'jawaban'     => $this->faker->randomElement(['A', 'B', 'C', 'D', 'E']),
            'created_at'  => now(),
            'updated_at'  => now(),
        ];
    }

    // Factory for table: agamas
    public function agama(): array
    {
        return [
            'nama'       => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Factory for table: jurusans
    public function jurusan(): array
    {
        return [
            'nama'       => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Factory for table: daftar__kelas
    public function daftarKelas(): array
    {
        return [
            'nama'       => $this->faker->word,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    // Factory for table: mapels
    public function mapel(): array
    {
        return [
            'nama'       => $this->faker->word,
            'isDeleted'  => $this->faker->boolean,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }
    public function peserta(): array
    {
        return [
            'nomor_peserta' => fake()->unique()->numberBetween(1000, 9999),
            'nama'          => fake()->name,
            'password'      => bcrypt('password'),
            'created_at'    => now(),
            'updated_at'    => now(),
        ];
    }




    // Factory for table: cache
    public function cache(): array
    {
        return [
            'key'        => $this->faker->unique()->sha256,
            'value'      => $this->faker->text,
            'expiration' => $this->faker->numberBetween(1000, 10000),
        ];
    }

    // Factory for table: cache_locks
    public function cacheLock(): array
    {
        return [
            'key'        => $this->faker->unique()->sha256,
            'owner'      => $this->faker->uuid,
            'expiration' => $this->faker->numberBetween(1000, 10000),
        ];
    }

    // Factory for table: users
    public function user(): array
    {
        return [
            'name'              => $this->faker->name,
            'email'             => $this->faker->unique()->safeEmail,
            'email_verified_at' => $this->faker->optional()->dateTime,
            'password'          => bcrypt('password'),
            'remember_token'    => Str::random(10),
            'created_at'        => now(),
            'updated_at'        => now(),
        ];
    }

    // Factory for table: password_reset_tokens
    public function passwordResetToken(): array
    {
        return [
            'email'      => $this->faker->unique()->safeEmail,
            'token'      => Str::random(60),
            'created_at' => now(),
        ];
    }


    // Factory for table: sessions
    public function session(): array
    {
        return [
            'id'            => $this->faker->uuid,
            'user_id'       => $this->faker->numberBetween(1, 100),
            'ip_address'    => $this->faker->ipv4,
            'user_agent'    => $this->faker->userAgent,
            'payload'       => $this->faker->text,
            'last_activity' => $this->faker->unixTime,
        ];
    }

    // Factory for table: kelompok__ujians
    public function kelompokUjian(): array
    {
        return [
            'nama'       => $this->faker->word,
            'id_sekolah' => $this->faker->bothify('SCH####'),
            'start_date' => $this->faker->dateTime,
            'end_date'   => $this->faker->dateTime,
            'created_at' => now(),
            'updated_at' => now(),
        ];
    }

    public function generateAll(int $count = 10): void
{
    // Buat Agama
    $agamaIds = collect(range(1, 10))->map(function () {
        return \DB::table('agamas')->insertGetId($this->agama());
    });

    // Buat Mapel
    $mapelIds = collect(range(1, 10))->map(function () {
        return \DB::table('mapels')->insertGetId($this->mapel());
    });

    // Buat Jurusan
    collect(range(1, $count))->each(function () {
        \DB::table('jurusans')->insert($this->jurusan());
    });

    // Buat Kelas
    $kelasIds = collect(range(1, 10))->map(function () {
        return \DB::table('daftar__kelas')->insertGetId($this->daftarKelas());
    });

    // Buat Peserta
    $pesertaIds = collect(range(1, 90))->map(function() use ($kelasIds) {
        $peserta = $this->peserta();
        $data =  array_merge($peserta, [
            'nomor_peserta' => $peserta['nomor_peserta'],
            'kelas_id'   => fake()->randomElement($kelasIds),
        ]);
        \DB::table('pesertas')->insert($data);
        return $peserta['nomor_peserta'];;
    });

    // Buat Kelompok Ujian
    $kelompokIds = collect(range(1, 3))->map(function () {
        return \DB::table('kelompok__ujians')->insertGetId($this->kelompokUjian());
    });

    // Buat Guru dengan foreign key valid
    $gurus = collect(range(1, 10))->map(function () use ($mapelIds, $agamaIds) {
        return array_merge($this->guru(), [
            'mapel_id'  => $mapelIds->random(),
            'agama_id'  => $agamaIds->random(),
        ]);
    });
    \DB::table('gurus')->insert($gurus->toArray());

    // Buat Ujian dengan foreign key valid
    $ujians = collect(range(1, 10))->map(function () use ($kelompokIds, $mapelIds, $kelasIds) {
        return array_merge($this->ujian(), [
            'kelompok_id' => fake()->randomElement($kelompokIds),
            'mapel_id'    =>  fake()->randomElement($mapelIds),
            'kelas_id'    =>  fake()->randomElement($kelasIds),
        ]);
    });
    \DB::table('ujians')->insert($ujians->toArray());

    // Buat Soal, Sesi Soal, Hasil Ujian dengan dummy ID, atau ambil ID real setelah insert ujian & soal
    $ujianIds = \DB::table('ujians')->pluck('id')->toArray();
    // Kemudian pas buat soal, pilih dari ID yang valid
    $soals = collect(range(1, $count))->map(function () use ($ujianIds) {
        return array_merge($this->soal(), [
            'ujian_id' => fake()->randomElement($ujianIds)
        ]);
    });
    \DB::table('soals')->insert($soals->toArray());
    
    $soalIds = \DB::table('soals')->pluck('id')->toArray();
    collect(range(1, $count))->each(function () use ($ujianIds, $soalIds, $pesertaIds) {
        $sesiSoalData = array_merge($this->sesiSoal(), [
            'nomor_peserta' => fake()->randomElement($pesertaIds),
            'ujian_id'      => fake()->randomElement($ujianIds),
            'soal_id'       => fake()->randomElement($soalIds)
        ]);
        $sesiSoalId = \DB::table('sesi__soals')->insertGetId($sesiSoalData);
        
        $soalData = \DB::table('soals')->where('id', $sesiSoalData['soal_id'])->first();

        \DB::table('hasil__ujians')->insert(
            array_merge($this->hasilUjian(), [
                'nomor_peserta' => $sesiSoalData['nomor_peserta'],
                'ujian_id'      => $sesiSoalData['ujian_id'],
                'soal_id'       => $sesiSoalData['soal_id'],
                'sesi_soal_id'  => $sesiSoalId,
                'tipe_soal'     => $sesiSoalData['tipe_soal'],
                'jawaban_soal' => $soalData->jawaban,
                'jawaban_sesi'  => $sesiSoalData['jawaban'],
            ])
        );
    });
    

    // Generate Sesi Ujian records
    collect(range(1, $count))->each(function () use ($ujianIds, $pesertaIds) {
        \DB::table('sesi__ujians')->insert(
            array_merge($this->sesiUjian(), [
                'ujian_id'      => fake()->randomElement($ujianIds),
                'nomor_peserta' => fake()->randomElement($pesertaIds),
            ])
        );
    });

    // Optional lainnya
    \DB::table('users')->insert(
        collect(range(1, $count))->map(fn () => $this->user())->toArray()
    );
}


}