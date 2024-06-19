@extends('admin.admin')

@section('content')
<div class="container">
    <h1>Détails de l'utilisateur</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $user->first_name }} {{ $user->last_name }}</h5>
            <p class="card-text"><strong>Email:</strong> {{ $user->email }}</p>
            <p class="card-text"><strong>Rôle:</strong> {{ $user->role }}</p>
            <p class="card-text"><strong>Adresse 1:</strong> {{ $user->address1 }}</p>
            <p class="card-text"><strong>Adresse 2:</strong> {{ $user->address2 }}</p>
            <p class="card-text"><strong>Code Postal:</strong> {{ $user->postal_code }}</p>
            <p class="card-text"><strong>Ville:</strong> {{ $user->city }}</p>
            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-primary">Éditer</a>
            <form action="{{ route('users.destroy', $user->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Supprimer</button>
            </form>
        </div>
    </div>
</div>
@endsection