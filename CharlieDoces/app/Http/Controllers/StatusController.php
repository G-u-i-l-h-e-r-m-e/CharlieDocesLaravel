<?php

namespace App\Http\Controllers;

use App\Models\Status;

class StatusController extends Controller
{
    public function index()
    {
        return view('status.index', ['pedidoStatus' => Status::All()]);
    }
}