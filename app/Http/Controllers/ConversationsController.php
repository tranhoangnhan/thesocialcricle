<?php

namespace App\Http\Controllers;

use App\Models\ConversationsModel;
use App\Models\FriendsModel;
use App\Models\UsersModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

class ConversationsController extends Controller
{
    public function index(Request $request)
    {
        $show = false;
        if (isset($request->id)) {
            $check = UsersModel::where('user_id', $request->id)->first();
            $checkGroup = ConversationsModel::where('conversations_id', $request->id)->first();
            $currentRoute = Route::current();
            $routeName = $currentRoute->getName();
            if ($routeName == 'messagesGroup') {
                if ($checkGroup !== null) {
                    $show = true;
                    $id = $request->id;
                    $group = ConversationsModel::where('conversations_id', $id)->first();
                    $userCount = $group->users->count();
                    if ($userCount == 2) {
                        return redirect(route('home'));
                    }
                }
            } else if ($routeName == "messages") {
                if ($check !== null) {
                    $show = true;
                    $id = $request->id;
                }
            } else {
                return redirect(route('home'));
            }
            if($show == false){
                return redirect(route('home'));
            }
            // if ($check !== null) {
            //     $show = true;
            //     $id = $request->id;
            // } elseif ($checkGroup !== null) {
            //     $show = true;
            //     $id = $request->id;
            // } else {
            //     return redirect(route('home'));
            // }
        } else {
            $id = "";
            $show = false;
        }
        return view('clients.conversations.index', compact('show', 'id'));
    }
}
