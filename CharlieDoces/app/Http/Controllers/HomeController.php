<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Home;
use App\Models\Produto;

class HomeController extends Controller
{
    public function index(){
        return view('home.index',['produtos' => Produto::All()]);
    }
}
