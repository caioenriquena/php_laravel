<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Uploads</title>
</head>
<body>

<h1>Relatório de Uploads - Mês de {{ now()->format('F Y') }}</h1>

@if($uploads->isEmpty())
    <p>Não há uploads neste mês.</p>
@else
    <table border="1">
        <thead>
        <tr>
            <th>ID</th>
            <th>Nome do Arquivo</th>
            <th>Usuário</th>
            <th>Data de Upload</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($uploads as $upload)
            <tr>
                <td>{{ $upload->id }}</td>
                <td>{{ $upload->file_name }}</td>
                <td>{{ $upload->user->name }}</td>
                <td>{{ $upload->uploaded_at }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endif

</body>
</html>
