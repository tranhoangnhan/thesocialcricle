<?php

namespace App\Livewire;

use App\Helpers\GoogleDriveHelper;
use Livewire\WithFileUploads;
use Livewire\Component;
use Livewire\Attributes\On;
use Illuminate\Support\Facades\File;

class UploadFile extends Component
{
    use WithFileUploads;
    public $file, $fileYT;
    public $progress = 0;
    public $uploading = false;
    public $log, $link, $linkYT;
    public $title;
    public $description;
    public $tags;
    #[On('fileUploadProgress')]
    public function upload($progress)
    {
        $this->progress = $progress;
    }
    public function uploadFile()
    {
        $rules = [
            'file' => 'required|file|max:102400000000',
        ];
        $customMessages = [
            'file.max' => 'Kích thước tệp không được vượt quá 1000MB.',
        ];
        $this->validate($rules, $customMessages);
        if ($this->file && $this->file->isValid()) {
            $file = $this->file;
            $log = GoogleDriveHelper::uploadFile($file);
            if (isset($log)) {
                $this->log = $log;
                $content = $log->getContent();
                $jsonData = json_decode($content, true);
                $this->link['filepath'] = $jsonData['filepath'];
                File::delete($this->file->getRealPath());
                $this->resetProgress();
            }
        }
    }

    public function uploadYoutube()
    {
        // dd($this->fileYT);
        $videoUrl = GoogleDriveHelper::uploadVideoToYouTube($this->fileYT, $this->title, $this->description, $this->tags);
        if ($videoUrl) {
            dd($videoUrl);
            session()->flash('success', 'Video đã được tải lên thành công. Đường dẫn video trên YouTube: ' . $videoUrl);
        } else {
            session()->flash('error', 'Có lỗi xảy ra khi tải lên video.');
        }
    }

    public function resetProgress()
    {
        $this->progress = 0;
        $this->file = NULL;
        $this->link = [];
        $this->log = NULL;
    }

    public function render()
    {
        return view('livewire.upload-file');
    }
}
