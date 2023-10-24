    <div>
        <div class="main_content">
            <div class="mcontainer">
                <div class="lg:flex lg:space-x-10">
                    <div class="lg:w-3/4 md:p-3 p-2">
                        <div>
                            <div class="space-y-3">
                                <h5 class="uppercase text-sm font-medium text-gray-400">
                                    <div class="line">
                                        <input wire:model="course_name" class="line__input" id="course_name"
                                            name="course_name" type="text" value="" autocomplete="off">
                                        <span for="username" class="line__placeholder"> Tên khóa học </span>
                                    </div>
                                </h5>
                                <h6 class="font-semibold">
                                    <div>
                                        <label for="category" class="font-semibold text-base">Danh mục</label>
                                        <select id="category" name="category" wire:model="category"
                                            class="block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
                                            <option value="">Chọn</option>
                                            @foreach ($Categories as $cate)
                                                <option value="{{ $cate->id }}"
                                                    class="text-gray-800 hover:bg-blue-100 hover:text-blue-500">
                                                    {{ $cate->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                </h6>
                            </div>
                            <div class="lg:mt-9 mt-5">
                                <div class="space-y-5">
                                    <div>
                                        <h3 class="font-semibold mb-2 text-xl"> Mô tả về khóa học</h3>
                                        <p>
                                            <textarea id="editor" class="p-3" id="description" placeholder="Mô tả" name="description"
                                                wire:model="description" type="text"></textarea>
                                        </p>
                                    </div>
                                    <div>
                                        <div class="mb-3 container-input">
                                            <label class="form-label">Yêu
                                                cầu:</label>
                                            @foreach ($skills as $key => $skill)
                                                <input type="text" class="form-control mb-3"
                                                    wire:model="skills.{{ $key }}"
                                                    placeholder="Kiến thức cần có để tham gia khóa học">
                                            @endforeach
                                        </div>
                                        <button class="btn mx-2" wire:click.prevent="addSkill">+</button>
                                    </div>

                                    <div class="mb-3 container-input">
                                        <label for="exampleFormControlInput1" class="form-label">Nội dung khóa
                                            học:</label>
                                        @foreach ($learns as $key => $learns)
                                            <input type="text" class="form-control mb-3"
                                                wire:model="learns.{{ $key }}"
                                                placeholder="Kiến thức đạt được khi tham gia khóa học">
                                        @endforeach
                                        <button class="btn mx-2" wire:click="addLearn">+</button>
                                    </div>
                                </div>
                                <div class="space-y-2">
                                    <label for="" class="font-semibold text-base">Tinh phí</label>
                                    <div> Nếu bật tính phí người dùng phải trả tiền mới có thể tham gia
                                        khóa
                                        học
                                        của bạn</div>
                                    <select id="" name="payment" wire:model='payment'
                                        class="block w-full p-2 border border-gray-300 rounded shadow-sm focus:ring focus:ring-blue-200">
                                        <option value=""
                                            class="text-gray-800 hover:bg-blue-100 hover:text-blue-500">Chọn</option>
                                        <option data-icon="uil-bullseye" value="0"
                                            class="text-gray-800 hover:bg-blue-100 hover:text-blue-500">Có</option>
                                        <option data-icon="uil-chat-bubble-user"
                                            class="text-gray-800 hover:bg-blue-100 hover:text-blue-500" value="1">
                                            Không</option>
                                    </select>
                                </div>

                                <!-- course Curriculum -->
                                <h3 class="mb-8 mt-10 font-semibold text-xl" id="curriculum"> Video khóa học </h3>
                                <ul class="uk-accordion space-y-3" uk-accordion>
                                    @foreach ($contents as $key => $content)
                                        <input type="text"
                                            class="form-control mb-3 uk-accordion-title font-semibold text-base"
                                            wire:model="contents.{{ $key }}"
                                            placeholder="Các phần của khóa học">
                                    @endforeach
                                    <button class="btn btn" wire:click.prevent="addContent">+</button>

                                </ul>
                            </div>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-lg btn-primary" wire:click='create()'>Bước tiếp theo</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
