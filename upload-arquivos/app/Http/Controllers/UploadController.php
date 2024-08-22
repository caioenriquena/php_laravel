<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function upload(Request $request)
    {

        try {
            // Validação do arquivo
            $request->validate([
                'file' => 'required|file',
            ]);

            // Upload para o MinIO usando um nome gerado automaticamente
            $path = $request->file('file')->store('uploads/', 'minio');

            return back()->with('success', 'Arquivo enviado com sucesso para: ' . $path);
        } catch (\Exception $e) {
            return back()->with('error', 'Erro ao enviar o arquivo: ' . $e->getMessage());
        }
    }
}
