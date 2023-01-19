<!DOCTYPE html>
<html>

<head>
    <title>Mail Notify - Crud Users</title>
</head>

<body>
    <h1>{{ $mailData['title'] }}</h1>
    <p>{{ $mailData['body'] }}</p>


    @if ($mailData['tipo'] == 1)
        <h3>Resumen Por Paises</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Pais</th>
                    <th scope="col"></th>
                    <th scope="col">Cantidad</th>
                </tr>
            </thead>
            <tbody>

            @foreach( $mailData['countries'] as $key => $countrie)
                @if ($countrie->users->count() > 0 )
                    <tr>
                        <td>{{ $countrie->nombre }}</td>
                        <td> => </td>
                        <td>{{ $countrie->users->count() }}</td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
        <br><br>
        <h3>Resumen Por Categorias</h3>
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">Categoria</th>
                    <th scope="col"></th>
                    <th scope="col">Cantidad</th>
                </tr>
            </thead>
            <tbody>

            @foreach( $mailData['categorias'] as $key => $categoria)
                @if ($categoria->users->count() > 0 )
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td> => </td>
                        <td>{{ $categoria->users->count() }}</td>
                    </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    @endif

</body>

</html>
