@section('custom')
    <style>
        .dropdown-toggle::after {
            display: none !important;

        }
    </style>
@endsection
<div class="relative">
    <div class="modal fade" wire:ignore.self id="register" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog rounded-xl shadow-2xl p-0 lg:w-5/12">
            <div class="modal-content">
                <button class="uk-modal-close-default p-3 bg-gray-100 rounded-full m-3" type="button" class="btn-close"
                    data-bs-dismiss="modal" aria-label="Close">
                    <svg width="14" height="14" viewBox="0 0 14 14" xmlns="http://www.w3.org/2000/svg"
                        data-svg="close-icon">
                        <line fill="none" stroke="#000" stroke-width="1.1" x1="1" y1="1"
                            x2="13" y2="13"></line>
                        <line fill="none" stroke="#000" stroke-width="1.1" x1="13" y1="1"
                            x2="1" y2="13"></line>
                    </svg>
                </button>
                <div class="border-b px-7 py-3">
                    <div class="lg:text-2xl text-xl font-semibold mb-1"> Đăng ký</div>
                    <div class="text-base text-gray-600"> Nhanh gọn và dễ dàng</div>
                </div>

                <form class="p-6 space-y-5 tooltip-container" wire:submit="save">
                    <div class="grid lg:grid-cols-2 gap-3">
                        <input type="text" wire:model.live.debounce.300ms="fullname" placeholder="Họ và tên"
                            class="with-border @error('fullname') with-border-error @enderror"
                            @error('fullname') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                        <input type="text" wire:model.live.debounce.300ms="username"
                            data-tippy-content="{{ $username }}" data-placement="bottom" name="username"
                            placeholder="Tên người dùng"
                            class="with-border @error('username') with-border-error @enderror"
                            @error('username')  uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake"  @enderror>

                    </div>
                    <div class="grid lg:grid-cols-2 gap-3">
                        <input type="email" wire:model.live.debounce.300ms="email" placeholder="Email"
                            class="with-border @error('email') with-border-error @enderror"
                            @error('email') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                        <input type="text" wire:model.live.debounce.300ms="phone" placeholder="Số điện thoại"
                            class="with-border @error('phone') with-border-error @enderror"
                            @error('phone') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                    </div>
                    <!-- Your form content -->
                    <div class="grid lg:grid-cols-2 gap-3">
                        <div x-data="{ showPassword: false, showConfirmPassword: false }" class="relative">
                            <input type="password" wire:model.live.debounce.200ms="password"
                                :type="showPassword ? 'text' : 'password'" autocomplete="new-password"
                                placeholder="Mật khẩu"
                                class="with-border @error('password') with-border-error @enderror"
                                @error('password') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                            <button wire:ignore @click="showPassword = !showPassword" type="button"
                                class="focus:outline-none absolute right-3 top-1/2 transform -translate-y-1/2">

                                <ion-icon :name="showPassword ? 'eye-outline' : 'eye-off-outline'"></ion-icon>
                            </button>
                        </div>
                        <div x-data="{ showConfirmPassword: false }" class="relative">
                            <input type="password" wire:model.live.debounce.200ms="password_confirmation"
                                :type="showConfirmPassword ? 'text' : 'password'" autocomplete="new-password"
                                placeholder="Nhập lại mật khẩu"
                                class="with-border @error('password_confirmation') with-border-error @enderror"
                                @error('password_confirmation') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                            <button wire:ignore @click="showConfirmPassword = !showConfirmPassword" type="button"
                                class="focus:outline-none absolute right-3 top-1/2 transform -translate-y-1/2">
                                <ion-icon :name="showConfirmPassword ? 'eye-outline' : 'eye-off-outline'"></ion-icon>
                            </button>
                        </div>
                    </div>

                    <div wire:ignore>
                        <label class="mb-0"> Giới tính </label>
                        <select class="mt-2 with-border selectpicker" wire:model.live="gender">
                            <option value="0">Nam</option>
                            <option value="1">Nữ</option>
                            <option value="2">Khác</option>
                        </select>
                    </div>

                    <div>
                        <label class="mb-0"> Ngày sinh </label>
                        <div class="grid  grid-cols-3 gap-4">
                            @if (isset($month) && isset($year))
                                <div class="relative ">
                                    <select wire:model.live.debounce.300ms="day" id="day" name="day"
                                        class="@error('day') with-border-error @enderror with-border block w-full px-4 py-2 mt-1 bg-white border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 rounded-md shadow-sm"
                                        @error('day') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>

                                        <option value="" hidden>Ngày</option>
                                        @if (isset($month) && isset($year))
                                            @for ($i = 1; $i <= $this->getDaysInMonth(); $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        @endif
                                    </select>
                                </div>
                            @endif

                            {{-- @if (isset($year)) --}}
                                <div class="relative">
                                    <select wire:model.live.debounce.300ms="month" id="month" name="month"
                                        class="@error('month') with-border-error @enderror with-border block w-full px-4 py-2 mt-1 bg-white border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 rounded-md shadow-sm"
                                        @error('month') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                        <option value="" hidden>Tháng</option>
                                        @for ($i = 1; $i <= 12; $i++)
                                            <option value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                            {{-- @endif --}}

                            <div class="relative">
                                <select wire:model.live.debounce.300ms="year" id="year" name="year"
                                    class="@error('year') with-border-error @enderror with-border block w-full px-4 py-2 mt-1 bg-white border border-gray-300 focus:outline-none focus:ring focus:border-blue-300 rounded-md shadow-sm"
                                    @error('year') uk-tooltip="title: {{ $message }}; pos: bottom; animation:uk-animation-shake" @enderror>
                                    <option value="" hidden>Năm</option>
                                    @for ($i = 1900; $i <= date('Y') - 13; $i++)
                                        <option value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                        </div>
                    </div>

                    <p class="text-xs text-gray-400 pt-3">Bằng cách nhấp vào Đăng ký, bạn đồng ý với chúng tôi
                        <a href="#" class="text-blue-500">Điều kiện</a>,
                        <a href="#">Chính sách dữ liệu</a> và
                        <a href="#">Chính sách cookie</a>.
                    </p>
                    <div class="flex">
                        <button type="submit" wire:offline.attr="disabled"
                            class="bg-blue-600 font-semibold mx-auto px-10 py-3 rounded-md text-center text-white">
                            <span>
                                {{ $isLoading ? 'Đang xử lý' : 'Đăng ký' }}
                            </span>
                        </button>
                    </div>
                </form>

            </div>
        </div>
        <div wire:loading.flex wire:target="save" class="overlay">
            <svg aria-hidden="true" class="w-8 h-8 mr-2 text-gray-200 animate-spin dark:text-gray-600 fill-red-600"
                viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path
                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                    fill="currentColor" />
                <path
                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                    fill="currentFill" />
            </svg>
            <span class="text-gray-200 dark:text-gray-600">Đang xử lý...</span>
        </div>
    </div>

</div>

@section('js')
    <script>
        // document.addEventListener('livewire:init', function() {
        //     Livewire.on('showLoadingOverlay', () => {
        //         console.log('hi');
        //         document.querySelector('.loading').classList.remove(
        //             'd-none'); //Hiển thị loading overlay
        //     });
        // });
    </script>
@endsection
