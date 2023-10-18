<div>
    <div class="lg:p-12 max-w-xl lg:my-0 my-12 mx-auto p-6 space-y-">

        <form class="lg:p-10 p-6 space-y-3 relative bg-white shadow-xl rounded-md">
            <h1 class="lg:text-2xl text-xl font-semibold mb-6"> Khôi phục mật khẩu </h1>


            @if ($typeOTP)
                <p>Vui lòng nhập mã OTP đã gửi về mail của bạn.</p>
                <div>


                    @if ($success)
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
                                    <ion-icon :name="showConfirmPassword ? 'eye-outline' : 'eye-off-outline'">
                                    </ion-icon>
                                </button>
                            </div>
                        </div>
                    @else
                        <input type="otp" wire:model.live.debounce.300ms='otp' placeholder="Mã OTP"
                            class="with-border @error('otp') with-border-error @enderror bg-gray-100 h-12 mt-2 px-3 rounded-md w-full">
                        @error('otp')
                            <span class="uk-label text-red-600">{{ $message }}</span>
                        @enderror
                    @endif
                </div>

                <div>
                    <button wire:click='save' type="button"
                        class="bg-blue-600 font-semibold p-2 mt-3 rounded-md text-center text-white w-full">
                        {{ $success ? 'Thay đổi' : 'Kiểm tra' }}</button>
                </div>
            @else
                <div>
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
                                <ion-icon :name="showConfirmPassword ? 'eye-outline' : 'eye-off-outline'">
                                </ion-icon>
                            </button>
                        </div>
                    </div>
                </div>

                <div>
                    <button wire:click='save' type="button"
                        class="bg-blue-600 font-semibold p-2 mt-3 rounded-md text-center text-white w-full">
                        Thay đổi</button>
                </div>
            @endif
        </form>

    </div>

</div>
