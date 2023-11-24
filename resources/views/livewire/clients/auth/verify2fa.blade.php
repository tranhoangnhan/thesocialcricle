<div>
    <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">

        <form class="lg:p-8 p-7 space-y-3 relative bg-white shadow-xl rounded-md" wire:submit="save">
            <h3 class="lg:text-md text-md font-semibold mb-6">Chào, {{ auth()->user()->user_fullname }} </h3>
            <p>Vui lòng nhập mã otp của ứng dụng <strong>Authencation</strong> vào đây</p>
            @error('errorOTP')
                <span class="flex justify-content-center text-red-600 "><strong>{{ $message }}</strong></span>
            @enderror
            <div>
                <input type="text" wire:model.live.debounce.300ms="otp" placeholder="Mã OTP"
                    class="with-border @error('otp') with-border-error @enderror h-12 mt-2 px-3 rounded-md w-full">
                @error('otp')
                    <span class="uk-label text-red-600 ">{{ $message }}</span>
                @enderror
            </div>
            <div>
                <button type="submit"
                    class="bg-blue-600 font-semibold p-2 mt-3 rounded-md text-center text-white w-full">
                    Xác nhận</button>
            </div>
        </form>

    </div>
</div>
@section('js')
@endsection
