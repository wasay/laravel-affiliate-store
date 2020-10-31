<?php

namespace App\Http\Controllers;

use App\Base\Controllers\ApplicationController;
use App\Brand;
use App\Category;
use App\Content;
use App\Product;
use App\Setting;

class FrontController extends ApplicationController
{

    public function __construct()
    {
      parent::__construct();
    }

  /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
		$settings = Setting::all()->first();
		$contents = Content::all();
		$brands = Brand::all();
		$categories = Category::all();
		$products = Product::all()->shuffle();
		$newArrivals = Product::orderBy('created_at', 'desc')->take(3)->get();
		$mostClicked = Product::orderBy('clicks', 'desc')->take(3)->get();
		$recommends = Product::inRandomOrder()->take(3)->get();

		return view('index',compact('brands','categories','products','newArrivals','contents','settings','mostClicked','recommends'));
    }

    public function about(){
      $lastProducts = Product::orderBy('created_at', 'desc')->take(4)->get();
      return view ('pages.about.index', compact('lastProducts'));
    }

    public function termsofuse(){
      return view ('pages.termsofuse');
    }

}
