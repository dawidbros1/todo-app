@extends('layouts/app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/category.css') }}">
@endsection('css')

@section('content')
    <div id="category-show" class="col-9 mx-auto">
        <h1 class="text-center">{{ $category->name }}</h1>
        <div id="task-form">
            <form method="post" action="{{ route('task.store', $category) }}">
                @csrf

                <div class="my-3">
                    <div class="row">
                        <div class="col-9">
                            <input type="text" value="{{ old('name') }}" name="name" class="form-control w-100"
                                autocomplete="name" placeholder="Nazwa zadania" required autofocus />

                            @component('components.form.error', ['name' => 'name'])
                            @endcomponent
                        </div>

                        <div class="col-3">
                            <input type="datetime-local" id="deadline" name="deadline"
                                value="{{ old('deadline', $deadline->format('Y-m-d\TH:i')) }}" class="form-control"
                                timezone="UTC+1" />

                            @component('components.form.error', ['name' => 'deadline'])
                            @endcomponent
                        </div>
                    </div>

                    <div class="row my-2">
                        <div class="col-9">
                            <textarea name="description" class="form-control" rows="2" placeholder="Krótki opis zadania">{{ old('description') }}</textarea>

                            @component('components.form.error', ['name' => 'description'])
                            @endcomponent
                        </div>

                        <div class="col-3">
                            <button id="storeTask" class="btn-primary col-12" type="submit">Dodaj zadanie</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>

        <table class="table">
            <thead>
                <tr>
                    <th>Nr</th>
                    <th>Nazwa</th>
                    <th>Opis</th>
                    <th>Dodano</th>
                    <th>Zakończono</th>
                    <th>Termin</th>
                    <th class="col-1"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($category->tasks() as $index => $task)
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td class="fw-bold">{{ $task->name }}</td>
                        <td><img title="{{ $task->description }}" class="info" src="{{ asset('images/info.png') }}">
                        </td>
                        <td>{{ $task->created_at->format('Y-m-d H:i') }}</td>
                        <td>
                            @if ($task->finished_at)
                                {{ $task->finished_at->format('Y-m-d H:i') }}
                            @else
                                Nieukończone
                            @endif
                        </td>
                        <td class="{{ $task->color }}">{{ $task->deadline->format('Y-m-d H:i') }}</td>

                        <td>
                            @if ($task->status == 'active')
                                <div class="d-flex text-right">
                                    <form action="{{ route('task.delete', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger">Usuń</button>
                                    </form>

                                    <a href="{{ route('task.edit', $task) }}">
                                        <button type="submit" class="btn btn-primary mx-2">EDYTUJ</button>
                                    </a>

                                    <form action="{{ route('task.finish', $task) }}" method="POST" class="d-inline">
                                        @csrf
                                        @method('PUT')
                                        <button type="submit" class="btn btn-success">ZAKOŃCZ</button>
                                    </form>
                                </div>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection('content')
