<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BillController extends Controller
{
    //
    public function index(){
        return view('admin.bill.index');
    }
}
