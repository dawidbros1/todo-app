@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection('css')

@section('content')
    <div class="container">
        <h1 class="text-center">Edycja zadania</h1>
        <div id="task-form">
            <form method="post" action="{{ route('task.update', $task) }}">
                @csrf
                @method('PUT')

                <div class="my-3">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" value="{{ old('name', $task->name) }}" name="name"
                                class="form-control w-100" autocomplete="name" placeholder="Nazwa zadania" required
                                autofocus />

                            @component('components.form.error', ['name' => 'name'])
                            @endcomponent
                        </div>

                        <div class="col-3">
                            <input type="datetime-local" id="deadline" name="deadline"
                                value="{{ old('deadline', $task->deadline->format('Y-m-d\TH:i')) }}" class="form-control"
                                timezone="UTC+1" />

                            @component('components.form.error', ['name' => 'deadline'])
                            @endcomponent
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-9">
                            <textarea name="description" class="form-control" rows="2" placeholder="Krótki opis zadania">{{ old('description', $task->description) }}</textarea>

                            @component('components.form.error', ['name' => 'description'])
                            @endcomponent
                        </div>

                        <div class="col-3">
                            <button id="storeTask" class="btn-primary col-12" type="submit">Zaktualizuj dane</button>
                        </div>
                    </div>
                </div>
            </form>
            <a href="{{ route('category.show', $task->category) }}"><button id="storeTask" class="btn-primary col-12 py-2"
                    type="submit">POWRÓT</button></a>
        </div>
    </div>
@endsection('content')
