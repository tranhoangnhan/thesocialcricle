
<!-- open chat box -->
<div uk-toggle="target: #offcanvas-chat" class="start-chat bottom-20">
    <svg class="h-7 w-7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
            d="M7 8h10M7 12h4m1 8l-4-4H5a2 2 0 01-2-2V6a2 2 0 012-2h14a2 2 0 012 2v8a2 2 0 01-2 2h-3l-4 4z"></path>
    </svg>
</div>

<div id="offcanvas-chat" uk-offcanvas="flip: true; overlay: true">
    <div class="uk-offcanvas-bar bg-white p-0 w-full lg:w-80 shadow-2xl h-screen md:overflow-y-hidden">


        <div class="relative pt-5 px-4">

            <h3 class="text-2xl font-bold mb-2"> Nhắn tin </h3>

            <div class="absolute right-3 top-4 flex items-center space-x-2">

                <button class="uk-offcanvas-close  px-2 -mt-1 relative rounded-full inset-0 lg:hidden blcok"
                    type="button" uk-close></button>

                <a href="#" uk-toggle="target: #search;animation: uk-animation-slide-top-small">
                    <ion-icon name="search" class="text-xl hover:bg-gray-100 p-1 rounded-full"></ion-icon>
                </a>
            </div>


        </div>

        <div class="absolute bg-white z-10 w-full -mt-5 lg:-mt-2 transform translate-y-1.5 py-2 border-b items-center flex"
            id="search" hidden>
            <input type="text" placeholder="Tìm kiếm.." class="flex-1">
            <ion-icon name="close-outline" class="text-2xl hover:bg-gray-100 p-1 rounded-full mr-4 cursor-pointer"
                uk-toggle="target: #search;animation: uk-animation-slide-top-small"></ion-icon>
        </div>

        <nav class="responsive-nav border-b extanded mb-2 -mt-2">
            <ul uk-switcher="connect: #chats-tab; animation: uk-animation-fade" class="overflow-y-hidden">
                <li class="uk-active"><a class="active" href="#0"> Bạn bè </a></li>
                <li><a href="#0">Nhóm </a></li>
            </ul>
        </nav>

        <div class="contact-list px-2 uk-switcher " id="chats-tab">
            <div class="p-1 overflow-y-auto h-screen">
                @livewire('clients.home.list-friend')
            </div>
            <div class="p-1">
               @livewire('clients.home.list-group')


            </div>
        </div>
    </div>
</div>

<div id="upload_Story" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-header">
            <h2 class="uk-modal-title text-center">Tải ảnh, video lên</h2>
        </div>
        <div class="uk-modal-body flex flex-column">
            <section wire:ignore>
                <div class="dropzone" id="storyDropzone">
                </div>
                <button id="UstoryDropzone"
                    class="mt-3 ml-5 flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white">
                    <span> Đăng story </span>
                </button>
            </section>
        </div>
    </div>
</div>
@livewire('clients.story.all-story')

<!-- Craete post modal -->
@livewire('clients.posts.post-controller')

</div>
