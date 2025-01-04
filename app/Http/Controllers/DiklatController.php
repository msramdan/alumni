<?php

namespace App\Http\Controllers;

use App\Models\Diklat;
use App\Http\Requests\{StoreDiklatRequest, UpdateDiklatRequest};
use Yajra\DataTables\Facades\DataTables;

class DiklatController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:diklat view')->only('index', 'show');
        $this->middleware('permission:diklat create')->only('create', 'store');
        $this->middleware('permission:diklat edit')->only('edit', 'update');
        $this->middleware('permission:diklat delete')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (request()->ajax()) {
            $diklats = Diklat::query();

            return DataTables::of($diklats)
                ->addColumn('action', 'diklats.include.action')
                ->toJson();
        }

        return view('diklats.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('diklats.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDiklatRequest $request)
    {
        
        Diklat::create($request->validated());

        return redirect()
            ->route('diklats.index')
            ->with('success', __('The diklat was created successfully.'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function show(Diklat $diklat)
    {
        return view('diklats.show', compact('diklat'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function edit(Diklat $diklat)
    {
        return view('diklats.edit', compact('diklat'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDiklatRequest $request, Diklat $diklat)
    {
        
        $diklat->update($request->validated());

        return redirect()
            ->route('diklats.index')
            ->with('success', __('The diklat was updated successfully.'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diklat  $diklat
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diklat $diklat)
    {
        try {
            $diklat->delete();

            return redirect()
                ->route('diklats.index')
                ->with('success', __('The diklat was deleted successfully.'));
        } catch (\Throwable $th) {
            return redirect()
                ->route('diklats.index')
                ->with('error', __("The diklat can't be deleted because it's related to another table."));
        }
    }
}
