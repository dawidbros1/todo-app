<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Task\StoreRequest;
use App\Models\Task;
use Carbon\Carbon;
use Illuminate\Support\Facades\Gate;

# php artisan make:controller TaskController
class TaskController extends Controller
{
    # Method adds task to category
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

    # Method updates data in task
    public function update(StoreRequest $request, Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        # if ( [ now() > task->deadline ] or [ task is finished ] )
        # => user cannot update data in task
        if ($task->can_manage === false) {
            return $this->cannotManage($task);
        }

        $request->validated();

        $task->update([
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'deadline' => $request->input('deadline'),
        ]);

        return redirect()->route('category.show', $task->category)->withSuccess("Dane zostały zaktualizowane");
    }

    # Method return view
    public function edit(Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        if ($task->can_manage === false) {
            return $this->cannotManage($task);
        }

        return view('task.edit', [
            'task' => $task,
        ]);
    }

    # Method deletes task
    public function delete(Task $task)
    {
        if (Gate::inspect('manage', $task)->allowed() === false) {
            return $this->unauthorized();
        }

        if ($task->can_manage === false) {
            return $this->cannotManage($task);
        }

        $task->delete();
        return back()->withSuccess("Zadanie zostało usunięte");
    }

    # Method completes tasks
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

    # Method redirect user to route('category.index')
    # when user don't have permissions to task
    private function unauthorized()
    {
        return redirect()->route('category.index')->with('error', "Brak uprawnień do wykonania akcji");
    }

    # Method redirect user to route('category.show') when he try do something on task
    # WHEN [ now() > task->deadline ] or [ task is finished ]
    # exclude method finish
    private function cannotManage($task)
    {
        return redirect()->route('category.show', $task->category)->with('error', "Tego zadania nie można już edytować");
    }
}
