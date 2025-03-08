<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Página de Vendas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #2f4050;
            color: #ffffff;
        }
        .container {
            text-align: center;
            margin-top: 20%;
        }
        .btn-custom {
            background-color: #1ab394;
            border-color: #1ab394;
            color: #ffffff;
        }
        .btn-custom:hover {
            background-color: #18a689;
            border-color: #18a689;
        }
    </style>
</head>
<body>
    
    <div class="container">
        <h2>Menu</h2>
        @include('sale.message')
        <a href="{{ route('sale.index') }}}" class="btn btn-custom btn-lg m-2">Nova venda</a>
        <a href="#" class="btn btn-custom btn-lg m-2">Imprimir NFC-e</a>
    </div>
</body>
</html>
