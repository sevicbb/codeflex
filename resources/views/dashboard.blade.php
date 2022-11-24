<?php

use App\Models\Currency;

?>

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

        .c-sortable-column:disabled {
            color: white;
        }

        .c-zero-inventory {
            color: red;
        }
    </style>
</head>

<body class="antialiased">
    <div class="container mt-5 mb-5">
        <div class="row">
            <div class="col-sm"> @include('tax') </div>
            <div class="col-sm"> @include('currency-converter')</div>
        </div>

        <div class="row">
            <div class="col-sm"> @include('search') </div>
            <div class="col-sm"> @include('warehouses') </div>
        </div>

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
                        @include('components.column', ['label' => 'Inventory'])
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
                            <td>{{ Currency::selectedCurrency()->symbol . ' ' . $part->calculatedPrice }}</td>
                            <td>{{ Currency::selectedCurrency()->symbol . ' ' . $part->priceWithTax }}</td>
                            <td> @include('components.inventory-form', ['part' => $part]) </td>
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