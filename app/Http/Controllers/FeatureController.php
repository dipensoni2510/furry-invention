<?php

namespace App\Http\Controllers;

use App\Feature;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class FeatureController extends Controller
{
  public function index(Request $request)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['name' => "Feature List"]
    ];

    //      <a href='/companies/{$company->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
    //                 class='feather icon-eye'></i></a>

    if ($request->expectsJson()) {
      return DataTables::of(Feature::query())
        ->addIndexColumn()
        ->addColumn('actions',  function ($feature) {
          return
            "<a href='/features/{$feature->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>
                 <a href='#' type='button' data-id='{$feature->id}' data-toggle='tooltip' data-placement='top' title='Delete' class='button-delete-action pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-trash-2'></i></a>";
        })->rawColumns(['actions'])
        ->toJson();
    }
    //      <a href='/companies/{$company->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
    //                 class='feather icon-edit'></i></a>
    return view('pages.feature.view', ['breadcrumbs' => $breadcrumbs]);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/features", 'name' => "Feature List"], ['name' => "Create"]
    ];
    return view('pages.feature.create', ['breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Feature $feature)
  {
    $validate = request()->validate(
      [
        'name' => ['required', 'unique:features'],
      ],
      [
        'name.required' => 'Feature required.',
        'name.unique' => 'Feature already available.'
      ]
    );
    $feature->create($validate);
    return redirect()->route('features.index')->with('message', 'Feature Inserted!');
  }

  /**
   * Display the specified resource.
   *
   * @param  \App\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function show(Feature $feature)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/features", 'name' => "Feature List"], ['name' => "View"]
    ];
    return view('pages.feature.show', ['feature' => Feature::where('id', $feature->id)->first(), 'breadcrumbs' => $breadcrumbs]);
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  \App\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function edit(Feature $feature)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/features", 'name' => "Feature List"], ['name' => "Edit"]
    ];
    return view('pages.feature.edit', ['feature' => Feature::where('id', $feature->id)->first(), 'breadcrumbs' => $breadcrumbs]);
  }

  public function update(Feature $feature)
  {
    $validate = request()->validate(
      [
        'name' => ['required', 'unique:features,name,' . $feature->id],
      ],
      [
        'name.required' => 'Feature required.',
        'name.unique' => 'Feature already available.'
      ]
    );

    $feature->update($validate);
    return redirect()->route('features.index')->with('message', 'Feature Updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function destroy(Feature $feature)
  {
    $label = Feature::where('id', $feature->id)->first();
    if ($label != null) {
      $label->delete();
      return back()->with(json_encode(['success' => 'ok']));
    }
    return back()->with(json_encode(['error' => 'record not found']));
  }
}
