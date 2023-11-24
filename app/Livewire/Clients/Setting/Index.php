<?php

namespace App\Livewire\Clients\Setting;

use App\Models\UsersBlockModel;
use App\Models\UsersLogModel;
use App\Models\UsersModel;
use Livewire\Component;
use PragmaRX\Google2FA\Google2FA;
use Livewire\WithPagination;
use Livewire\Attributes\On;

class Index extends Component
{
    use WithPagination;
    public $check_2fa, $selectTabSetting = "profile", $qr_image, $history
    , $totalHistory, $block, $totalBlock, $dataUser_QRCODE;

    public $perPage = [
        'profile' => 8,
        'block' => 6,
        'history' => 10,
        'security' => 5
    ];
    public function mount()
    {
        if ($this->selectTabSetting == 'profile') {
            $data = UsersModel::where('user_id', auth()->user()->user_id)->first();
            if ($data->turn_on_2fa) {
                $this->check_2fa = 1;
            }
        }

    }
    public function updated($name)
    {
        if ($name == 'check_2fa') {
            if ($this->check_2fa == 1) {
                $google2fa = app(Google2FA::class);
                $secret = $google2fa->generateSecretKey();
                if ($this->check_2fa == true) {
                    $a = 1;
                } else {
                    $a = 0;
                }
                if ($a == 1) {
                    UsersModel::where('user_id', auth()->user()->user_id)->update(['turn_on_2fa' => (int) $a, 'google2fa_secret' => $secret]);
                    $this->dataUser_QRCODE = UsersModel::where('user_id', auth()->user()->user_id)->first();
                    session(['2fa_enabled' => false]);
                }

            } else {
                UsersModel::where('user_id', auth()->user()->user_id)->update([
                    'turn_on_2fa' => 0,
                    'google2fa_secret' => NULL
                ]);
            }
        }
    }
    public function selectTab($data)
    {
        $this->selectTabSetting = $data;
        if ($this->selectTabSetting == 'history') {
            $history = UsersLogModel::where('user_id', auth()->user()->user_id)->orderBy('created_at', 'DESC');
            $this->totalHistory = $history->count();
            $allHistory = $history->paginate($this->perPage[$this->selectTabSetting]);
            $this->history = json_encode($allHistory);
        }
        if ($this->selectTabSetting == 'block') {
            $currentUser = auth()->user()->user_id;
            $blocks = UsersBlockModel::where(function ($query) use ($currentUser) {
                $query->where('user_id', $currentUser);
            })->get();
            $blockUserIds = [];
            if (!$blocks->isEmpty()) {
                foreach ($blocks as $block) {
                    if ($block->user_id != $currentUser) {
                        $blockUserIds[] = $block->user_id;
                    }
                    if ($block->block_id != $currentUser) {
                        $blockUserIds[] = $block->block_id;
                    }
                }
            }
            $block = UsersModel::whereIn('user_id', $blockUserIds);
            $this->totalBlock = $block->count();
            $allBlock = $block->paginate($this->perPage[$this->selectTabSetting]);
            $this->block = json_encode($allBlock);

        }
    }
    public function unblock($id)
    {
        try {
            if (isset($id)) {
                $user_id = decrypt($id);
                $blockEntry = UsersBlockModel::where('user_id', auth()->user()->user_id)
                    ->where('block_id', $user_id)
                    ->first();
                if ($blockEntry) {
                    $blockEntry->delete();
                    $this->selectTab('block');
                }
            }
        } catch (\Illuminate\Contracts\Encryption\DecryptException $e) {
            return abort(404);
        }
    }
    #[On('loadMoreHistoryList')]
    public function loadMoreHistoryList()
    {
        $this->perPage[$this->selectTabSetting] = $this->perPage[$this->selectTabSetting] + 5;
        $this->selectTab('history');
    }

    #[On('loadMoreBlockList')]
    public function loadMoreBlockList()
    {
        $this->perPage[$this->selectTabSetting] = $this->perPage[$this->selectTabSetting] + 6;
        $this->selectTab('block');
    }
    public function render()
    {
        return view('livewire.clients.setting.index');
    }
}
