<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller{
    
    // Redirects to the tasks dashboard
    public function dashboard(Request $request) {
        return view('tasks.dashboard', [
            'tasks' => $request->user()->tasks->sortByDesc('updated_at') // this is a way of getting the most recent tasks at the top of the list.
        ]);
    }

    // Redirects to the tasks edit form
    public function edit(Task $task) {
        if(auth()->id() !== $task->user_id) abort(403, 'Unauthorized Action');

        return view('tasks.edit', [
            'task' => $task
        ]);
    }

    // Redirects to the tasks create form
    public function create() {
        return view('tasks.create');
    }

    // Creates a new task and stores it in the database.
    public function store(Request $request) {
        $data = $request->validate([
            'title' => ['required', 'min:3', 'max:35'],
            'description' => ['required', 'min:3', 'max:50']
        ]);

        $data['user_id'] = $request->user()->id;
        $data['active_task'] = boolval($request->boolean('active_task'));

        Task::create($data);

        return redirect('/dashboard');
    }
    
    // Updates/edits an existing task
    public function update(Request $request, Task $task) {
        if(auth()->id() !== $task->user_id) abort(403, 'Unauthorized Action');

        $data = $request->validate([
            'title' => ['required', 'min:3', 'max:35'],
            'description' => ['required', 'min:3', 'max:50']
        ]);

        $task->title = $data["title"];
        $task->description = $data["description"];
        $task->active_task = boolval($request->boolean('active_task'));

        $task->save();

        return redirect('/dashboard');
    }

    // Deletes a task
    public function destroy(Task $task) {
        if(auth()->id() !== $task->user_id) abort(403, 'Unauthorized Action');

        $task->delete();

        return redirect('/dashboard');
    }
}
