<?php

namespace App\Http\Controllers;

use App\Models\Status;
use Illuminate\Http\Request;
use Validator;

class StatusController extends Controller
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
        $statuses = Status::all();
        //RUSIAVIMAS
        if ($request->sort && 'asc' == $request->sort) {
            $statuses = $statuses->sortBy('name');
            $sortBy = 'asc';
        } elseif ($request->sort && 'desc' == $request->sort) {
            $statuses = $statuses->sortByDesc('name');
            $sortBy = 'desc';
        }





        return view('status.index', [
            'statuses' => $statuses,
            'sortBy' => $sortBy ?? '',
            'filterBy' => $filterBy ?? 0,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('status.create');
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
                'status_name' => ['required', 'min:3', 'max:64', 'alpha'],

            ],
            [
                'status_name.min' => 'Status name must be at least 3 chars long',
                'status_name.max' => 'Status name must be at least 3 chars long',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }

        $status = new Status;
        $status->name = $request->status_name;

        $status->save();
        return redirect()->route('status.index')->with('success_message', 'Status was added');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function show(Status $status)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function edit(Status $status)
    {
        return view('status.edit', ['status' => $status]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Status $status)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'status_name' => ['required', 'min:3', 'max:64', 'alpha'],

            ],
            [
                'status_name.min' => 'Status name must be at least 3 chars long',
                'status_name.max' => 'Status name must be at least 3 chars long',
            ]
        );
        if ($validator->fails()) {
            $request->flash();
            return redirect()->back()->withErrors($validator);
        }
        $status->name = $request->status_name;

        $status->save();
        return redirect()->route('status.index')->with('success_message', 'Status was updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Status  $status
     * @return \Illuminate\Http\Response
     */
    public function destroy(Status $status)
    {
        if ($status->statusTask->count()) {
            return redirect()->route('status.index')->with('info_message', 'do not delete status with existing tasks');
        }
        $status->delete();
        return redirect()->route('status.index')->with('info_message', 'Status was deleted');
    }
}