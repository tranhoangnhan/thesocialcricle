<?php

namespace App\Livewire\Clients\Report;

use App\Models\ReportModel;
use Livewire\Component;

class Index extends Component
{
    public function createReport($content, $type)
    {
        $data = [
            'user_id_reporter' => auth()->user()->user_id,
        ];

        if ($type == 'post') {
            $data['post_id'] = $content;
        }
        if ($type == 'comment') {
            $data['comment_id'] = $content;
        }
        if ($type == 'user') {
            $data['user_id'] = $content;
        }

        ReportModel::create($data);
    }

    public function render()
    {
        return view('livewire.clients.report.index');
    }
}
