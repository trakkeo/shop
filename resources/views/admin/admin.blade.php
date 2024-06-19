<!doctype html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/css/tom-select.bootstrap5.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.2.2/dist/js/tom-select.complete.min.js"></script>
    <script src="https://unpkg.com/htmx.org@1.8.6"></script>
    <title>@yield('title') | Administration</title>
    <style>
      @layer reset {
        button {
          all: unset;
        }
      }
      .htmx-indicator{
        display:none;
      }
      .htmx-request .htmx-indicator{
        display:inline-block;
      }
      .htmx-request.htmx-indicator{
        display:inline-block;
      }
      .bg-primary {
    --bs-bg-opacity: 1;
    background-color: darkgrey !important;
}
       
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
        <a class="navbar-brand" href="/">InnovShop</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        @php
        $route = request()->route()->getName();
        @endphp
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a href="{{ route('admin.product.index') }}" @class(['nav-link', 'active' => str_contains($route, 'product.')])>Gérer les produits</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.option.index') }}"  @class(['nav-link', 'active' => str_contains($route, 'option.')])>Gérer les options</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.orders.index') }}"  @class(['nav-link', 'active' => str_contains($route, 'order.')])>Gérer les commandes</a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('users.index') }}"  @class(['nav-link', 'active' => str_contains($route, 'user.')])>Gérer les utilisateurs</a>
                </li>
            </ul>
            <div class="ms-auto">
                @auth
                    <ul class="navbar-nav">
                        <li class="nav-item">
                            <form action="{{ route('logout') }}" method="post">
                                @csrf
                                @method('delete')
                                <button class="nav-link">Se déconnecter</button>
                            </form>
                        </li>
                    </ul>
                @endauth
            </div>
        </div>
    </div>
</nav>

<div class="container mt-5">

    @include('shared.flash')

    @yield('content')
</div>

<script>
    new TomSelect('select[multiple]', {plugins: {remove_button: {title: 'Supprimer'}}})
</script>

</body>
</html>
