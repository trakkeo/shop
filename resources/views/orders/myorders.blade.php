@extends('base')

@section('title', 'Mes commandes')

@section('content')
<div class="container">
    <h1>@yield('title')</h1>


<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Date</th>
            <th>Total</th>
            <th>Statut</th>
            <th class="text-end">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach(Auth::user()->orders as $order)
        <tr>
            <td>{{ $order->id }}</td>
            <td>{{ $order->created_at }}</td>
            <td>{{ $order->total_price }}€</td>
            <td>{{ $order->status }}</td>
            <td class="text-end">
                <a href="{{ route('orders.show', $order) }}" class="btn btn-info">Voir</a>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection