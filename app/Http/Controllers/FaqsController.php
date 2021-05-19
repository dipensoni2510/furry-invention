<?php

namespace App\Http\Controllers;

use App\Faqs;
use Illuminate\Http\Request;

class FaqsController extends Controller
{
    public function index()
    {
      $breadcrumbs = [
        ['link' => route('home'), 'name' => "Home"], ['name' => "Faqs List"]
      ];
      return view('pages.faqs.index', ['breadcrumbs' => $breadcrumbs, 'faqs' => Faqs::paginate(10)]);
    }
}
