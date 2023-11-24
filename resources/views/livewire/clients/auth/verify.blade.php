<div>
    <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">
        <div class="lg:p-8 p-7 space-y-3 relative bg-white shadow-xl rounded-md">
            <h3 class="lg:text-md text-md font-semibold mb-6">Chào, {{ auth()->user()->user_fullname }} </h3>
            <p>Vui lòng kiểm tra mã otp tại mail chính(inbox) , rác(spam)</p>
            <div>
                <input type="text" wire:model.live.debounce.300ms="otp" placeholder="Mã OTP"
                    class="with-border @error('otp') with-border-error @enderror h-12 mt-2 px-3 rounded-md w-full">
                @error('otp')
                    <span class="uk-label text-red-600 ">{{ $message }}</span>
                @enderror
            </div>
            <div class="flex justify-between">
                <div>
                    <a wire:click='resend' class="cursor-pointer" style="color:#3F83F8">Gửi lại</a>
                </div>
                <div>
                    <a wire:click="change('')" class="cursor-pointer" style="color:#3F83F8">Đổi email khác</a>
                </div>
            </div>
            @if ($check_mail)
                <div class="flex align-items-center">
                    <input type="text" wire:model.live.debounce.300ms="user_email" placeholder="Nhập email"
                        class="with-border @error('user_email') with-border-error @enderror h-12 mt-2 px-3 rounded-md w-full">
                    <button wire:click="change('submit')"
                        class="bg-blue-600 font-semibold px-3 mt-3 ml-2 h-12 rounded-md text-center text-white">
                        OK</button>

                </div>
                @error('user_email')
                    <p class="flex text-red-600 ">{{ $message }}</p>
                @enderror
            @endif
            @if ($check == 1)
                <p style="color:#0E9F6E;text-align:center">Đã gửi mã OTP thành công!</p>
            @endif
            @error('noti')
                <p style="color:red">{{ $message }}</p>
            @enderror

            <div>
                <button wire:click="save"
                    class="bg-blue-600 font-semibold p-2 mt-3 rounded-md text-center text-white w-full">
                    Xác nhận</button>
            </div>
        </div>

    </div>
</div>
@section('js')
    <script>
        document.addEventListener('livewire:init', function() {
            Livewire.on('lockoutEvent', () => {
                alert('bị chặn');
            });
        });
    </script>
@endsection
