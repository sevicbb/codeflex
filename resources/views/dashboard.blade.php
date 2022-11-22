<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Dashboard</title>
</head>

<body class="antialiased">
    <div class="container mt-5 mb-5">

        @include('tax')

        <div class="container">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Description</th>
                        <th scope="col">Brand</th>
                        <th scope="col">Color</th>
                        <th scope="col">Price</th>
                        <th scope="col">Price with tax</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parts as $part)
                    <tr>
                        <th scope="row">{{ $part->identifier }}</th>
                        <td>{{ $part->description }}</td>
                        <td>{{ $part->brand }}</td>
                        <td>{{ $part->color }}</td>
                        <td>{{ $part->price }}</td>
                        <td>{{ $part->priceWithTax }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>

</html>