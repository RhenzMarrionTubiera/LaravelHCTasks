<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tasks;

class StatusController extends Controller
{
    public function index()
    {
        $tasks = Tasks::all();

        return view('index', compact('tasks'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'status'=>'required'
        ]);

        $tasks = Tasks::find($id);
        $tasks->status = $request->get('status');
        $tasks->save();

        return redirect('/tasks')->with('success', 'Task status has been updated');
    }
}
