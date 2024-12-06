<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Relatório de Uploads</title>
    @vite('resources/css/report.css')
</head>
<body>

<div class="container">
    <h1>Relatório de Uploads - Mês de {{ now()->locale('pt_BR')->format('F Y') }}</h1>

    @if($uploads->isEmpty())
        <p>Não há uploads neste mês.</p>
    @else
        <table>
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
        <div style="text-align: center; margin-top: 20px;">
            <a href="{{ route('relatorio.download') }}" class="btn" style="padding: 10px 20px; background-color: #4CAF50; color: white; text-decoration: none; border-radius: 5px;">Baixar Relatório (CSV)</a>
        </div>
        <div style="text-align: center; margin-top: 30px;">
            <a href="{{ url('/') }}" class="btn" style="padding: 10px 20px; background-color: #f60909; color: white; text-decoration: none; border-radius: 5px;">Voltar para a Página Inicial</a>
        </div>
    @endif
</div>

</body>
</html>
