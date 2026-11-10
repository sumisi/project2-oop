<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Report; 
use App\Models\Status;

class AdminController extends Controller
{
    public function index(){
        $reports = Report::all();
        $statuses = Status::all();
        return view('admin.index', compact('reports', 'statuses'));
    }
}
