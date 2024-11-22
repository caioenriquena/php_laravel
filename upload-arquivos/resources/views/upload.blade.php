<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
    @vite('resources/css/upload.css')
</head>
<body>
<div class="container">
    <h1>Upload de Arquivo</h1>

    <!-- Exibição de mensagens de erro ou sucesso -->
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <form action="/upload" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="upload-container">
            <input type="file" id="file" name="file" required>
            <button type="submit" class="btn-upload">Enviar</button>
        </div>
    </form>
</div>
</body>
</html>
