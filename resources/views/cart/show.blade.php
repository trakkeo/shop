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
    @else
        <p>Votre panier est vide.</p>
    @endif
</div>
@endsection
