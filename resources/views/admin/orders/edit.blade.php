@extends('admin.admin')

@section('title', 'Éditer la commande')

@section('content')
    <h1>@yield('title')</h1>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

        <h1>Commande #{{ $order->id }}</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Total: {{ $order->total_price }} €</p>
    <p>Nom : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
    <p>Email : {{ $order->user->email }}</p>
               

        <div class="mb-3">
            <label for="status" class="form-label">Statut</label>
            <select class="form-control" id="status" name="status">
                <option value="pending" {{ $order->status == 'pending' ? 'selected' : '' }}>En attente</option>
                <option value="completed" {{ $order->status == 'completed' ? 'selected' : '' }}>Complétée</option>
                <option value="cancelled" {{ $order->status == 'cancelled' ? 'selected' : '' }}>Annulée</option>
            </select>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
@endsection
