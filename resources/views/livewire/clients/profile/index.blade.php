<div>
    @auth
    @if ($data->user_id == auth()->user()->user_id)
        <li>
            <a href="#"
                class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                <ion-icon name="create-outline" class="pr-2 text-xl"></ion-icon> Cài đặt
            </a>
        </li>
    @endif
    @if ($data->user_id != auth()->user()->user_id)
        <li>
            <hr class="-mx-2 my-2 dark:border-gray-800">
        </li>
        <li>
            <a href="{{ route('block', ['id' => encrypt($data->user_id)]) }}"
                class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                <i class="fa-solid fa-user-xmark pr-2 text-xl"></i> Chặn
            </a>
        </li>
        <li>
            <hr class="-mx-2 my-2 dark:border-gray-800">
        </li>
        <li>
            <a href="#"
                class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                <ion-icon name="stop-circle-outline" class="pr-2 text-xl"></ion-icon> Hủy kết
                bạn
            </a>
        </li>
        <li>
            <a wire:click="createReport({{ $data->user_id }})"
                class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                <ion-icon name="stop-circle-outline" class="pr-2 text-xl"></ion-icon> Tố cáo
            </a>
        </li>
    @endif
@endauth
</div>
