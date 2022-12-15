@extends('layouts/app')
@section('title', 'Lista kategorii')

@section('js')
    <script src="{{ asset('js/category.js') }}"></script>
@endsection('js')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection('css')

@section('content')
    <div id="category-list" class="row px-3 gx-3 my-2">
        <h1 class="text-center mb-3">Kategorie zadań</h1>

        <div class="col-3 mb-3">
            <div class="card">
                <div class="card-body">
                    <form method="post" action="{{ route('category.store') }}">
                        @csrf
                        <h5 class="card-title">
                            <div>Dodaj nową kategorię</div>
                        </h5>
                        <div class="d-flex flex-wrap">
                            <input type="text" class="form-control w-75" name="name" placeholder="Nazwa kategorii">
                            <button type="submit" class="btn btn-primary offset-1">Dodaj</button>
                        </div>

                        @component('components.form.error', ['name' => 'name'])
                        @endcomponent
                    </form>
                </div>
            </div>
        </div>

        @foreach ($categories as $category)
            <div class="col-3 mb-3">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">
                            <a class="text-primary text-decoration-none"
                                href="{{ route('category.show', $category) }}">{{ $category->name }}</a>
                        </h5>
                        <div class="d-flex flex-wrap">
                            <button class="btn btn-primary me-1 ms-auto edit-handle">Edytuj</button>
                            <form action="{{ route('category.delete', $category) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Usuń</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    @foreach ($categories as $category)
        <div class="center w-50 bg-light p-3 border d-none edit-wrapper" data-id="{{ $category->id }}">
            <h1 class="text-center fs-4">Edytuj kategorię</h1>
            <form method="post" action="{{ route('category.update', $category) }}">
                @csrf
                @method('PUT')
                <div class="input-group my-3">
                    <span class="input-group-text"></span>
                    <input type="text" value="{{ $category->name }}" name="name" class="form-control input-name"
                        autocomplete="name" placeholder="Nazwa kategorii" required autofocus />
                </div>

                <div class="d-flex">
                    <button class="btn btn-success col-8" type="submit">Edytuj kategorię</button>
                    <button class="btn btn-primary offset-1 col-3 close-edit-form-handle" type="button">Zamknij</button>
                </div>
            </form>
        </div>
    @endforeach
@endsection('content')
