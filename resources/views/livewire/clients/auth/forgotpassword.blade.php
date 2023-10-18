<div>
    <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">

        <form class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
            <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Tìm tài khoản của bạn </h1>
            <p>Vui lòng nhập email hoặc số di động để tìm kiếm tài khoản của bạn.</p>
            <div>
                <input type="email" wire:model.live.debounce.300ms='email' placeholder="Email"
                    class="with-border @error('email') with-border-error @enderror bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                @error('email')
                    <span class="uk-label text-red-600">{{ $message }}</span>
                @enderror
            </div>

            <div>
                <button wire:click='check' type="button"
                    class="bg-blue-600 font-semibold p-2 mt-3 rounded-md text-center text-white w-full">
                    Tìm kiếm</button>
            </div>
        </form>

    </div>
</div>
