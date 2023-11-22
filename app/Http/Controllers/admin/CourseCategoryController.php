<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CourseCategoryController extends Controller
{
    public function index()
    {
        return view('admin.category.index');
    }
}
