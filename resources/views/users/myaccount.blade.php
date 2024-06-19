@extends('base')

@section('title', 'Mon Compte')

@section('content')
<div class="container">
    <h1>Mon Compte</h1>
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif
    <form action="{{ route('users.updateMyAccount') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="first_name" class="form-label">Prénom</label>
            <input type="text" class="form-control" id="first_name" name="first_name" value="{{ $user->first_name }}" required>
        </div>

        <div class="mb-3">
            <label for="last_name" class="form-label">Nom</label>
            <input type="text" class="form-control" id="last_name" name="last_name" value="{{ $user->last_name }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $user->email }}" required>
        </div>

        <div class="mb-3">
    <label for="password" class="form-label">Mot de passe</label>
    <input type="password" class="form-control" id="password" name="password">
    <small id="passwordHelpBlock" class="form-text text-muted">
        Laissez vide si vous ne souhaitez pas changer le mot de passe.
    </small>
    @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
</div>

<div class="mb-3">
    <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
    <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
</div>

        <div class="mb-3">
            <label for="address1" class="form-label">Adresse 1</label>
            <input type="text" class="form-control" id="address1" name="address1" value="{{ $user->address1 }}" required>
        </div>

        <div class="mb-3">
            <label for="address2" class="form-label">Adresse 2</label>
            <input type="text" class="form-control" id="address2" name="address2" value="{{ $user->address2 }}">
        </div>

        <div class="mb-3">
            <label for="postal_code" class="form-label">Code Postal</label>
            <input type="text" class="form-control" id="postal_code" name="postal_code" value="{{ $user->postal_code }}" required>
        </div>

        <div class="mb-3">
            <label for="city" class="form-label">Ville</label>
            <input type="text" class="form-control" id="city" name="city" value="{{ $user->city }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
