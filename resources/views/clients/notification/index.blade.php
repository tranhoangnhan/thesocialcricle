@livewire('clients.notification.index')
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script>
    var pusher = new Pusher('150f6fc3c93d4b5e8aec', {
        cluster: 'ap1'
    });
    var currentUserId = '{{ auth()->check() ? auth()->user()->user_id : null }}';
    var channel = pusher.subscribe('Notification');
    // ... (your existing code)

    channel.bind('PostLike', function(data) {
        var notificationList = document.getElementById('notification-list');
        var newListItemHTML = `
        <li class="notification-0 dropdown-item p-4">
            <div class="drop_avatar d-flex justify-content-center">
                <img src="${data.user.avatar}" alt=""
                class="w-8 h-8 rounded-full">
                <p class="text-sm m-1">${data.message}</p>
            </div>
            <div class="drop_text">
                <time class="text-xs mx-4">
                    Vừa xong
                </time>
            </div>
        </li>`;

        if (currentUserId == data.user_id) {
            var newListItem = document.createElement('li'); // Create a new list item element
            newListItem.innerHTML = newListItemHTML; // Set the innerHTML of the new list item

            var listItems = notificationList.getElementsByTagName('li');
            var firstListItem = listItems[0]; // Selects the first <li> element

            // Insert the new list item element before the first list item
            notificationList.insertBefore(newListItem, firstListItem);

            // Update the UI to display the new count
            var countElement = document.getElementById('count-display');
            if (countElement) {
                var count = parseInt(countElement.innerText);
                countElement.innerText = count + 1;
            }
        }
    })
    // ... (rest of your styles and scripts)
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
