<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;
use App\Subscribe;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class SubscribesController extends AdminController {

  public function index(Request $request)
  {
    $subscribes = Subscribe::all();

    if ($request->ajax())
    {
      return Datatables::of($subscribes)->make(true);
    }

    return view('admin.subscribes.index', compact('subscribes'));
  }
}
