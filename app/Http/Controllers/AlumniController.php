<?php

namespace App\Http\Controllers;

use App\Models\alumni;
use App\Http\Requests\{StorealumniRequest, UpdatealumniRequest};
use Yajra\DataTables\Facades\DataTables;

class AlumniController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:alumni view')->only('index', 'show');
        $this->middleware('permission:alumni create')->only('create', 'store');
        $this->middleware('permission:alumni edit')->only('edit', 'update');
        $this->middleware('permission:alumni delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $alumni = alumni::query();

            return DataTables::of($alumni)
                ->addColumn('action', 'alumni.include.action')
                ->toJson();
        }

        return view('alumni.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('alumni.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorealumniRequest $request)
    {

        alumni::create($request->validated());

        return redirect()
            ->route('alumni.index')
            ->with('success', __('The alumni was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function show(alumni $alumni)
    {
        return view('alumni.show', compact('alumni'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function edit(alumni $alumni)
    {
        return view('alumni.edit', compact('alumni'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatealumniRequest $request, alumni $alumni)
    {

        $alumni->update($request->validated());

        return redirect()
            ->route('alumni.index')
            ->with('success', __('The alumni was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\alumni  $alumni
     * @return \Illuminate\Http\Response
     */
    public function destroy(alumni $alumni)
    {
        try {
            $alumni->delete();

            return redirect()
                ->route('alumni.index')
                ->with('success', __('The alumni was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('alumni.index')
                ->with('error', __("The alumni can't be deleted because it's related to another table."));
        }
    }
}
