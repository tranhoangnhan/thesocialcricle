<div>
    <div class="main_content">
        <div class="mcontainer">
            <!--  breadcrumb -->
            <div class="breadcrumb-area py-0">
                <div class="breadcrumb">
                    <ul class="m-0">
                        <li>
                            <a href="Khóa học">Khóa học</a>
                        </li>
                        <li class="active">
                            <a href="#">Tạo khóa học</a>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- create page-->
            @if ($step == 1)
                <div class="max-w-2xl m-auto shadow-md rounded-md bg-white lg:mt-20">

                    <!-- form header -->
                    <div class="text-center border-b border-gray-100 py-6">
                        <h3 class="font-bold text-xl"> Tạo khóa học </h3>
                    </div>

                    <!-- form body -->
                    <div class="p-10 space-y-7">

                        <div class="line">
                            <input wire:model="course_name" class="line__input" id="course_name" name="course_name"
                                type="text" value="" autocomplete="off">
                            @if (is_null($course_name))
                                <span for="username" class="line__placeholder"> Tên khóa học </span>
                            @endif
                        </div>

                        <div>
                            <label for="" class="font-semibold text-base">Danh mục</label>
                            <select id="" name="category" class="shadow-none selectpicker with-border"
                                wire:model="category">
                                <option value="1">HTML</option>
                                <option value="2">CSS</option>
                                <option value="3">JavaScript</option>
                            </select>
                        </div>

                        <div class="line h-32">
                            <textarea class="line__input h-32" id="" name="description" wire:model="description" type="text"
                                onkeyup="this.setAttribute('value', this.value);" value="" autocomplete="off"></textarea>
                            <span for="username" class="line__placeholder"> Mô tả </span>
                        </div>

                        <div class="px-2 space-y-2">
                            <label for="" class="font-semibold text-base">Tinh phí</label>
                            <div> Nếu bật tính phí người dùng phải trả tiền mới có thể tham gia khóa học
                                của bạn</div>
                            <select id="" name="payment" class="shadow-none selectpicker with-border"
                                wire:model='payment'>
                                <option data-icon="uil-bullseye" value="0">Có</option>
                                <option data-icon="uil-chat-bubble-user" value="1">Không</option>
                            </select>
                        </div>

                    </div>

                    <!-- form footer -->
                    <div class="flex justify-center border-gray-100 py-8">
                        <button wire:click="next" type="button" class="button lg:w-1/3">
                            Tiếp tục
                        </button>
                    </div>

                </div>
            @elseif($step == 2)
                <div class="max-w-2xl m-auto shadow-md rounded-md bg-white lg:mt-20">

                    <!-- form header -->
                    <div class="text-center border-b border-gray-100 py-6">
                        <h3 class="font-bold text-xl">Banner</h3>
                    </div>

                    <!-- form body -->
                    <div class="p-10 space-y-7">
                        <input wire:model="banner" class="form-control" name="banner" type="file">

                    </div>

                    <!-- form footer -->
                    <div class="flex justify-content-between border-gray-100 p-8">
                        <button wire:click="back" type="button" class="button lg:w-1/3">
                            Quay lại
                        </button>
                        <button wire:click="next" type="button" class="button lg:w-1/3">
                            Tiếp tục
                        </button>
                    </div>

                </div>
            @else
                <div class="max-w-2xl m-auto shadow-md rounded-md bg-white lg:mt-20">

                    <!-- form header -->
                    <div class="text-center border-b border-gray-100 py-6">
                        <h3 class="font-bold text-xl"> Tạo khóa học </h3>
                    </div>

                    <!-- form body -->
                    <div class="p-10 space-y-7">
                        <div class="mb-3 container-input">
                            <label for="exampleFormControlInput1" class="form-label">Yêu cầu:</label>
                            <input type="text" class="form-control"
                                placeholder="Kiến thức cần có để tham gia khóa học">
                            <button class="btn mx-2" id="addInput1">+</button>
                        </div>
                        <div class="mb-3 container-input">
                            <label for="exampleFormControlInput1" class="form-label">Nội dung khóa học:</label>
                            <input type="text" class="form-control" placeholder="Kiến thức học được">
                            <button class="btn mx-2" id="addInput2">+</button>
                        </div>
                    </div>
                      <!-- form footer -->
                    <div class="flex justify-content-between border-gray-100 p-8">
                        <button wire:click="back" type="button" class="button lg:w-1/3">
                            Quay lại
                        </button>
                        <button wire:click="Create" type="button" class="button lg:w-1/3">
                            Đăng kí
                        </button>
                    </div>
                </div>


        </div>
        @endif

    </div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.js" crossorigin="anonymous"></script>
<script>
    // Sử dụng jQuery để thêm trường nhập liệu khi bấm nút "+"
    $(document).ready(function() {
        $("#addInput1").click(function() {
            const newInput = $("<input/>", {
                type: "text",
                class: "form-control",
            });
            newInput.insertBefore(this);
        });
        $("#addInput2").click(function() {
            const newInput = $("<input/>", {
                type: "text",
                class: "form-control",
            });
            newInput.insertBefore(this);
        });
    });
</script>
