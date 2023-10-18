<div>
    <div class="lg:flex max-w-5xl min-h-screen mx-auto p-6 py-10">
        <div class="flex flex-col items-center lg: lg:flex-row lg:space-x-10">
            <div class="lg:mb-12 flex-1 lg:text-left text-center">
                <img src="{{ asset('clients/assets/images/logo-dark.png') }}" alt="" class="lg:mx-0  mx-auto w-50">
                <p class="font-medium lg:mx-0 md:text-2xl mt-6 mx-auto sm:w-3/4 text-xl"> Kết nối với bạn bè xung quanh
                    bạn tại The Social Circle.
                </p>
            </div>
            <div class="lg:mt-0 lg:w-96 md:w-1/2 sm:w-2/3 mt-10 w-full">
                <form class="p-6 space-y-4 relative bg-white shadow-lg rounded-lg">
                    <input type="text" wire:keydown.enter="save" wire:model.live.debounce.300ms="info" placeholder="Email hoặc Tên người dùng"
                        class="with-border @error('info') with-border-error @enderror">
                    @error('info')
                        <span class="uk-label text-danger">{{ $message }}</span>
                    @enderror



                    <input type="password" wire:keydown.enter="save" wire:model.live.debounce.300ms="password" placeholder="Mật khẩu"
                        class="with-border @error('password') with-border-error @enderror">
                    @error('password')
                        <span class="uk-label text-danger">{{ $message }}</span>
                    @enderror

                    <button type="button" wire:keydown.enter="save" wire:click='save'
                        class="bg-blue-600 font-semibold p-3 rounded-md text-center text-white w-full">
                        Đăng nhập
                    </button>
                    <a wire:navigate href="{{ route('forgotpassword') }}" class="text-blue-500 text-center block"> Quên
                        mật khẩu? </a>
                    <hr class="pb-3.5">
                    <div class="flex">
                        <button type="button"
                            class="bg-green-600 hover:bg-green-500 hover:text-white font-semibold py-3 px-5 rounded-md text-center text-white mx-auto"
                            data-bs-toggle="modal" data-bs-target="#register">
                            Tạo tài khoản mới
                        </button>

                    </div>
                </form>


                <div class="mt-8 text-center text-sm"> <a href="#" class="font-semibold hover:underline"> Tạo
                        trang </a> dành cho người nổi tiếng, thương hiệu hoặc doanh nghiệp. </div>
            </div>

        </div>
    </div>
</div>
@section('js')
    <script>
        document.addEventListener('livewire:init', function() {
            // window.livewire.on('lockoutTimer', (data) => {
            //     // Cập nhật thời gian chờ mới trong giao diện
            //     document.querySelector('[wire\:loading\.attr\=secondsRemaining]').innerText = data.seconds;
            // });
            Livewire.on('lockoutEvent', () => {
                // document.querySelector('[wire\:loading\.attr\=secondsRemaining]').innerText = data.seconds;
                alert('bị chặn');
            });
        });
    </script>
@endsection
