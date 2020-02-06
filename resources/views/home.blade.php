@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Liste des utilisateurs enregistrés</div>
                <div class="card-body">
                    @if ($currentUser->admin == true)
                        <div class="alert alert-dark">
                            <a href="{{ route('admin') }}">Accéder à l'espace admin</a>
                        </div>
                    @endif
                    @foreach ($userList as $user)
                        <div class="alert alert-info">
                            <p>Surnom: {{ $user['name']  }} </p>
                            <p>Prénom: {{ $user['firstname']  }} </p>
                            <p>Nom: {{ $user['lastname'] }} </p>
                            <p>Email: {{ $user['email'] }} </p>
                            <p>Bio: {{ !empty($user['bio']) ? $user['bio'] : "Pas de bio" }} </p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
