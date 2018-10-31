<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;

class TaskController extends Controller
{
    public function index()
    {
        $tasks = Tasks::all();

        return view('index', compact('tasks'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'=>'required',
            'description'=> 'required'
        ]);
        $tasks = new Tasks([
            'title' => $request->get('title'),
            'description'=> $request->get('description'),
            'status'=> 'Pending'
        ]);
        $tasks->save();
        return redirect('/tasks')->with('success', 'Task has been added');
    }

    public function edit($id)
    {
        $tasks = Tasks::find($id);

        return view('edit', compact('tasks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'title'=>'required',
            'description'=> 'required'
        ]);

        $tasks = Tasks::find($id);
        $tasks->title = $request->get('title');
        $tasks->description = $request->get('description');
        $tasks->save();

        return redirect('/tasks')->with('success', 'Task has been updated');
    }

    public function destroy($id)
    {
        $tasks = Tasks::find($id);
        $tasks->delete();

        return redirect('/tasks')->with('success', 'Task has been deleted Successfully');
    }
}
