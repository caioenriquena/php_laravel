<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;


class UploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    public function showForm()
    {
        return view('upload');
    }


    public function upload(Request $request)
    {

        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);
        $originalFileName = $request->file('file')->getClientOriginalName();

        $path = $request->file('file')->storeAs('uploads/', $originalFileName,'minio');  // 'uploads' é a pasta dentro do seu MinIO



        $upload = new Upload();
        $upload->file_name = basename($path);
        $upload->user_id = Auth::id();
        $upload->uploaded_at = now();
        $upload->save();

        return redirect()->back()->with('success', 'Arquivo enviado com sucesso!');
    }


    public function generateReport()
    {

        $uploads = Upload::whereMonth('uploaded_at', now()->month)
            ->whereYear('uploaded_at', now()->year)
            ->orderBy('uploaded_at', 'desc')
            ->get();


        return view('report', compact('uploads'));
    }

  // METODO USADO PARA FAZER O DOWNLOAD EM CSV
    public function downloadReport()
    {
        $uploads = Upload::all(); // Aqui você pode filtrar os uploads para o mês específico, se necessário

        // Definindo o nome do arquivo CSV
        $fileName = 'relatorio_uploads.csv';

        // Criando uma resposta do tipo CSV
        $response = new StreamedResponse(function () use ($uploads) {
            // Abrindo o "fluxo" para o CSV
            $handle = fopen('php://output', 'w');

            // Escrevendo o cabeçalho do CSV
            fputcsv($handle, ['ID', 'Nome do Arquivo', 'Usuário', 'Data de Upload']);

            // Escrevendo os dados dos uploads
            foreach ($uploads as $upload) {
                fputcsv($handle, [
                    $upload->id,
                    $upload->file_name,
                    $upload->user->name,
                    $upload->uploaded_at,
                ]);
            }

            fclose($handle);
        });

        // Definindo os cabeçalhos HTTP para download
        $response->headers->set('Content-Type', 'text/csv');
        $response->headers->set('Content-Disposition', 'attachment; filename="' . $fileName . '"');

        // Retornando a resposta com o arquivo CSV
        return $response;
    }
}
