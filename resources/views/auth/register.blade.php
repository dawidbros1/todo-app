@extends('layouts/app')
@section('title', 'Rejestracja')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/auth.css') }}">
@endsection('css')

@section('content')

    <div class="row">
        <div id="login" class="col-10 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <img id="logo" class="fs-2 text-center mx-auto d-block" src="{{ asset('images/logo/logo_no_string.png') }}" />

            <h1 class="text-center fs-3">Zarejestruj się</h1>

            <form method="post" action="{{ route('register.submit') }}">
                @csrf

                <div class="input-group mt-3">
                    <span class="input-group-text"></span>
                    <input type="text" value="{{ old('name') }}" name="name" class="form-control"
                        autocomplete="name" placeholder="Nazwa użytkownika" required autofocus />

                    @component('components.form.error', ['name' => 'name'])
                    @endcomponent
                </div>

                <div class="input-group mt-3">
                    <span class="input-group-text"></span>
                    <input type="email" value="{{ old('email') }}" name="email" class="form-control"
                        autocomplete="email" placeholder="Adres email" required />

                    @component('components.form.error', ['name' => 'email'])
                    @endcomponent
                </div>

                <div class="input-group my-3">
                    <span class="input-group-text"></span>
                    <input type="password" name="password" class="form-control" autocomplete="current-password"
                        placeholder="Hasło" required />
                    @component('components.form.error', ['name' => 'password'])
                    @endcomponent
                </div>

                <button class="btn btn-primary w-100" type="submit">Zarejestruj się</button>
            </form>

            <p class="text-center mt-3">Masz już konto? <a href="{{ route('login') }}">Zaloguj się</a></p>
        </div>

        <div id="right-side" class="col-8 d-none d-lg-block position-relative">
            <div id="right-center" class="center fs-1 text-white">Dołącz do nas</div>
        </div>
    </div>
@endsection('content')
