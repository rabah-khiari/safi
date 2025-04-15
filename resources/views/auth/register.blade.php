@extends('layouts.app')

@section('title', 'Register')

@section('content')

    <div class="container mt-3">
  
        <br>
      <h2 class="text-center">Registre </h2>
        <div  class="container  col-lg-5 col-md-8 col-sm-10">
            <form action="/register" method="POST" class="border m-2 p-2 shadow ">
                @csrf
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
                <div class="mb-3 mt-3 form-group">
                    <label for="email">Email:</label>
                    <input type="email" class="form-control input-sm" placeholder="Enter email" name="email">
                </div>
                <div class="mb-3 mt-3 form-group">
                    <label for="name">Nom:</label>
                    <input type="text" class="form-control input-sm" placeholder="Enter your name" name="name">
                </div>
                <div class="mb-3 form-group">
                    <label for="pwd">Mot de passe:</label>
                    <input type="password" class="form-control input-sm" placeholder="Enter password" name="password" required><br>
                    <input type="password" class="form-control input-sm" name="password_confirmation" placeholder="Confirm Password" required><br>
                </div>
                <button type="submit" class="btn btn-outline-info ">registre</button>
                <p>Vous avez déjà un compte ? <a href="/login">Connectez-vous ici</a></p>
            </form>
        </div>
        
    </div>
@endsection
