<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Merci pour votre commande !</title>
</head>
<body>
    <h1>Merci pour votre commande sur InnovShop</h1>
    <h2>Récapitulatif de votre commande</h2>
    <p>Commande #{{ $order->id }}</p>
    <p>Status: {{ $order->status }}</p>
    <p>Total: {{ $order->total_price }} €</p>

    <h2>Détails de la commande</h2>
    <ul>
        @foreach ($order->items as $item)
            <li>{{ $item->product->name }} - {{ $item->quantity }} x {{ $item->price }} €</li>
        @endforeach
    </ul>
    <p>Nous reviendrons vers vous très bientôt pour vous informer de son expédition.</p>
    <p>Cordialement,</p>
    <p>L'équipe de InnovShop</p>
    <p><small>Vous recevez ce courriel car vous avez commandé sur notre site.</small></p>
    <p><small>Si vous n'êtes pas à l'origine de cette commande, merci de ne pas y répondre.</small></p>
</body>
</html>