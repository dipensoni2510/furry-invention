<?php

namespace App\Http\Controllers;

use App\Order;
use App\OrderUser;
use App\UserVehicle;
use App\Vehicle;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class OrderController extends Controller
{

    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Order List"]
        ];

        //      <a href='/companies/{$company->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
        //                 class='feather icon-eye'></i></a>

        //dd(Order::all());
        if ($request->expectsJson()) {
            return DataTables::of(Order::query())
                ->addIndexColumn()
                ->addColumn('actions',  function ($order) {
                    return auth()->user()->role === "admin" ? "<a href='/orders/{$order->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                    class='feather icon-eye'></i></a> 
                    <a href='/orders/{$order->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                    class='feather icon-edit'></i></a>
   " : "<a href='/orders/{$order->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                    class='feather icon-eye'></i></a>";
                })->rawColumns(['actions'])
                ->toJson();
        }
        //      <a href='/companies/{$company->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
        //                 class='feather icon-edit'></i></a>
        return view('pages.order.index', ['breadcrumbs' => $breadcrumbs]);
    }

    public function show(Order $order)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/orders", 'name' => "Order List"], ['name' => "View"]
        ];

        return view('pages.order.show', (auth()->user()->role === "admin") ? [
            'order' => Order::where('id', $order->id)->first(),
            'breadcrumbs' => $breadcrumbs
        ] : [
            'order' => Order::where('id', $order->id)->first(),
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    public function create(Request $request, Vehicle $vehicle)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/vehicles", 'name' => "Vehicle List"], ['name' => "Pay Rent"]
        ];
        return view('pages.rent.create', ['breadcrumbs' => $breadcrumbs, 'vehicle' => $vehicle->id, 'vehicle_price' => $vehicle->price]);
    }

    public function store(Request $request)
    {
        //dd($request->all());
        $validate = request()->validate(
            [
                'card_holder_name' => 'required',
                'card_number' => 'required|min:16|max:16',
                'expiry_date' => 'required',
                'cvv_number' => 'required|min:3|max:3',
                'vehicle_id' => 'required',
                'total_amount' => 'required',
                'start_date' => 'required',
                'end_date' => 'required',
            ]
        );

        $monthyear = date("m-Y");
        if (($validate['card_number'] === "1212232334344545") && ($validate['cvv_number'] === '456') && ($validate['expiry_date'] >= $monthyear)) {
            $order = Order::create([
                'vehicle_id' => $request->vehicle_id,
                'total_amount' => $request->total_amount,
                'take_date' => $request->start_date,
                'return_date' => $request->end_date,
                'user_id' => auth()->user()->id,
                'status' => 'not_return'
            ]);
            UserVehicle::create([
                'vehicle_id' => $request->vehicle_id,
                'user_id' => auth()->user()->id
            ]);
            return redirect()->route('order.index')->with('message', 'Rent Paid!');
        } else {
            return redirect()->back()->with('message', 'Card Details is not Correct!');
        }
    }

    public function edit(Order $order)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/orders", 'name' => "Order List"], ['name' => "Edit"]
        ];
        return view('pages.order.edit', ['order' => Order::where('id', $order->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(Order $order)
    {
        $validate = request()->validate(
            [
                'status' => 'required',
            ]
        );
        $order->status = request()->status;
        $order->save();
        return redirect()->route('order.index')->with('message', 'Order Updated!');
    }
}
