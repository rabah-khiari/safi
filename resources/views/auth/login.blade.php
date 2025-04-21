@extends('layouts.app')

@section('title', 'login')

@section('content')

<div class="container mt-3">
  
    <br>
  <h2 class="text-center">bienvenue sur la page de connexion </h2>
    
    <div  class="container  col-lg-5 col-md-8 col-sm-10">
        <form action="/login" method="POST" class="border m-2 p-2 shadow ">
            @csrf
            {{-- to specify one error do : @if ($errors->has('login'))  --}}
            @if ($errors->any())
                <ul style="color: red;">
                    @foreach ($errors->all() as $error)
                        <li>
                            <div class="alert alert-danger">
                                <strong>Erreur!</strong> {{ $error }}
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
           
            <div class="mb-3 mt-3">
            <label for="email">Email:</label>
            <input type="email" class="form-control" placeholder="Enter email" name="email">
            </div>
            <div class="mb-3">
            <label for="pwd">Mot de passe:</label>
            <input type="password" class="form-control" placeholder="Enter password" name="password">
            </div>
            <button type="submit" class="btn btn-outline-info"> Se connecter</button>
            <p>Vous n'avez pas de compte ? <a href="/register">Inscrivez-vous ici</a></p>
        </form>
    </div>
    
</div>
@endsection