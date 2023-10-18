<?php

namespace App\Http\Controllers;

use App\Models\FriendsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;

class ConversationsController extends Controller
{
    public function index(Request $request)
    {
        if (isset($request->id)) {
            $check = UsersModel::where('user_id', $request->id)->first();
            if (!empty($check)) {
                $show = true;
                $id = $request->id;
            } else {
                return redirect(route('home'));
            }
        } else {
            $id="";
            $show = false;
        }
        return view('clients.conversations.index', compact('show','id'));
    }
}
