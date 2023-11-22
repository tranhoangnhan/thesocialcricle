<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ReportModel;

class ReportController extends Controller
{
    public function index()
    {
        return view('admin.report.index');
    }
}
