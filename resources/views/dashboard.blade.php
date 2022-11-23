<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">

    <title>Dashboard</title>

    <style>
        .c-sortable-column {
            color: white;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mt-5 mb-5">

        @include('tax')
        @include('search')

        <div class="container">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        @include('components.sortable-column', ['label' => 'ID', 'field' => 'identifier'])
                        @include('components.sortable-column', ['label' => 'Description', 'field' => 'description'])
                        @include('components.sortable-column', ['label' => 'Brand', 'field' => 'brand'])
                        @include('components.sortable-column', ['label' => 'Color', 'field' => 'color'])
                        @include('components.sortable-column', ['label' => 'Price', 'field' => 'price'])
                        @include('components.sortable-column', ['label' => 'Price with tax', 'field' => 'price'])
                    </tr>
                </thead>
                <tbody>
                    @foreach ($parts as $part)
                    <a href="{{ route('part.index') }}">
                        <tr>
                            <th scope="row">{{ $part->identifier }}</th>
                            <td>{{ $part->description }}</td>
                            <td>{{ $part->brand }}</td>
                            <td>{{ $part->color }}</td>
                            <td>{{ $part->price }}</td>
                            <td>{{ $part->priceWithTax }}</td>
                        </tr>
                    </a>
                    @endforeach
                </tbody>
            </table>

            <div class="d-flex justify-content-center">
                {!! $parts->links() !!}
            </div>
        </div>
    </div>
</body>

</html>