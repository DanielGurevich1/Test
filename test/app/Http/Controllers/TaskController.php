<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\Status;
use Illuminate\Http\Request;
use Validator;
use PDF;

class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {


        if ($request->status_id) {
            $tasks  = Task::where('status_id', $request->status_id)->get();
            $filterBy = $request->status_id;
        } else {
            $tasks = Task::paginate(3);
        }
        // orderBy('completed')->get()


        if ($request->sort && 'asc' == $request->sort) {
            $tasks = $tasks->sortBy('name');
            $sortBy = 'asc';
        } elseif ($request->sort && 'desc' == $request->sort) {
            $tasks = $tasks->sortByDesc('completed');
            $sortBy = 'desc';
        }
        $statuses = Status::orderBy('name')->get();
        return view('task.index', [
            'tasks' => $tasks,
            'statuses' => $statuses,
            'filterBy' => $filterBy ?? 0,
            'sortBy' => $sortBy ?? ''
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statuses = Status::all();
        return view('task.create', ['statuses' => $statuses]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'task_name' => ['required', 'min:3', 'max:64'],
                'task_about' => ['required', 'min:3', 'max:164'],
                'task_completed' => ['required'],

            ],
            [
                'task_name.min' => 'Task name must be at least 3 chars long',
                'task_name.max' => 'Task name must be at least 3 chars long',
                'task_about' => 'About field is required',
                'task_completed' => 'About field is required',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $task = new Task;
        $task->name = $request->task_name;
        $task->about = $request->task_about;
        $task->completed = $request->task_completed;

        $task->status_id = $request->status_id;
        $task->save();
        return redirect()->route('task.index')->with('success_message', 'Task was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $statuses = Status::all();
        return view('task.edit', ['task' => $task, 'statuses' => $statuses]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'task_name' => ['required', 'min:3', 'max:64'],
                'task_about' => ['required', 'min:3', 'max:164'],
                'task_completed' => ['required'],

            ],
            [
                'task_name.min' => 'Task name must be at least 3 chars long',
                'task_name.max' => 'Task name must be at least 3 chars long',
                'task_about' => 'About field is required',
                'task_completed' => 'About field is required',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $task->name = $request->task_name;
        $task->about = $request->task_about;
        $task->completed = $request->task_completed;

        $task->status_id = $request->status_id;
        $task->save();
        return redirect()->route('task.index')->with('success_message', 'Task was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {


        $task->delete();
        return redirect()->route('task.index')->with('info_message', 'Task was deleted');
    }
    public function pdf(Task $task)
    {
        $pdf = PDF::loadView('task.pdf', ['task' => $task]);
        return $pdf->download('task_id' . $task->id . '.pdf');
    }
}
