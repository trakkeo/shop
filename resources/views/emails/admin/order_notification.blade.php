<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Nouvelle commande passée</title>
</head>
<body>
    <h1>Nouvelle commande passée</h1>
    <p>Commande #{{ $order->id }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Total: {{ $order->total_price }} €</p>

    <h2>Détails de la commande</h2>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->price }} €</li>
        @endforeach
    </ul>

    <h2>Informations sur le client</h2>
    <p>Nom : {{ $order->user->first_name }} {{ $order->user->last_name }}</p>
    <p>Email : {{ $order->user->email }}</p>
</body>
</html>
