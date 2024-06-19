@extends('base')

@section('content')
<div class="container">
    <h1>Votre panier</h1>
    @if($cart && $cart->items->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
                <th>Options</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($cart->items as $item)
    <tr>
        <td>{{ $item->product->name }}</td>
        <td>{{ $item->quantity }}</td>
        <td>{{ $item->price }} €</td>
        <td>{{ $item->price * $item->quantity }} €</td>
        <td>
    @php
        $options = json_decode($item->options, true);
    @endphp
    @if($options && is_array($options))
        <ul>
            @foreach($options as $key => $value)
                <li>{{ ucfirst($key) }}: {{ $value }}</li>
            @endforeach
        </ul>
    @else
        <p>No options selected</p>
    @endif
        </td>
        <td>
            <form action="{{ route('cart.remove', $item->id) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </td>
    </tr>
@endforeach
        </tbody>
    </table>
    <h3>Total : {{ $cart->total_price }} €</h3>
    <form action="{{ route('orders.store') }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-primary">Valider la commande</button>
        </form>
    @else
    <p>Votre panier est vide.</p>
    @endif
</div>
@endsection