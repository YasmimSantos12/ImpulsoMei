<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Relatório de Usuários</title>
    <style>
        body {
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        th,
        td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            font-size: 12px;
        }

        th {
            background-color: #f2f2f2;
        }

        h1 {
            text-align: center;
            color: #333;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            text-align: center;
            font-size: 10px;
            color: #777;
        }
    </style>
</head>

<body>
    <h1>Relatório de Usuários Cadastrados</h1>
    <p>Data de geração: {{ date('d/m/Y H:i') }}</p>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nome do Negócio</th>
                <th>Responsável</th>
                <th>Email</th>
                <th>Data Cadastro</th>
            </tr>
        </thead>
        <tbody>
            @foreach($dados as $negocio)
                <tr>
                    <td>{{ $negocio->id }}</td>
                    <td>{{ $negocio->name_negocio }}</td>
                    <td>{{ $negocio->name_user }}</td>
                    <td>{{ $negocio->email }}</td>
                    <td>{{ $negocio->created_at->format('d/m/Y H:i') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Impulso MEI - Relatório Administrativo
    </div>
</body>

</html>