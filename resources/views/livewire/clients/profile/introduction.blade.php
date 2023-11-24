<div>
    <ol class="flex items-center w-full mb-4 sm:mb-5">
        <li wire:click="goToStep(1)"
            class="flex w-full items-center text-blue-600 dark:text-blue-500
            {{ $step >= 1 ? "after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block dark:after:border-blue-800" : "after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700" }}
            ">
            <div
                class="flex items-center justify-center w-10 h-10 bg-blue-100 rounded-full lg:h-12 lg:w-12 dark:bg-blue-800 shrink-0">
                <svg class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 16">
                    <path
                        d="M18 0H2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM6.5 3a2.5 2.5 0 1 1 0 5 2.5 2.5 0 0 1 0-5ZM3.014 13.021l.157-.625A3.427 3.427 0 0 1 6.5 9.571a3.426 3.426 0 0 1 3.322 2.805l.159.622-6.967.023ZM16 12h-3a1 1 0 0 1 0-2h3a1 1 0 0 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Zm0-3h-3a1 1 0 1 1 0-2h3a1 1 0 1 1 0 2Z" />
                </svg>
            </div>
        </li>
        <li
            class="flex w-full items-center text-blue-600 dark:text-blue-500
        {{ $step >= 2 ? "after:content-[''] after:w-full after:h-1 after:border-b after:border-blue-100 after:border-4 after:inline-block dark:after:border-blue-800" : "after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700" }}
        ">
            <div
                class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                <svg class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 14">
                    <path d="M18 0H2a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V2a2 2 0 0 0-2-2ZM2 12V6h16v6H2Z" />
                    <path d="M6 8H4a1 1 0 0 0 0 2h2a1 1 0 0 0 0-2Zm8 0H9a1 1 0 0 0 0 2h5a1 1 0 1 0 0-2Z" />
                </svg>
            </div>
        </li>
        <li
            class="flex items-center w-full
        {{ $step >= 3 ? "after:content-[''] after:w-full after:h-1 after:border-b after:border-cyan-100 after:border-4 after:inline-block dark:after:border-blue-800" : "after:content-[''] after:w-full after:h-1 after:border-b after:border-gray-100 after:border-4 after:inline-block dark:after:border-gray-700" }}">
            <div
                class="flex items-center justify-center w-10 h-10 bg-gray-100 rounded-full lg:h-12 lg:w-12 dark:bg-gray-700 shrink-0">
                <svg class="w-4 h-4 text-blue-600 lg:w-6 lg:h-6 dark:text-blue-300" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 20">
                    <path
                        d="M16 1h-3.278A1.992 1.992 0 0 0 11 0H7a1.993 1.993 0 0 0-1.722 1H2a2 2 0 0 0-2 2v15a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2ZM7 2h4v3H7V2Zm5.7 8.289-3.975 3.857a1 1 0 0 1-1.393 0L5.3 12.182a1.002 1.002 0 1 1 1.4-1.436l1.328 1.289 3.28-3.181a1 1 0 1 1 1.392 1.435Z" />
                </svg>
            </div>
        </li>
    </ol>
    <div>
        @if ($step == 1)
            <div class="bg-white rounded-md lg:shadow-md shadow p-5">
                <h3 class="mb-4 text-lg font-medium leading-none text-gray-900 dark:text-white">Địa chỉ</h3>
                <div class="row">
                    <label>Sống tại <span class="text-danger">*</span></label>
                    <div class="flex justify-center">
                        <p class="text-center text-danger">
                            @error('errorHomeTown')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>

                    <div class="col-12 col-md-6  my-2">
                        <select data-province="{{ $selectedProvince }}" wire:ignore id="city"
                            name="address_province" wire:model="selectedProvince"
                            class="@error('selectedProvince') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedProvince') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            @if ($selectedProvince)
                                <option value="{{ $selectedProvince }}" selected>{{ $selectedProvince }}</option>
                            @else
                                <option value="">Chọn tỉnh/thành phố</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-12 col-md-6  my-2">
                        <select wire:ignore id="district" name="address_district" wire:model="selectedDistrict"
                            class="@error('selectedDistrict') with-border-error @enderror bg-white  bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedDistrict') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            @if ($selectedDistrict)
                                <option value="{{ $selectedDistrict }}" selected>{{ $selectedDistrict }}</option>
                            @else
                                <option value="">Chọn quận/huyện</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  my-2">
                        <select wire:ignore id="ward" name="address_ward" wire:model="selectedWard"
                            class="@error('selectedWard') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedWard') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            @if ($selectedWard)
                                <option value="{{ $selectedWard }}" selected>{{ $selectedWard }}</option>
                            @else
                                <option value="">Chọn xã</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  my-2">
                        <input wire:model='detail' type="text"
                            class="@error('detail') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Số nhà, thôn, xóm"
                            @error('detail') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                    <label>Quê quán <span class="text-danger">*</span></label>
                    <div class="flex justify-center">
                        <p class="text-center text-danger">
                            @error('errorLocation')
                                {{ $message }}
                            @enderror
                        </p>
                    </div>
                    <div class="col-12 col-md-6  my-2">
                        <select data-province1="{{ $selectedProvince1 }}" wire:ignore id="city1"
                            name="address_province1" wire:model="selectedProvince1"
                            class="@error('selectedProvince1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedProvince1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                            @if ($selectedProvince1)
                                <option value="{{ $selectedProvince1 }}" selected>{{ $selectedProvince1 }}
                                </option>
                            @else
                                <option value="">Chọn tỉnh/thành phố</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  my-2">
                        <select wire:ignore id="district1" name="address_district1" wire:model="selectedDistrict1"
                            class="@error('selectedDistrict1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedDistrict1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            @if ($selectedDistrict1)
                                <option value="{{ $selectedDistrict1 }}" selected>{{ $selectedDistrict1 }}
                                </option>
                            @else
                                <option value="">Chọn quận/huyện</option>
                            @endif
                        </select>
                    </div>
                    <div class="col-12 col-md-6  my-2">
                        <select wire:ignore id="ward1" name="address_ward1" wire:model="selectedWard1"
                            class="@error('selectedWard1') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            @error('selectedWard1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                            @if ($selectedWard1)
                                <option value="{{ $selectedWard1 }}" selected>{{ $selectedWard1 }}</option>
                            @else
                                <option value="">Chọn xã/phường</option>
                            @endif
                        </select>
                    </div>

                    <div class="col-12 col-md-6  my-2">
                        <input wire:model='detail1' type="text"
                            class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="Số nhà, thôn, xóm"
                            @error('detail1') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                </div>
                <button wire:click="save('address')"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                    Lưu và tiếp tục
                </button>
            </div>
        @endif
        @if ($step == 2)
            <div class="bg-white rounded-md lg:shadow-md shadow p-5">
                <h3 class="mb-4 text-lg font-medium leading-none text-gray-900 dark:text-white">Thông tin chi tiết</h3>
                <div class="row">
                    <div class="col-12 col-md-6">
                        <div class="relative w-full my-2">
                            <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-ring"></i>
                            </div>
                            <select wire:model="user_marital"
                                class="@error('user_marital') with-border-error @enderror bg-white bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                @error('user_marital') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                @if ($user_marital)
                                    <option value="{{ $user_marital }}" selected hidden>{{ $user_marital }}
                                    </option>
                                @endif
                                <option value="" hidden>Chọn trạng thái</option>
                                <option value="single">Độc thân</option>
                                <option value="married">Đã kết hôn</option>
                                <option value="divorced">Đã ly hôn</option>
                                <option value="widowed">Góa phụ</option>
                            </select>

                        </div>
                    </div>
                    <div class="col-12 col-md-6">
                        <div class="relative w-full my-2">
                            <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-suitcase"></i>
                            </div>
                            <input type="text" style="padding-left:2.5rem"
                                class="@error('user_job') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model='user_job' placeholder="Công việc"
                                @error('user_job') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="relative w-full my-2">
                            <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-solid fa-language"></i>
                            </div>
                            <input type="text" style="padding-left:2.5rem"
                                class="@error('user_language') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model='user_language' placeholder="Ngôn ngữ: Tiếng Việt, Tiếng Anh"
                                @error('user_language') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                        </div>
                    </div>
                    <div class="col-12 mb-2">
                        <div class="relative w-full my-2">
                            <div class="me-3 absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <i class="fa-duotone fa-browser"></i>
                            </div>
                            <input type="text" style="padding-left:2.5rem"
                                class="@error('user_website') with-border-error @enderror pl-10 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                                wire:model='user_website' placeholder="Website: tsonit.com"
                                @error('user_website') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                        </div>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button wire:click="save('infoBonus')"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lưu và tiếp tục
                    </button>
                    <button wire:click="goToStep(1)"
                        class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Quay lại
                    </button>
                </div>

            </div>
        @endif
        @if ($step == 3)
            <div class="bg-white rounded-md lg:shadow-md shadow p-5">
                <h3 class="mb-4 text-lg font-medium leading-none text-gray-900 dark:text-white">Học vấn</h3>
                <div class="row mb-3">
                    <label for="university"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 4</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center ps-3.5"
                        style="left:12px;top:-4px;z-index:999">
                            <select id="university_type" name="university_type"
                                class="mt-1 p-2 border rounded-md w-full @error('user_university_type') with-border-error @enderror" wire:model.live='user_university_type'
                                @error('user_university_type') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                <option value="1">Đại học</option>
                                <option value="2">Quốc tế</option>
                                <option value="3">Cao đẳng</option>
                                <option value="4">Cao đẳng nghề</option>
                            </select>
                        </div>
                        <input type="text" id="university"
                            class=" @error('user_university') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="FPT Polytechnic" style="padding-left:165px" wire:model.live='user_university' @error('user_university') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="university"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 3</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center ps-3.5"
                        style="left:12px;top:-4px;z-index:999">
                            <select id="university_type" name="university_type"
                                class="mt-1 p-2 border rounded-md w-full">
                                <option value="1" selected>Phổ thông</option>
                            </select>
                        </div>
                        <input type="text" id="university"
                            class=" @error('user_highschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="FPT Polytechnic" style="padding-left:135px" wire:model.live='user_highschool'
                            @error('user_highschol') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="university"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 2</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center ps-3.5"
                        style="left:12px;top:-4px;z-index:999">
                            <select id="university_type" name="university_type"
                                class="mt-1 p-2 border rounded-md w-full">
                                <option value="1" selected>Trung học</option>
                            </select>
                        </div>
                        <input type="text" id="university"
                            class=" @error('user_middleschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="FPT Polytechnic" style="padding-left:135px"
                            wire:model.live='user_middleschool' @error('user_middleschool') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                </div>
                <div class="row mb-3">
                    <label for="university"
                        class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Cấp 1</label>
                    <div class="relative">
                        <div class="absolute inset-y-0 flex items-center ps-3.5"
                        style="left:12px;top:-4px;z-index:999">
                            <select id="university_type" name="university_type"
                                class="mt-1 p-2 border rounded-md w-full">
                                <option value="1" selected>Tiểu học</option>
                            </select>
                        </div>
                        <input type="text" id="university"
                            class=" @error('user_primaryschool') with-border-error @enderror bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
                            placeholder="FPT Polytechnic" style="padding-left:120px" wire:model.live='user_primaryschool'
                            @error('user_primaryschool') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                </div>
                <div class="flex justify-between">
                    <button wire:click="save('school')"
                        class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Lưu và hoàn tất
                    </button>
                    <button wire:click="goToStep(2)"
                        class="text-white bg-gray-500 hover:bg-gray-600 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                        Quay lại
                    </button>
                </div>

            </div>
        @endif

    </div>


</div>
