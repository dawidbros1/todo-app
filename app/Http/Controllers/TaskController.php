<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    // Metoda do dodawania kategorii
    public function store(Request $request, $category)
    {
        $validatedData = $request->validate([
            'name' => 'required|min:6|max:255',
            'description' => 'required',
        ]);

        $task = new Task();
        $task->name = $request->name;
        $task->description = $request->description;
        $task->deadline = $request->input('deadline');
        $task->category_id = $category; // id

        $task->save();

        return back()->withSuccess('Zadanie zostało dodane');
    }

    public function update(Request $request, Task $task)
    {
        $task->name = $request->input('name');
        $task->description = $request->input('description');
        $task->deadline = $request->input('deadline');
        $task->save();

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
        $task->status = "finished";
        $task->finished_at = Carbon::now('Europe/Warsaw');
        $task->save();
        return back()->withSuccess("Zadanie zostało ukończone");
    }
}
