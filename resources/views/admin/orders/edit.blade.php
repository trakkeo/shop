@extends('admin.admin')

@section('title', 'Éditer la commande')

@section('content')
    <h1>@yield('title')</h1>

    <form action="{{ route('admin.orders.update', $order) }}" method="POST">
        @csrf
        @method('PUT')

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
