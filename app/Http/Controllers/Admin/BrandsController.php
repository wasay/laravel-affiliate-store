<?php

namespace App\Http\Controllers\Admin;

use App\Base\Controllers\AdminController;
use App\Brand;
use App\Http\Requests\Admin\BrandRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;

class BrandsController extends AdminController {
  /**
   * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
   */
  public function index()
  {
    $brands = Brand::all();

    return view('admin.brands.index', compact('brands'));
  }

  /**
   * Show the form for creating a new resource.
   *
   * @return \Illuminate\Http\Response
   */
  public function create()
  {
    return view('admin.brands.create');
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param BrandRequest|Request $request
   * @return \Illuminate\Http\Response
   */
  public function store(BrandRequest $request)
  {

    $data = [
      'name' => $request->name,
    ];

    $brand = Brand::create($data);

    $public_dir = $this->createFolder('uploads/brands/'.$brand->id.'/');

    if ($request->file('image'))
    {
      $data = $this->createImage($request->file('image'), $public_dir);
      $brand->update($data);
    }

    return Redirect::route('admin.brands.index');
  }

  /**
   * Show the form for editing the specified resource.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   * @internal param Request $request
   */
  public function edit($id)
  {
    $brand = Brand::findOrFail($id);

    return view('admin.brands.edit', compact('brand'));
  }

  /**
   * Update the specified resource in storage.
   *
   * @param BrandRequest|Request $request
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function update(BrandRequest $request, $id)
  {

    $data = [
      'name' => $request->name,
    ];

    $public_dir = $this->createFolder('uploads/brands/'.$id.'/');

    if ($request->file('image'))
    {
      $data = $this->createImage($request->file('image'), $public_dir);
    }

    $brand = Brand::findOrFail($id);
    $brand->update($data);

    return Redirect::route('admin.brands.index');
  }

  /**
   * Remove the specified resource from storage.
   *
   * @param  int $id
   * @return \Illuminate\Http\Response
   */
  public function destroy($id)
  {
    $brand = Brand::findOrFail($id);

    $brand->delete();

    return Redirect::route('admin.brands.index');
  }
}
