<div>
    <div class="row">
        <div class="col-6">
            <div class="card m-0 rounded-0 border-0 shadow-lg">
                <div class="card-header bg-info border-0 rounded-0">
                    <h3 class="text-white d-flex justify-content-center align-items-center">Upload File</h3>
                </div>
                <div class="card-body">
                    <div x-data="{ uploading: false, progress: 0, uploadStatus: '', uploadSuccess: false }"
                        x-on:livewire-upload-start="uploading = true; uploadStatus = 'Đang tải lên...'; uploadSuccess = false"
                        x-on:livewire-upload-finish="uploading = false; uploadStatus = 'Tải lên thành công'; uploadSuccess = true"
                        x-on:livewire-upload-error="uploading = false; uploadStatus = 'Tải lên thất bại'; uploadSuccess = false"
                        x-on:livewire-upload-progress="progress = $event.detail.progress">
                        <form wire:submit='uploadFile' enctype="multipart/form-data">
                            @csrf
                            <div>
                                {{-- <div style="display: flex; align-items: center;">
                            <progress value="{{ $progress }}" max="100" wire:model.live='progress'></progress>
                            <span>{{ $progress }}%</span>
                        </div> --}}
                                @if ($log)
                                    <div class="progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated  bg-success"
                                            role="progressbar" aria-label="Example with label"
                                            style="width: {{ $progress }}%;" aria-valuenow="{{ $progress }}"
                                            aria-valuemin="0" aria-valuemax="100">{{ $progress }}%</div>
                                    </div>
                                    <div class="w-100">
                                        <a class="m-2 text-success" href="{{ $link['link'] }}"
                                            target="_blank">{{ $link['link'] }}</a><br>
                                        <p>Hoặc download ngay</p>
                                        <a class="m-2 text-info" href="{{ $link['download'] }}"
                                            target="_blank">{{ $link['download'] }}</a><br>
                                    </div>
                                @endif
                            </div>
                            <input type="file" class="mt-3 mb-5" wire:model.live="file">
                            <button class="btn btn-danger" wire:click='uploadFile'
                                :disabled="uploading || !uploadSuccess">Tải lên</button>
                        </form>
                        <div x-show="uploading">
                            {{-- <progress max="100" x-bind:value="progress"></progress>
                        <span x-text="progress + '%'" class="ms-2"></span> --}}
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-label="Example with label" x-bind:style="'width: ' + progress + '%'"
                                    x-bind:aria-valuenow="progress" aria-valuemin="0" aria-valuemax="100">
                                    <span x-text="progress + '%'"></span>
                                </div>
                            </div>
                            <p x-text="uploadStatus"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card m-0 rounded-0 border-0 shadow-lg">
                <div class="card-header bg-danger border-0 rounded-0">
                    <h3 class="text-white d-flex justify-content-center align-items-center">Upload Youtube</h3>
                </div>
                <div class="card-body">
                    <div x-data="{ uploadingYT: false, progressYT: 0, uploadStatusYT: '', uploadSuccessYT: false }"
                        x-on:livewire-upload-start="uploadingYT = true; uploadStatusYT = 'Đang tải lên...'; uploadSuccessYT = false"
                        x-on:livewire-upload-finish="uploadingYT = false; uploadStatusYT = 'Tải lên thành công'; uploadSuccessYT = true"
                        x-on:livewire-upload-error="uploadingYT = false; uploadStatusYT = 'Tải lên thất bại'; uploadSuccessYT = false"
                        x-on:livewire-upload-progress="progressYT = $event.detail.progress">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <form wire:submit.prevent='uploadYoutube' enctype="multipart/form-data">
                            <label for="video">Chọn Video:</label>
                            <input type="file" id="video" wire:model='fileYT' name="video" accept="video/*" required>

                            <div class="form-group">
                                <label for="title">Tiêu đề:</label>
                                <input type="text" class="form-control border-1" id="title" name="title" required
                                    style="border:1px solid #ced4da;">
                            </div>

                            <div class="form-group">
                                <label for="description">Mô tả:</label>
                                <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
                            </div>

                            <div class="form-group">
                                <label for="tags">Thẻ (cách nhau bằng dấu phẩy):</label>
                                <input type="text" class="form-control" id="tags" name="tags"
                                    style="border:1px solid #ced4da;">
                            </div>

                            <button type="submit" class="btn btn-primary mt-3"
                                :disabled="uploadingYT || !uploadSuccessYT">Tải lên</button>
                        </form>
                        <div x-show="uploadingYT">
                            <div class="progress">
                                <div class="progress-bar progress-bar-striped progress-bar-animated" role="progressbar"
                                    aria-label="Example with label" x-bind:style="'width: ' + progressYT + '%'"
                                    x-bind:aria-valuenow="progressYT" aria-valuemin="0" aria-valuemax="100">
                                    <span x-text="progressYT + '%'"></span>
                                </div>
                            </div>
                            <p x-text="uploadStatusYT"></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



</div>
