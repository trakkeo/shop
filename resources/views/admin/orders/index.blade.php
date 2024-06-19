@extends('admin.admin')

@section('title', 'Toutes les commandes')

@section('content')
    <div class="d-flex justify-content-between align-items-center">
        <h1>@yield('title')</h1>
    </div>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Utilisateur</th>
                <th>Date</th>
                <th>Total</th>
                <th>Statut</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->id }}</td>
                    <td>{{ $order->user->first_name }} {{ $order->user->last_name }}</td>
                    <td>{{ $order->created_at }}</td>
                    <td>{{ $order->total_price }}€</td>
                    <td>{{ $order->status }}</td>
                    <td class="text-end">
                        <a href="{{ route('admin.orders.show', $order) }}" class="btn btn-info">Voir</a>
                        <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary">Éditer</a>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
