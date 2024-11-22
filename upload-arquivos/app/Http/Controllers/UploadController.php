<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UploadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth'); // Aplica autenticação para todas as ações
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
}
