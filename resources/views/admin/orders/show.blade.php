@extends('admin.admin')

@section('title', 'Détails de la commande')

@section('content')
<div class="container">
    <h1>Commacccnde #{{ $order->id }}</h1>
    <p>Status: {{ $order->status }}</p>
    <p>Total: {{ $order->total_price }} €</p>

    <h2>Coordonnées du client</h2>
    <p>Nom : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
    <p>Email : {{ $order->user->email }}</p>
    <p>Adresse : {{ $order->user->address1 }}</p>
    @if($order->user->address2)
        <p>Complément d'adresse : {{ $order->user->address2 }}</p>
    @endif
    <p>Code postal : {{ $order->user->postal_code }}</p>
    <p>Ville : {{ $order->user->city }}</p>

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
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="mt-4">
        <form action="{{ route('orders.confirm', $order) }}" method="POST">
            @csrf
            <a href="{{ route('admin.orders.edit', $order) }}" class="btn btn-primary">Éditer</a>
        </form>
        <a href="{{ route('users.edit', $order->user) }}" class="btn btn-primary mt-2">Modifier les coordonnées</a>
    </div>
</div>
@endsection
