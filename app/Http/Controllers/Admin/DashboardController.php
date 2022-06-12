<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use App\Models\Product;
use App\Models\Category;
use App\Models\Query;



class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    // index
    public function index()
    {
        // $users = DB::table('users')->get();
        // $message = Message::latest()->get();
        // $slider = Slider::latest()->get();
        // $service = Service::latest()->get();
        // return view('pages.admin.home', compact('users', 'message', 'slider', 'service'));
        $message = count(Message::all());
        $product = count(Product::all());
        $category = count(Category::all());
        $query = count(Query::all());
        return view('pages.admin.home', compact('message', 'category', 'product','query'));
    }
}
