<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str; 

abstract class Controller
{
    //
    public function sanitizeInput($input)
    {
        return htmlspecialchars(strip_tags($input));
    }

    public function handleRequest(Request $request)
    {
        try{
            $data = $request->all();
            foreach ($data as $key => $value) {
                /*
                if (is_string($value)) {
                    $data[$key] = $this->sanitizeInput($value);
                }
                if (in_array($key, ['start_date', 'end_date']) && strtotime($value)) {
                    $data[$key] = date(DATE_ISO8601, strtotime($value));
                }
                */
                // if (in_array($key, ['start_date', 'end_date']) && strtotime($value)) {
                    //     $data[$key] = new \DateTime($value);
                    // }
                // if (in_array($key, ['start_date', 'end_date']) && strtotime($value)) {
                //     // Parse the incoming datetime (with any timezone info) and normalize to UTC ISO 8601
                //     $data[$key] = \Carbon\Carbon::parse($value)
                //         ->utc()
                //         ->toIso8601String();
                // }
                        
                if ($key === 'image' ) {
                    //$fileName = 'blob_' . time() . '.png'; // Adjust the file extension as needed
                    //Storage::put('public/files/' . $fileName, base64_decode($value));
                    //dd($value);
                    if($this->isBlobString($value)){
                    $fileName = $this->saveBase64File($value,"files" );
                    $data['image'] = $fileName;
                    }
                    else if($value){
                        unset($data['image']);
                    }
                }
    
                if (strpos($key, 'pilihan') !== false) {
                    if($this->isBlobString($value)){
                        $fileName = $this->saveBase64File($value,"files" );
                        $data[$key] = $fileName;
                    }
                    else if($this->isBase64($value)){
                        $data[$key] = base64_decode($value);
                    }
                    
                }
               
            }
            return $data;

        }
        catch (\Exception $e) {
            // Handle the exception as needed
            return response()->json(['error' => 'An error occurred while processing the request.','message'=> $e->getMessage()], 500);
        }
    }
    
    private function isBase64($string) {
        // Check if the string is valid Base64
        $decoded = base64_decode($string, true);
        // Ensure the string is both decodable and re-encodable
        return $decoded !== false && base64_encode($decoded) === $string;
    }

    private function isBlobString($value)
    {
        // Check if the value is a base64-encoded string
        return is_string($value) && preg_match('/^data:(.*?);base64,(.*)$/', $value, $matches);
    }
    
    private function saveBase64File(string $base64String, string $folder = 'uploads'): string
    {
        // Split the base64 string into metadata and the actual base64 data
        if (preg_match('/^data:(.*?);base64,(.*)$/', $base64String, $matches)) {
            $mimeType = $matches[1];
            $base64Data = $matches[2];
    
            // Get file extension from MIME type
            $extension = explode('/', $mimeType)[1];
    
            // Decode base64 string
            $fileContent = base64_decode($base64Data);
    
            // Generate a unique filename
            $fileName = Str::uuid() . '.' . $extension;
    
            // Save file to storage/app/public/uploads (if using public disk)
            Storage::disk('public')->put("{$folder}/{$fileName}", $fileContent);
    
            // Return path or filename as needed
            return "{$folder}/{$fileName}";
        }
    
        throw new \Exception("Invalid base64 string format.");
    }
}
