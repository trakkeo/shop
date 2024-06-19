@extends('base')

@section('title', 'Commande')

@section('content')
<div class="container">
    <h1>Commande #{{ $order->id }}</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Total: {{ $order->total_price }} €</p>

    <p>Email : {{ $order->user->email }}</p>
    <div class="row">
        <div class="col-md-6">

            <h2>Adresse de facturation</h2>
            <p>Nom : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
            <p>Adresse : {{ $order->user->address1 }}</p>
            @if($order->user->address2)
            <p>Complément d'adresse : {{ $order->user->address2 }}</p>
            @endif
            <p>Code postal : {{ $order->user->postal_code }}</p>
            <p>Ville : {{ $order->user->city }}</p>
        </div>
        <div class="col-md-6">
            <h2>Adresse de livraison</h2>
            @php
                $activeAddress = $order->user->addresses->where('is_active', true)->first();
            @endphp
            @if($activeAddress)
                <p>Nom : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
                <p>Adresse : {{ $activeAddress->address1 }}</p>
                @if($activeAddress->address2)
                <p>Complément d'adresse : {{ $activeAddress->address2 }}</p>
                @endif
                <p>Code postal : {{ $activeAddress->postal_code }}</p>
                <p>Ville : {{ $activeAddress->city }}</p>
                <p>Pays : {{ $activeAddress->country }}</p>
            @else
                <p>Identique à l'adresse de facturation</p>
            @endif
            @if ($order->status === 'pending')
                        <a href="{{ route('addresses.index') }}" class="btn btn-primary mt-2">Changer mon adresse de livraison préférée</a>
            @endif
        </div>
    </div>


    <h2>Articles</h2>
    <table class="table">
        <thead>
            <tr>
                <th>Produit</th>
                <th>Options</th>
                <th>Quantité</th>
                <th>Prix unitaire</th>
                <th>Total</th>
            </tr>
        </thead>
        <tbody>
            @foreach($order->items as $item)
            <tr>
                <td>{{ $item->product->name }}</td>
                @if($item->options)
                                        <td>
                                            <ul>
                                                @foreach(json_decode($item->options) as $key => $value)
                                                    <li>{{ $key }}: {{ $value }}</li>
                                                @endforeach
                                            </ul>
                                        </td>
                                    @endif
                <td>{{ $item->quantity }}</td>
                <td>{{ $item->price }} €</td>
                <td>{{ $item->price * $item->quantity }} €</td>
                <td>
            </tr>
            @endforeach
        </tbody>
    </table>

    @if ($order->status === 'pending')
    <div class="mt-4">
        <form action="{{ route('orders.confirm', $order) }}" method="POST">
            @csrf
            <button type="submit" class="btn btn-success">Valider la commande</button>
        </form>
    </div>
    @endif
</div>
@endsection