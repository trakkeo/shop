<!doctype html>
<html lang="fr">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <link href="/resources/css/app.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  <title>@yield('title') | InnovShop</title>
  <style>
    @layer reset {
      button {
        all: unset;
      }
    }

    .htmx-indicator {
      display: none;
    }

    .htmx-request .htmx-indicator {
      display: inline-block;
    }

    .htmx-request.htmx-indicator {
      display: inline-block;
    }

    .bg-primary {
      --bs-bg-opacity: 1;
      background-color: black !important;
    }

    .card-body {
        height: 15em !important;
      }
    
  </style>
</head>

<body>


  <nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container-fluid">
    <a class="navbar-brand" href="/">
            <img src="{{ asset('images/logo_innovshop_rect.jpg') }}" alt="Logo" style="height: 40px;">
            
        </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      @php
      $route = request()->route()->getName();
      @endphp
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="{{ route('product.index') }}" @class(['nav-link', 'active'=> str_contains($route, 'product.')])>Produits</a>
          </li>
        </ul>
        @auth
        <ul class="navbar-nav ms-auto">
          <li class="nav-item">
            <a href="{{ route('cart.show') }}" class="nav-link">Panier</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('orders.myorders') }}" class="nav-link">Mes Commandes</a>
          </li>
          <li class="nav-item">
            <a href="{{ route('contact.show') }}" class="nav-link">Contact</a>
          </li>
          <li class="nav-item">
          <a href="{{ route('users.myaccount') }}" class="nav-link">Mon Compte</a>
          </li>
          @if(Auth::user()->role == 'admin')
          <li class="nav-item">
            <a href="{{ route('admin.product.index') }}" class="nav-link">Admin</a>
          </li>
          @endif
        </ul>
        @endauth
      </div>
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
        @guest
                <ul class="navbar-nav">
                  <li class="nav-item">
                    <a href="{{ route('login') }}" class="nav-link">Se connecter</a>
                  </li>
                </ul>
                @endguest
      </div>
    </div>
  </nav>



  @yield('content')

</body>

</html>