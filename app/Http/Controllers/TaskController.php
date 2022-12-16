<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Carbon\Carbon;

class TaskController extends Controller
{
    // Metoda do dodawania kategorii
    public function store(StoreRequest $request, $category)
    {
        $request->validated();

        Task::created([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'category_id' => $category,
        ]);

        return back()->withSuccess('Zadanie zostało dodane');
    }

    public function update(StoreRequest $request, Task $task)
    {
        $request->validated();

        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('category.show', $task->category)->withSuccess("Dane zostały zaktualizowane");
    }

    public function edit(Task $task)
    {
        return view('task.edit', [
            'task' => $task,
        ]);
    }

    public function delete(Task $task)
    {
        $task->delete();
        return back()->withSuccess("Zadanie zostało usunięte");
    }

    public function finish(Task $task)
    {
        $task->update([
            'status' => 'finished',
            'finished_at' => Carbon::now('Europe/Warsaw'),
        ]);

        return back()->withSuccess("Zadanie zostało ukończone");
    }
}

# Zadań po terminiu nie można edytować oraz usuwać => tylko zakonczyć
# Czy w update ma być możliwość zmiany terminu ?
