@extends('layouts/app')
@section('title', 'Edycja kategorii')

@section('content')
    <div class="row">
        <div class="col-10 col-sm-8 col-md-6 col-lg-4 mx-auto">
            <h1 class="text-center fs-3">Edytuj kategorię</h1>

            <form method="post" action="{{ route('category.update', $category->id) }}">
                @csrf
                @method('PUT')
                <div class="input-group my-3">
                    <span class="input-group-text"></span>
                    <input type="text" value="{{ old('name', $category->name) }}" name="name" class="form-control"
                        autocomplete="name" placeholder="Nazwa użytkownika" required autofocus />

                    @component('components.form.error', ['name' => 'name'])
                    @endcomponent
                </div>

                <button class="btn btn-primary w-100" type="submit">Edytuj kategorię</button>
            </form>
        </div>
    </div>
@endsection('content')
