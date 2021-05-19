<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTables;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['name' => "Users"]
        ];

        if ($request->expectsJson()) {
            return DataTables::of(User::query()->where('role', 'client'))
                ->addIndexColumn()
                ->addColumn('actions',  function ($user) {
                    return
                        "<a href='/users/{$user->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>

                 <a href='/users/{$user->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>

                 <a href='#' type='button' data-id='{$user->id}' data-toggle='tooltip' data-placement='top' title='Delete' class='button-delete-action pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-trash-2'></i></a>";
                })->rawColumns(['actions'])->toJson();
        }

        return view('pages.user-view', [
            'breadcrumbs' => $breadcrumbs
        ]);
    }

    //    public function displayUsers()
    //    {
    //        return DataTables::of(User::query()->where('role', 'tenant'))
    //            ->addColumn('actions',  function ($user) {
    //                return $user->status === 'pending'
    //                    ?
    //                    "&emsp;
    //               <a href='/view-user/{$user->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
    //                 class='feather icon-eye'></i></a>
    //
    //                 <a href='/edit-user/{$user->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
    //                 class='feather icon-edit'></i></a>
    //
    //                 <a href='#' data-id='{$user->id}' type='button' data-toggle='tooltip' data-placement='top' title='Approve' class='pl-0 pr-0 pt-0 pb-0 button-approve-action btn btn-icon btn-icon rounded-circle btn-flat-success'><i
    //                 class='feather icon-check'></i></a>
    //
    //                 <a href='#' data-id='{$user->id}' type='button' data-toggle='tooltip' data-placement='top' title='Decline' class='pl-0 pr-0 pt-0 pb-0 button-decline-action btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
    //                 class='feather icon-x'></i></a>"
    //                    :
    //                    "&emsp;
    //                 <a href='/view-user/{$user->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
    //                   class='feather icon-eye'></i></a>
    //
    //                   <a href='/edit-user/{$user->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
    //                   class='feather icon-edit'></i></a>";
    //            })->rawColumns(['actions'])->toJson();
    //    }

    public function show(User $user)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/users", 'name' => "User List"], ['name' => "View"]
        ];
        return view('pages.user-by-id', ['user' => User::where('id', $user->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function create()
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/users", 'name' => "User List"], ['name' => "Create"]
        ];
        return view('pages.user-register');
    }

    public function store(User $user)
    {
        $validate = request()->validate(
            [
                'firstname' => 'required', 'string', 'max:255',
                'lastname' => 'required', 'string', 'max:255',
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user)],
                'password' => 'required', 'string', 'min:6', 'max:15',
            ]
        );

        $validate['password'] = bcrypt($validate['password']);
        $user->create(
            $validate
        );
        return redirect()->route('userdashboard')->with('message', 'User Inserted!');
    }

    public function edit(User $user)
    {
        $breadcrumbs = [
            ['link' => route('home'), 'name' => "Home"], ['link' => "/users", 'name' => "User List"], ['name' => "Edit"]
        ];
        return view('pages.user-edit', ['user' => User::where('id', $user->id)->first(), 'breadcrumbs' => $breadcrumbs]);
    }

    public function update(User $user)
    {
        $validate = request()->validate(
            [
                'first_name' => ['required', 'string', 'max:255'],
                'last_name' => ['required', 'string', 'max:255'],
                'mobile' => ['required', 'string', 'min:10', 'max:11', 'unique:users,id,' . $user->id],
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users,id,' . $user->id],
            ]
        );

        $user->update($validate);
        return redirect()->route('users.index')->with('message', 'User Updated!');
    }

    public function destroy(User $user)
    {
        //dd($user->id);
        $user = User::find($user->id);
        $user->delete();
        return back()->with(json_encode(['success' => 'ok']));
    }
}

//Delete User Action Button
    // <a class='button-delete-action feather icon-trash-2 btn btn-icon rounded-circle btn-outline-danger mr-1 mb-1' href='/delete-user/{$user->id}' data-id={$user->id} title='DELETE'><span class='glyphicon glyphicon-edit'></span></a>"

    // public function displayUsers(Request $request)
    // {

    //     ## Read value
    //     $draw = $request->get('draw');
    //     $start = $request->get("start");
    //     $rowperpage = $request->get("length"); // Rows display per page

    //     $columnIndex_arr = $request->get('order');
    //     $columnName_arr = $request->get('columns');
    //     $order_arr = $request->get('order');
    //     $search_arr = $request->get('search');

    //     $columnIndex = $columnIndex_arr[0]['column']; // Column index
    //     $columnName = $columnName_arr[$columnIndex]['data']; // Column name
    //     $columnSortOrder = $order_arr[0]['dir']; // asc or desc
    //     $searchValue = $search_arr['value']; // Search value

    //     // Total records
    //     $totalRecords = User::select('count(*) as allcount')->count();
    //     $totalRecordswithFilter = User::select('count(*) as allcount')
    //         ->where('firstname', 'like', '%' . $searchValue . '%')
    //         ->orWhere('lastname', 'like', '%' . $searchValue . '%')
    //         ->orWhere('email', 'like', '%' . $searchValue . '%')->count();

    //     // Fetch records
    //     $records = User::orderBy($columnName, $columnSortOrder)
    //         ->where('users.firstname', 'like', '%' . $searchValue . '%')
    //         ->orWhere('users.lastname', 'like', '%' . $searchValue . '%')
    //         ->orWhere('users.email', 'like', '%' . $searchValue . '%')
    //         ->select('users.*')
    //         ->skip($start)
    //         ->take($rowperpage)
    //         ->get();

    //     $data_arr = array();

    //     foreach ($records as $record) {
    //         $id = $record->id;
    //         $firstname = $record->firstname;
    //         $lastname = $record->lastname;
    //         $email = $record->email;
    //         $actions = "&emsp;<a href='/view-user/{$id}' title='SHOW' ><span class='edit btn btn-info btn-sm btn-space'>View</span></a>
    //         &emsp;<a href='/edit-user/{$id}/edit' class='edit btn btn-primary btn-sm btn-space' title='EDIT' ><span>Edit</span></a>
    //         &emsp;
    //         <a class='button delete btn btn-danger btn-sm' href='/delete-user/{$id}' data-id={$id} title='DELETE'><span class='glyphicon glyphicon-edit'>Delete</span></a>";

    //         $data_arr[] = array(
    //             "id" => $id,
    //             "firstname" => $firstname,
    //             "lastname" => $lastname,
    //             "email" => $email,
    //             "actions" => $actions
    //         );
    //     }

    //     $response = array(
    //         "draw" => intval($draw),
    //         "iTotalRecords" => $totalRecords,
    //         "iTotalDisplayRecords" => $totalRecordswithFilter,
    //         "aaData" => $data_arr
    //     );

    //     return json_encode($response);
    // }
