<?php

namespace App\Livewire\Clients;

use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Storage;

class Fileupload extends Component
{

    use WithFileUploads;

    public $file;
    public $original_filename = "";
    public $filepath = "";
    public $success = 0;
    public $isImage = false;

    public function save() {
        // Reset value
        $this->success = 0;
        $this->isImage = false;

        // Validate
        $this->validate([
             'file' => 'required|mimes:png,jpg,jpeg,csv,pdf|max:2048', // 2MB Max
        ]);

        // Original File name
        $this->original_filename = $this->file->getClientOriginalName();

        // Upload file
        $filename = $this->file->store('files', 'public');

        // Check file extension is an image type
        $extension = strtolower($this->file->extension());
        $image_exts = array('png','jpg','jpeg');
        if(in_array($extension,$image_exts)){
             $this->isImage = true;
        }

        // Success
        $this->success = 1;

        // File path
        $this->filepath = Storage::url($filename);

    }

    public function render(){
        return view('livewire.clients.fileupload');
    }
}