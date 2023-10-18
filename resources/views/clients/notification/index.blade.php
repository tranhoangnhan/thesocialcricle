@livewire('clients.notification.index')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher('150f6fc3c93d4b5e8aec', {
        cluster: 'ap1'
    });
    var currentUserId = '{{ auth()->check() ? auth()->user()->user_id : null }}';
    var channel = pusher.subscribe('Notification');
    channel.bind('PostLike', function(data) {
        var notificationList = document.getElementById('notification-list');
        var newListItemHTML = `
        <a href="#">
            <div class="drop_avatar">
                <img src="${data.user.avatar}" alt="">
            </div>
            <div class="drop_text">
                <p>${data.message}</p>
                <time>Vừa xong</time>
            </div>
        </a>
    `;
        if (currentUserId == data.user_id) {
            // Tạo một mục <li> mới và chèn HTML vào nó
            var newListItem = document.createElement('li');
            newListItem.classList.add('notification-0');
            newListItem.insertAdjacentHTML('afterbegin', newListItemHTML);

            // Lấy ra phần tử đầu tiên của danh sách (nếu có)
            var firstListItem = notificationList.firstChild;

            // Sử dụng phương thức insertBefore để chèn newListItem vào trước firstListItem
            notificationList.insertBefore(newListItem, firstListItem);

            // Update the UI to display the new count
            var countElement = document.getElementById('count-display');
            if (countElement) {
                var count = parseInt(countElement.innerText);
                countElement.innerText = count + 1;
            }
        }
        // Tạo một mục <li> mới cho thông báo
    });
</script>
<style>
    .notification-0 {
        background-color: #fff;
    }

    .notification-1 {
        background-color: #f5f5f5;

    }

    #notification-list {
        max-height: 400px;
        /* Adjust this value as needed */
        overflow-y: auto;
    }
</style>
