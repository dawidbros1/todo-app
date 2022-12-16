<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

class TaskController extends Controller
{
    // Metoda do dodawania kategorii
    public function store(StoreRequest $request, $category)
    {
        $task = Task::make([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
            'category_id' => $category,
        ]);

        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        $request->validated();
        $task->save();

        return back()->withSuccess('Zadanie zostało dodane');
    }

    public function update(StoreRequest $request, Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

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
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        return view('task.edit', [
            'task' => $task,
        ]);
    }

    public function delete(Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        $task->delete();
        return back()->withSuccess("Zadanie zostało usunięte");
    }

    public function finish(Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        $task->update([
            'status' => 'finished',
            'finished_at' => Carbon::now('Europe/Warsaw'),
        ]);

        return back()->withSuccess("Zadanie zostało ukończone");
    }

    private function unauthorized()
    {
        return redirect()->route('category.index')->with('error', "Brak uprawnień do wykonania akcji");
    }
}

# Zadań po terminiu nie można edytować oraz usuwać => tylko zakonczyć
# Czy w update ma być możliwość zmiany terminu ?
