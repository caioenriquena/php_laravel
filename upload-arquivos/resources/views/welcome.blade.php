<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página Principal</title>
</head>
<body>
<div class="container" style="text-align: center; margin-top: 50px;">
    <h1>Bem-vindo ao Sistema de Entrega de Documentos </h1>
    <div style="margin-top: 20px;">
        <a href="{{ route('report') }}" class="btn" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px; margin-right: 10px;">Ir para Relatórios</a>
        <a href="{{ route('upload') }}" class="btn" style="padding: 10px 20px; background-color: #2196F3; color: white; text-decoration: none; border-radius: 5px;">Ir para Uploads</a>
    </div>
</div>
</body>
</html>
