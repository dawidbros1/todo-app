<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Category\StoreRequest;
use App\Models\Category;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;

# php artisan make:controller CategoryController
class CategoryController extends Controller
{
    # Method displays all categories for current logged in user
    public function index()
    {
        $categories = Category::where('user_id', Auth::id())->get();

        return view('category.list', [
            'categories' => $categories,
        ]);
    }

    # Metoda adds category to DB
    public function store(Request $request)
    {
        $store = new StoreRequest();
        $validator = Validator::make($request->all(), $store->rules(), $store->messages());

        if ($validator->fails()) {
            $error = $validator->errors()->messages()['name'][0];
            return back()->with('error', $error);
        }

        $category = new Category(['name' => $request->input('name')]);
        $category->user_id = Auth::id();
        $category->save();

        return redirect()->route('category.index')->withSuccess('Kategoria została dodana');
    }

    # Method updates data in category
    public function update(Request $request, Category $category)
    {
        if (Gate::inspect('manage', $category)->allowed() === false) {
            return $this->unauthorized();
        }

        $store = new StoreRequest();
        $validator = Validator::make($request->all(), $store->rules(), $store->messages());

        if ($validator->fails()) {
            return back()
                ->with('id', $category->id)
                ->with('value', $request->input('name'))
                ->withErrors($validator->errors());
        }

        $category->update(['name' => $request->input('name')]);
        return redirect()->route('category.index')->withSuccess("Kategoria zostła zaktualizowana");
    }

    # Method deletes category
    public function delete(Category $category)
    {
        if (Gate::inspect('manage', $category)->allowed() === false) {
            return $this->unauthorized();
        }

        $category->delete();
        return redirect()->route('category.index')->withSuccess("Kategoria zostala usunięta");
    }

    # Method shows tasks from category
    public function show(Category $category, Request $request)
    {
        if (Gate::inspect('manage', $category)->allowed() === false) {
            return $this->unauthorized();
        }

        $status = $request->input('status', "active");

        if ($status != "active" && $status != "finished") {
            return redirect()->route('category.show', $category);
        }

        $tasks = ($status === "active") ? $category->activeTasks() : $category->finishedTasks();

        return view('category.show', [
            'category' => $category,
            'tasks' => $tasks->get(),
            'deadline' => Carbon::now('Europe/Warsaw'),
        ]);
    }

    # Method redirect user to route('category.index')
    # when user don't have permissions to category
    private function unauthorized()
    {
        return redirect()->route('category.index')->with('error', "Brak uprawnień do wykonania akcji");
    }
}
