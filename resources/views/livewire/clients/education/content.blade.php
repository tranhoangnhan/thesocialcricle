<div>
    <div class="main_content">
        <div class="mcontainer">
            <div class="space-y-3">
                <div class="d-flex justify-content-center mb-3">
                    <a href="{{route('control-index',['slug'=>$course->slug])}}"  class="button lg:w-1/3"> 
                        Truy cập trang quản trị
                    </a>
                    
                </div>
                <h5 class="uppercase text-sm font-medium text-gray-400">
                    <div class="line">

                        <input wire:model="course_name" class="line__input" disabled id="course_name" name="course_name" type="text"
                            value="" autocomplete="off">
                        <span for="username" class="line__placeholder"> {{$nameCourse->course_name}} </span>
                    </div>
                </h5>
                <h6 class="font-semibold">
                    <div>
                        <label for="category" class="font-semibold text-base">Phần</label>
                        <select id="category" name="category" wire:model="section_id"
                            class="block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
                            <option value="">Chọn</option>
                            @foreach ($Section as $cate)
                                <option value="{{ $cate->section_id }}" class="text-gray-800 hover:bg-blue-100 hover:text-blue-500">
                                    {{ $cate->section_name }}</option>
                            @endforeach
                        </select>
                    </div>

                </h6>
            </div>
         
            <div class="mb-3 container-input">
                <label for="exampleFormControlInput1" class="form-label">Video:</label>
                <input type="file" multiple name="file" id="file-input" class="form-control mb-3" wire:model="videos" />
                @if($videos)
                        @foreach($videos as $key => $video)
                        <input type="text" wire:model="videoTitles.{{ $key }}" placeholder="Tiêu đề video">
                        <video src="{{ $video->temporaryUrl() }}" class="w-100 h-40 py-4" controls> </video>
                        @endforeach
                @endif
                @error('videos.*') <span class="error">{{ $message }}</span> @enderror
                    </div>
            </div>
            

            <div class="d-flex justify-content-center mb-3">
                <button wire:click="create" type="button" class="button lg:w-1/3">
                    Tải lên video
                </button>
                
            </div>
       
        </div>
    </div>

</div>
