<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function upload(Request $request)
    {
        // Validação do arquivo
        $request->validate([
            'file' => 'required|file|max:10240', // Limite de 10MB
        ]);

        // Armazena o arquivo no MinIO
        $path = $request->file('file')->store('uploads', 'minio');

        return response()->json([
            'message' => 'Arquivo enviado com sucesso!',
            'path' => $path,
        ]);
    }
}
