<?php

namespace App\Http\Controllers;

use App\Models\Soal;
use Illuminate\Http\Request;
use App\Models\Ujian;
use PhpOffice\PhpWord\IOFactory;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SoalController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
       
        //
        try{
            $soal = Soal::query()->select(['id', 'ujian_id', 'soal', 'image', 'tipe_soal', 'pilihan_a', 'pilihan_b', 'pilihan_c', 'pilihan_d', 'pilihan_e']);
            if($request->query("ujian_id")){
                $soal->where("ujian_id", $request->query("ujian_id"));
            }
            //$soal->with("ujian");
            $paginateResult = $soal->paginate($request->query("limit") ?? 100);
            foreach ($paginateResult->items() as $item) {
                if($item->image){
                $item->image = $item->image ? asset('storage/app/public/'.$item->image) : null;
                }

                if ($item->pilihan_a && Str::contains($item->pilihan_a, 'files/')) {
                    $item->pilihan_a = asset('storage/app/public/' . $item->pilihan_a);
                }

                if ($item->pilihan_b && Str::contains($item->pilihan_b, 'files/')) {
                    $item->pilihan_b = asset('storage/app/public/' . $item->pilihan_b);
                }

                if ($item->pilihan_c && Str::contains($item->pilihan_c, 'files/')) {
                    $item->pilihan_c = asset('storage/app/public/' . $item->pilihan_c);
                }

                if ($item->pilihan_d && Str::contains($item->pilihan_d, 'files/')) {
                    $item->pilihan_d = asset('storage/app/public/' . $item->pilihan_d);
                }

            }
            // dd($paginateResult);
            $per_page = $request->query("limit") ?? 100;
            return response()->json($paginateResult);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }
    
    public function indexAll(Request $request)
    {
        //
 
        try{
            $soal = Soal::query();

            if($request->query("ujian_id")){
                $soal->where("ujian_id", $request->query("ujian_id"));
            }
            //$soal->with("ujian");
            $paginateResult = $soal->paginate($request->query("limit") ?? 100);
            foreach ($paginateResult->items() as $item) {
                if($item->image){
                $item->image = $item->image ? asset('storage/app/public/'.$item->image) : null;
                }

                if ($item->pilihan_a && Str::contains($item->pilihan_a, 'files/')) {
                    $item->pilihan_a = asset('storage/app/public/' . $item->pilihan_a);
                }

                if ($item->pilihan_b && Str::contains($item->pilihan_b, 'files/')) {
                    $item->pilihan_b = asset('storage/app/public/' . $item->pilihan_b);
                }

                if ($item->pilihan_c && Str::contains($item->pilihan_c, 'files/')) {
                    $item->pilihan_c = asset('storage/app/public/' . $item->pilihan_c);
                }

                if ($item->pilihan_d && Str::contains($item->pilihan_d, 'files/')) {
                    $item->pilihan_d = asset('storage/app/public/' . $item->pilihan_d);
                }

            }
            $per_page = $request->query("limit") ?? 100;
            return response()->json($paginateResult);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        try{
            $request->validate([
                "ujian_id" => "required|integer",
                "soal" => "required|string",
                "tipe_soal" => "required|string",
                // "pilihan_a" => "string",
                // "pilihan_b" => "string",
                // "pilihan_c" => "string",
                // "pilihan_d" => "string",
                // "pilihan_e" => "string",
                // "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
           //dd($data);
            $data['soal'] = base64_decode($data['soal']);
            $check_ujian = Ujian::query()->find($request->ujian_id);
            if(!$check_ujian) {
                $data['ujian_id'] = null;
            }

            $soal = Soal::create($data);
            return response()->json($soal, 201);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
        try{
            $soal = Soal::findOrFail($id);
            $soal->load("ujian");
            $soal->image = $soal->image ? asset('public/' . $soal->image) : null;
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //
        try{
            $request->validate([
                "ujian_id" => "integer",
                // "soal" => "string",
                // "tipe_soal" => "string",
                // "pilihan_a" => "string",
                // "pilihan_b" => "string",
                // "pilihan_c" => "string",
                // "pilihan_d" => "string",
                // "pilihan_e" => "string",
                // "jawaban" => "string",
            ]);
            $data = $this->handleRequest($request);
            // return response()->json($data);
            $data['soal'] = base64_decode($data['soal']);
            $soal = Soal::findOrFail($id);
            $soal->update($data);
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
        try{
            $soal = Soal::findOrFail($id);
            $soal->delete();
            return response()->json($soal);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    public function destroyByUjian($ujian_id)
    {
        //
        try{
            if(!$ujian_id) {
                return response()->json(["error" => "ujian_id tidak boleh kosong"], 400);
            }
            $soal = Soal::where("ujian_id", $ujian_id);

            if($soal->count() == 0) {
                return response()->json(["message" => "Tidak ada soal yang ditemukan untuk ujian_id $ujian_id"], 404);
            }

            $soal->delete();
            return response()->json(["message" => "Soal dengan ujian_id $ujian_id telah dihapus"]);
        }
        catch (\Exception $e) {
            return response()->json(["error" => $e->getMessage()], 400);
        }
    }

    /**
     * Handle the request data for storing or updating.
     * 
     */

    public function import(Request $request)
    {
        $request->validate([
            'ujian_id'=> 'required|integer',
            'template' => 'required|file'
        ]);

        $file = $request->file('template');
        $phpWord = IOFactory::load($file->getPathname());
        $tables = [];

        $zip = new \ZipArchive;

        $imagePaths = [];
        if ($zip->open($file->getPathname()) === TRUE) {
            $imagePaths = [];
        
            $documentXml = $zip->getFromName('word/document.xml');
        
            if ($documentXml) {
                $xml = simplexml_load_string($documentXml);
                $xml->registerXPathNamespace('w', 'http://schemas.openxmlformats.org/wordprocessingml/2006/main');
                $xml->registerXPathNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
                $xml->registerXPathNamespace('r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');
        
                // Ambil semua elemen <w:p> dalam dokumen
                $paragraphs = $xml->xpath('//w:p');
        
                $relsXml = $zip->getFromName('word/_rels/document.xml.rels');
                $rels = simplexml_load_string($relsXml);
                $rels->registerXPathNamespace('r', 'http://schemas.openxmlformats.org/package/2006/relationships');
        
                $previousText = '';
        
                foreach ($paragraphs as $paragraph) {
                    $paragraph->registerXPathNamespace('a', 'http://schemas.openxmlformats.org/drawingml/2006/main');
                    $paragraph->registerXPathNamespace('r', 'http://schemas.openxmlformats.org/officeDocument/2006/relationships');
        
                    // Ambil teks dalam paragraf
                    $text = '';
                    foreach ($paragraph->xpath('.//w:t') as $t) {
                        $text .= (string) $t;
                    }
        
                    // Ambil semua gambar (a:blip)
                    $blips = $paragraph->xpath('.//a:blip');
        
                    if (count($blips) > 0) {
                        foreach ($blips as $blip) {
                            $embed = (string) $blip->attributes('r', true)['embed'];
                            $imageTarget = '';
        
                            foreach ($rels->Relationship as $rel) {
                                if ((string) $rel['Id'] === $embed) {
                                    $imageTarget = (string) $rel['Target'];
                                   // break;
                                }
                            }
        
                            if ($imageTarget) {
                                $imagePathInZip = 'word/' . $imageTarget;
                                $imageContent   = $zip->getFromName($imagePathInZip);

                                if ($imageContent) {
                                    // gunakan hash konten untuk mencegah duplikasi
                                    $ext      = pathinfo($imageTarget, PATHINFO_EXTENSION);
                                    $hash     = md5($imageContent);
                                    $filename = $hash . '.' . $ext;
                                    $disk     = Storage::disk('public');
                                    $storagePath = 'files/' . $filename;

                                    // simpan hanya jika belum ada
                                    if (!$disk->exists($storagePath)) {
                                        $disk->put($storagePath, $imageContent);
                                    }

                                    $imagePaths[] = [
                                        'image'       => $storagePath,
                                        'text_before' => $previousText
                                    ];

                                    // reset teks sebelumnya agar tidak terus-terusan dipakai
                                    $previousText = '';
                                }
                            }
                        }
                    } else {
                        // Update previousText hanya jika tidak ada gambar
                        if (trim($text) !== '') {
                            $previousText = $text;
                        }
                    }
                }
        
                // dd($imagePaths);
            }
        }
        
        // dd($imagePaths);
        
        
        
        $zip->close();
        // dd($imagePaths); // Cek hasilnya

        foreach ($phpWord->getSections() as $section) {
            foreach ($section->getElements() as $element) {
                if (method_exists($element, 'getRows')) {
                    foreach ($element->getRows() as $row) {
                        $cells = [];
                        foreach ($row->getCells() as $cell) {
                            $cells[] = $this->parseCell($cell);
                        }
                        $tables[] = $cells;
                    }
                }
            }
        }
        $count = 0;
        
        $tipe_soal = ["pilihan_ganda",'essai'];
        $parsed = [];
        foreach ($tables as $row) {
            if (empty($row[0]) || !is_numeric($row[0])) continue;
            // $ujian_id = Ujian::where('name', $row[1])->first(); 
            // cari gambar berdasarkan nomor soal (row[0])
            // dd($row);
            $matched = collect($imagePaths)->first(function($item) use ($row) {
                // dd($item);
                return trim($item['text_before']) === trim($row[0]);
            });

            $pilihan_a_match = collect($imagePaths)->first(function($item) use ($row) {
                return trim($item['text_before']) === trim($row[4]);
            });
            $pilihan_b_match = collect($imagePaths)->first(function($item) use ($row) {
                return trim($item['text_before']) === trim($row[5]);
            });
            $pilihan_c_match = collect($imagePaths)->first(function($item) use ($row) {
                return trim($item['text_before']) === trim($row[6]);
            });
            $pilihan_d_match = collect($imagePaths)->first(function($item) use ($row) {
                return trim($item['text_before']) === trim($row[7]);
            });
            $pilihan_e_match = collect($imagePaths)->first(function($item) use ($row) {
                return trim($item['text_before']) === trim($row[8]);
            });

            $tipe_soal_payload = (int)$row[3] < count($tipe_soal) ? $tipe_soal[(int)$row[3]] : null;
            if(!$tipe_soal_payload) continue;
            $payload = [
                'ujian_id' => $request->ujian_id ?? null,
                // 'image' => $row[2] ?? null,
                'image' => $matched['image'] ?? null,
                'soal' => $row[2] ?? ' ',
                'tipe_soal' => $tipe_soal_payload ,
                'pilihan_a' => ($pilihan_a_match['image'] ?? $row[4]) ?? null,
                'pilihan_b' => ($pilihan_b_match['image'] ?? $row[5]) ?? null,
                'pilihan_c' => ($pilihan_c_match['image'] ?? $row[6]) ?? null,
                'pilihan_d' => ($pilihan_d_match['image'] ?? $row[7]) ?? null,
                'pilihan_e' => ($pilihan_e_match['image'] ?? $row[8]) ?? null,
                'jawaban' => $row[9] ?? '',
                // 'bobot' => $row[10] ?? 10,
            ];
            // dd($payload);
            Soal::create($payload);
            $parsed[] = $payload;
            $count++;
        }

        return response()->json([
            'message' => 'Soal berhasil diimpor',
            'jumlah' => $count,
            'data' => $parsed
        ]);
    }

    
    private function parseCell($cell)
    {
        $text = '';
        $count = 0;
        foreach ($cell->getElements() as $element) {
            // Text biasa
            if (method_exists($element, 'getText')) {
                $text .= $element->getText();
            }
            // if($count == 0){
            //     // dd($element->getImageStringData());
            //     dd(get_class($element));    
            // }
            // Jika ada gambar
            // if (method_exists($element, 'getMediaRelationId')) {
                $imagePath = $this->saveImageFromElement($element);
                if ($imagePath) {
                    $text .= "\n{{img:$imagePath}}";
                }
            // }
            $count++;
        }

        return trim($text);
    }

    private function saveImageFromElement($element)
    {
        if (method_exists($element, 'getMediaTarget')) {
            $sourcePath = $element->getMediaTarget();

            if ($sourcePath && file_exists($sourcePath)) {
                $ext = pathinfo($sourcePath, PATHINFO_EXTENSION);
                $filename = 'soal_' . Str::random(12) . '.' . $ext;
                $storagePath = "public/soal_images/$filename";

                Storage::put($storagePath, file_get_contents($sourcePath));

                return "storage/soal_images/$filename";
            }
        }

        return null;
    }
}
