<div>


    @php
    $isFriend = $this->areFriends($friendData->user_id);
@endphp

@if ($isFriend === null)
    <!-- Không có dữ liệu trong cơ sở dữ liệu, hiển thị nút "Thêm bạn bè" -->
    <button wire:click="addFriend({{ $friendData->user_id }})" class="button primary flex-1 block mr-2">
        <i class="uil-envelope mr-1"></i> Thêm bạn bè
    </button>
@elseif ($isFriend->status === '0')
    <!-- Có dữ liệu trong cơ sở dữ liệu với status = '0', hiển thị nút "Thêm bạn bè" -->
    <button wire:click="addFriend({{ $friendData->user_id }})" class="button primary flex-1 block mr-2">
        <i class="uil-envelope mr-1"></i> Hủy kết bạn
    </button>
@else
    <!-- Có dữ liệu trong cơ sở dữ liệu với status = '1', hiển thị nút "Nhắn tin" -->
    <button wire:click="sendMessage({{ $friendData->user_id }})" class="button primary flex-1 block mr-2">
        <i class="uil-envelope mr-1"></i> Nhắn tin
    </button>
@endif
                                   
                               
                                
                        
                     </div>
