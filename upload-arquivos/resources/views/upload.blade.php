<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload de Arquivo</title>
</head>
<body>
<h1>Upload de Arquivo</h1>
<form action="/upload" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" id="file" name="file" required>
    <button type="submit">Enviar</button>
</form>
</body>
</html>
