<?php

namespace App\Livewire\Clients\Profile;

use App\Models\FriendsModel;
use App\Models\IntroductionModel;
use App\Models\ReportModel;
use App\Models\UsersBlockModel;
use App\Models\UsersModel;
use Livewire\Component;

class Index extends Component
{
    public $data;
    public function createReport($user_id)
    {
        $user = UsersModel::find($user_id);
        if ($user) {
            $report = ReportModel::where('user_id', $user_id)->first();
            if ($report) {
                if ($report->user_id_reporter == auth()->user()->user_id) {
                    return;
                } else {
                    $report->vote = $user->vote + 1;
                    $report->save();
                }
            }
            else {
                ReportModel::create([
                    'user_id_reporter' => auth()->user()->user_id,
                    'user_id' => $user_id,
                    'vote' => 1,
                ]);
        } 
        }
        $this->data=UsersModel::find($user_id);
    }
    public function render()
    {
        $id = request()->id;
        if (isset($id)) {
            if (preg_match('/^@?(\d+)$/', $id, $matches)) {
                $type = 'id';
                $this->data = UsersModel::where('user_id', $matches[1])->first();
            } elseif (preg_match('/^@?([a-zA-Z0-9]+)$/', $id, $matches)) {
                $type = 'username';
                $this->data = UsersModel::where('user_username', $matches[1])->first();
            }
        }
        return view('livewire.clients.profile.index', ['data' => $this->data]);
    }
}
