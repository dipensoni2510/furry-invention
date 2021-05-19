<?php

namespace App\Http\Controllers;

use App\Announcement;
use App\Company;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Yajra\DataTables\Facades\DataTables;

class AnnouncementController extends Controller
{
  public function index(Request $request)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['name' => "Announcement List"]
    ];

    if ($request->expectsJson()) {
      return DataTables::of(Announcement::query())
        ->addColumn('actions',  function ($announcement) {
          return
            "<a href='/announcements/{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
                 class='feather icon-eye'></i></a>

                 <a href='/announcements/{$announcement->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
                 class='feather icon-edit'></i></a>

                 <a href='#' data-id='{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='Delete' class='pl-0 pr-0 pt-0 pb-0 button-decline-action btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
                 class='feather icon-x'></i></a>";
        })->rawColumns(['actions'])
        ->toJson();
    }

    //dd(Announcement::query()->get());
   // if(request()->isJson()) {

//      return \Yajra\DataTables\DataTables::of(Announcement::query())
//        ->addColumn('actions',  function ($announcement) {
//          return
//            "<a href='/announcements/{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
//                 class='feather icon-eye'></i></a>
//
//                 <a href='/announcements/{$announcement->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
//                 class='feather icon-edit'></i></a>
//
//                 <a href='#' data-id='{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='Delete' class='pl-0 pr-0 pt-0 pb-0 button-decline-action btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
//                 class='feather icon-x'></i></a>";
//        })->rawColumns(['actions'])->toJson();
   // }

    return view('pages.announcement.index', [
      'breadcrumbs' => $breadcrumbs
    ]);
  }

//  public function getAnnouncements()
//  {
//    return \Yajra\DataTables\DataTables::of(Announcement::query())
//      ->addColumn('actions',  function ($announcement) {
//        return
//          "<a href='/announcements/{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='View' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-primary'><i
//                 class='feather icon-eye'></i></a>
//
//                 <a href='/announcements/{$announcement->id}/edit' type='button' data-toggle='tooltip' data-placement='top' title='Edit' class='pl-0 pr-0 pt-0 pb-0 btn btn-icon btn-icon rounded-circle btn-flat-warning'><i
//                 class='feather icon-edit'></i></a>
//
//                 <a href='#' data-id='{$announcement->id}' type='button' data-toggle='tooltip' data-placement='top' title='Delete' class='pl-0 pr-0 pt-0 pb-0 button-decline-action btn btn-icon btn-icon rounded-circle btn-flat-danger'><i
//                 class='feather icon-x'></i></a>";
//      })->rawColumns(['actions'])->make(true);
//  }

  public function show(Announcement $announcement)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcement List"], ['name' => "View"]
    ];
//    dd($announcement->id);
//    dd(Announcement::where('id', $announcement->id)->first());
    return view('pages.announcement.show', ['announcement' => Announcement::where('id', $announcement->id)->first(), 'breadcrumbs' => $breadcrumbs]);
  }

  public function create()
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcement List"], ['name' => "Create"]
    ];
    return view('pages.announcement.create', ['breadcrumbs' => $breadcrumbs]);
  }

  public function store(Announcement $announcement)
  {
    $validate = request()->validate(
      [
        'title' => 'required',
        'type' => 'required',
        'description' => 'required',
        'date' => 'required',
        'time' => 'required',
        'days' => 'required'
      ]
    );

    $announcement->create(
      $validate
    );
    return redirect()->route('announcements')->with('message', 'Announcement Inserted!');
  }

  public function edit(Announcement $announcement)
  {
    $breadcrumbs = [
      ['link' => route('home'), 'name' => "Home"], ['link' => "/announcements", 'name' => "Announcement List"], ['name' => "Edit"]
    ];
    return view('pages.announcement.edit', ['announcement' => Announcement::where('id', $announcement->id)->first(), 'breadcrumbs' => $breadcrumbs]);
  }

  public function update(Announcement $announcement)
  {
    $validate = request()->validate(
      [
        'title' => 'required',
        'type' => 'required',
        'description' => 'required',
        'date' => 'required',
        'time' => 'required',
        'days' => 'required',
      ]
    );
    //dd($validate);
    $announcement->update($validate);
    return redirect()->route('announcements.index')->with('message', 'Announcement Updated!');
  }

  public function destroy(Announcement $announcement)
  {
    //dd($user->id);
    $announcement_del = Announcement::find($announcement->id);
    $announcement_del->delete();
    return back()->with(json_encode(['success' => 'ok']));
  }
}
