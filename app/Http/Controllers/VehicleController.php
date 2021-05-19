<?php

namespace App\Http\Controllers;

use App\Company;
use App\Feature;
use App\Vehicle;
use App\VehicleFeatures;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class VehicleController extends Controller
{
  public function index(Request $request)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['name' => "Company List"]
    ];

    //      <a href='/companies/{$company->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
    //                 class='feather icon-eye'></i></a>

    $vehicle = Vehicle::with('company', 'features')->get();
    //dd($vehicle);
    if ($request->expectsJson()) {
      return DataTables::of(Vehicle::query())
        ->addIndexColumn()
        ->filter(function ($vehicle) use ($request) {
          if ($request->get('status') == 'with' || $request->get('status') == 'without') {
            $vehicle->where('gear_type', $request->get('status'));
          }
          //dd($vehicle, $request->get('status'));
          if (!empty($request->get('search'))) {
            $vehicle->where(function ($w) use ($request) {
              $search = $request->get('search');
              $w->orWhere('name', 'LIKE', "%$search%")
                ->orWhere('model', 'LIKE', "%$search%")
                ->orWhere('vehicle_type', 'LIKE', "%$search%")
                ->orWhere('wheels', 'LIKE', "%$search%")
                ->orWhere('gear_type', 'LIKE', "%$search%")
                ->orWhere('specifications', 'LIKE', "%$search%")
                ->orWhere('price', 'LIKE', "%$search%")
                ->orWhere('number', 'LIKE', "%$search%");
            });
          }
        })
        ->addColumn('actions',  function ($vehicle) {
          return (auth()->user()->role === "admin") ?
            "<a href='/vehicles/{$vehicle->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
           class='feather icon-eye'></i></a>
            <a href='/vehicles/{$vehicle->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
           class='feather icon-edit'></i></a>
           <a href='#' type='button' data-id='{$vehicle->id}' data-toggle='tooltip' data-placement='top' title='Delete' class='button-delete-action pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
           class='feather icon-trash-2'></i></a>"
            :
            "<a href='/vehicles/{$vehicle->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
           class='feather icon-eye'></i></a>";
        })->rawColumns(['actions'])
        ->toJson();
    }
    //      <a href='/companies/{$company->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
    //                 class='feather icon-edit'></i></a>
    return view('pages.vehicle.index', ['breadcrumbs' => $breadcrumbs]);
  }

  public function show(Vehicle $vehicle)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/vehicles", 'name' => "Vehicle List"], ['name' => "View"]
    ];

    //    dd($announcement->id);
    //    dd(Announcement::where('id', $announcement->id)->first());
    return view('pages.vehicle.show', [
      'vehicle' => Vehicle::with('company')->where('id', $vehicle->id)->first(),
      'breadcrumbs' => $breadcrumbs
    ]);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/vehicles", 'name' => "Vehicle List"], ['name' => "Create"]
    ];
    return view('pages.vehicle.create', ['breadcrumbs' => $breadcrumbs, 'features' => Feature::all(), 'companies' => Company::all()]);
  }

  public function store(Vehicle $vehicle)
  {
    //dd(request()->all());
    $validate = request()->validate(
      [
        'company_id' => 'required',
        'name' => 'required|string',
        'model' => 'required',
        'vehicle_type' => 'required',
        'wheels' => 'required',
        'gear_type' => 'required',
        'specifications' => 'required|max:255',
        'price' => 'required',
        'number' => 'required',
        'feature_id' => 'required',
        'image' => 'required|mimes:jpeg,jpg,png'
      ]
    );

    if (request('image')) {
      $validate['image'] = request('image')->store('vehicle-images', 'public');
    }
    //dd(request()->all());
    $vehicle_id = $vehicle->create(
      $validate
    );

    if ($vehicle_id) {
      foreach (request()->feature_id as $feature) {
        VehicleFeatures::create([
          'vehicle_id' => $vehicle_id->id,
          'feature_id' => $feature
        ]);
      }
    }
    return redirect()->route('vehicles.index')->with('message', 'Vehicle Inserted!');
  }

  public function edit(Vehicle $vehicle)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/vehicles", 'name' => "Company List"], ['name' => "Edit"]
    ];

    $vehciles = Vehicle::where('id', $vehicle->id)->first();
    $idCats = array_column($vehicle->features->toArray(), 'id');
    //dd($idCats);
    return view('pages.vehicle.edit', ['vehicle' => $vehciles, 'features' => Feature::all(), 'companies' => Company::all(), 'breadcrumbs' => $breadcrumbs]);
  }

  public function update(Vehicle $vehicle, Request $request)
  {
    //dd($request->all());
    $validate = request()->validate(
      [
        'company_id' => 'required',
        'name' => 'required',
        'model' => 'required',
        'vehicle_type' => 'required',
        'wheels' => 'required',
        'gear_type' => 'required',
        'specifications' => 'required',
        'price' => 'required',
        'feature_id' => 'required',
        'image' => 'mimes:jpeg,jpg,png'
      ]
    );
    if (isset($validate['image']) && request('image')) {
      $validate['image'] = request('image')->store('vehicle-images');

      Vehicle::where('id', $vehicle->id)->update([
        'company_id' => $validate['company_id'],
        'name' => $validate['name'],
        'model' => $validate['model'],
        'vehicle_type' => $validate['vehicle_type'],
        'wheels' => $validate['wheels'],
        'gear_type' => $validate['gear_type'],
        'specifications' => $validate['specifications'],
        'price' => $validate['price'],
        'image' => $validate['image']
      ]);
    } else {
      Vehicle::where('id', $vehicle->id)->update([
        'company_id' => $validate['company_id'],
        'name' => $validate['name'],
        'model' => $validate['model'],
        'vehicle_type' => $validate['vehicle_type'],
        'wheels' => $validate['wheels'],
        'gear_type' => $validate['gear_type'],
        'specifications' => $validate['specifications'],
        'price' => $validate['price']
      ]);
    }
    //$features = $vehicle->features();


    $vehicle->features()->sync(request()->feature_id);

    return redirect()->route('vehicles.index')->with('message', 'Vehicle Updated!');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  \App\Company  $company
   * @return \Illuminate\Http\Response
   */
  public function destroy(Vehicle $vehicle)
  {
    $label = Vehicle::where('id', $vehicle->id)->first();
    if ($label != null) {
      $label->delete();
      return back()->with(json_encode(['success' => 'ok']));
    }
    return back()->with(json_encode(['error' => 'record not found']));
  }
}
