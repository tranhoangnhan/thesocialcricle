@extends('layouts.clients')
@section('css')

@endsection
@section('content')
<div class="main_content">
    <div class="mcontainer">

        <!-- Profile cover -->
        <div class="profile user-profile">

            <div class="profiles_banner">
                <img src="https://image-us.eva.vn/upload/1-2020/images/2020-01-12/mxh-1578829941-9-width1200height628-watermark.jpg" alt="">
                <div class="profile_action absolute bottom-0 right-0 space-x-1.5 p-3 text-sm z-50 hidden lg:flex">
                  <a href="#" class="flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5"> 
                      <ion-icon name="crop-outline" class="text-xl"></ion-icon>
                      <span> Crop  </span>
                  </a>
                  <a href="#" class=""> 
                      <ion-icon name="create-outline" class="text-xl"></ion-icon>
                  </a>

                  <a class="flex items-center justify-center h-8 px-3 rounded-md bg-gray-700 bg-opacity-70 text-white space-x-1.5" href="#modal-center" uk-toggle>
                    <span> Sửa ảnh </span>

                  </a>

                  <div id="modal-center" class="uk-flex-top" uk-modal>
                      <div class="uk-modal-dialog uk-modal-body uk-margin-auto-vertical">
                  
                  
                          <div class="js-upload uk-placeholder uk-text-center">
                            <span uk-icon="icon: cloud-upload"></span>
                            <span class="uk-text-middle">Tải ảnh lên để thay đổi ảnh bìa</span>
                            

                            <div uk-form-custom>
                                <input type="file" name="test" multiple>
                                <span class="uk-link">Chọn file</span>
                                
                            </div>
                         
                        </div>
                        <button class="uk-modal-close-default" type="button" uk-close></button>

                        
                        <progress id="js-progressbar" class="uk-progress" value="0" max="100" hidden></progress>
                        
                     
                           
                                   
                      </div>
                      
                  </div>
                


              </div>
            </div>
            <div class="profiles_content">

                <div class="profile_avatar">
                    <div class="profile_avatar_holder"> 
                        <img src="https://we25.vn/media2018/Img_News/2023/02/23/2_20230223163204.jpg" alt="">
                    </div>
                    <div class="user_status status_online"></div>
                    <div class="icon_change_photo" hidden> <ion-icon name="camera" class="text-xl"></ion-icon> </div>
                </div>

                <div class="profile_info">
                    <h1> {{$info->user_fullname}} </h1>
                    <p> Family , Food , Fashion , Fourever <a href="#">Edit </a></p>
                </div>

            </div>

            <div class="flex justify-between lg:border-t border-gray-100 flex-col-reverse lg:flex-row pt-2">
                <nav class="responsive-nav pl-3">
                    <ul  uk-switcher="connect: #timeline-tab; animation: uk-animation-fade">
                        <li><a href="#">Bài viết</a></li>
                        <li><a href="#">Bạn bè <span>3,243</span> </a></li>
                        
                    </ul>
                </nav>

                <!-- button actions -->
                <div class="flex items-center space-x-1.5 flex-shrink-0 pr-4 mb-2 justify-center order-1 relative">
                    
                    <!-- add story -->
                    <a href="#" class="flex items-center justify-center h-10 px-5 rounded-md bg-blue-600 text-white space-x-1.5 hover:text-white"  uk-toggle="target: #create-post-modal"> 
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" class="w-5">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-11a1 1 0 10-2 0v2H7a1 1 0 100 2h2v2a1 1 0 102 0v-2h2a1 1 0 100-2h-2V7z" clip-rule="evenodd"></path>
                        </svg>
                        <span> Add Your Story </span>
                    </a>
                   
                    <!-- search icon -->
                    <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100" uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small"> 
                      <ion-icon name="search" class="text-xl"></ion-icon>
                    </a>
                    <!-- search dropdown -->
                    <div class="absolute right-3 bg-white z-10 w-full flex items-center border rounded-md"
                        id="profile-search" hidden>
                        <input type="text" placeholder="Search.." class="flex-1">
                        <ion-icon name="close-outline" class="text-2xl hover:bg-gray-100 p-1 rounded-full mr-2 cursor-pointer" uk-toggle="target: #profile-search;animation: uk-animation-slide-top-small"></ion-icon>
                    </div>
                    
                    <!-- more icon -->
                    <a href="#" class="flex items-center justify-center h-10 w-10 rounded-md bg-gray-100"> 
                        <ion-icon name="ellipsis-horizontal" class="text-xl"></ion-icon>
                    </a>
                    <!-- more drowpdown -->
                    <div class="bg-white w-56 shadow-md mx-auto p-2 mt-12 rounded-md text-gray-500 hidden border border-gray-100 dark:bg-gray-900 dark:text-gray-100 dark:border-gray-700"  
                      uk-drop="mode: click;pos: bottom-right;animation: uk-animation-slide-bottom-small; offset:5">
                          <ul class="space-y-1">
                            <li> 
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                   <ion-icon name="arrow-redo-outline" class="pr-2 text-xl"></ion-icon> Share Profile
                                </a> 
                            </li>
                            <li> 
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                  <ion-icon name="create-outline" class="pr-2 text-xl"></ion-icon>  Account setting 
                                </a> 
                            </li>
                            <li> 
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                  <ion-icon name="notifications-off-outline" class="pr-2 text-lg"></ion-icon>   Disable notifications
                                </a> 
                            </li> 
                            <li> 
                                <a href="#" class="flex items-center px-3 py-2 hover:bg-gray-100 hover:text-gray-800 rounded-md dark:hover:bg-gray-800">
                                  <ion-icon name="star-outline"  class="pr-2 text-xl"></ion-icon>  Add favorites 
                                </a> 
                            </li>
                            <li>
                              <hr class="-mx-2 my-2 dark:border-gray-800">
                            </li>
                            <li> 
                                <a href="#" class="flex items-center px-3 py-2 text-red-500 hover:bg-red-50 hover:text-red-500 rounded-md dark:hover:bg-red-600">
                                  <ion-icon name="stop-circle-outline" class="pr-2 text-xl"></ion-icon>  Unfriend
                                </a> 
                            </li>
                          </ul>
                    </div>
                </div>

            </div>

        </div>
        
        <div class="uk-switcher lg:mt-8 mt-4" id="timeline-tab">

            <!-- Timeline -->
            <div class="md:flex md:space-x-6 lg:mx-16">
                <div class="space-y-5 flex-shrink-0 md:w-7/12">

                   <!-- create post  -->
                   <div class="card lg:mx-0 p-4" uk-toggle="target: #create-post-modal">
                       <div class="flex space-x-3">
                           <img src="assets/images/avatars/avatar-2.jpg" class="w-10 h-10 rounded-full">
                           <input placeholder="What's Your Mind ? Hamse!" class="bg-gray-100 hover:bg-gray-200 flex-1 h-10 px-6 rounded-full"> 
                       </div>
                       <div class="grid grid-flow-col pt-3 -mx-1 -mb-1 font-semibold text-sm">
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer"> 
                                <svg class="bg-blue-100 h-9 mr-2 p-1.5 rounded-full text-blue-600 w-9 -my-0.5 hidden lg:block" data-tippy-placement="top" title="Tooltip" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16l4.586-4.586a2 2 0 012.828 0L16 16m-2-2l1.586-1.586a2 2 0 012.828 0L20 14m-6-6h.01M6 20h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z"></path></svg>
                                Photo/Video 
                            </div>
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer"> 
                                <svg class="bg-green-100 h-9 mr-2 p-1.5 rounded-full text-green-600 w-9 -my-0.5 hidden lg:block" uk-tooltip="title: Messages ; pos: bottom ;offset:7" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" title="" aria-expanded="false"> <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z"></path></svg>
                                Tag Friend 
                            </div>
                            <div class="hover:bg-gray-100 flex items-center p-1.5 rounded-md cursor-pointer"> 
                                <svg class="bg-red-100 h-9 mr-2 p-1.5 rounded-full text-red-600 w-9 -my-0.5 hidden lg:block" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14.828 14.828a4 4 0 01-5.656 0M9 10h.01M15 10h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>
                                Fealing /Activity 
                            </div>
                       </div> 
                   </div>
           
                   
                   
                   <livewire:clients.profile.posts :user_id="$info->user_id" />

           
                   
               

                </div>

                <!-- Sidebar -->
                <div class="w-full space-y-6">
                
                    <div class="widget card p-5">
                        <h4 class="text-lg font-semibold"> Giới thiệu </h4>
                        <ul class="text-gray-600 space-y-3 mt-3">
                            <li class="flex items-center space-x-2"> 
                                <ion-icon name="home-sharp" class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                Live In <strong> Cairo , Eygept  </strong>
                            </li>
                            <li class="flex items-center space-x-2"> 
                                <ion-icon name="globe" class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                From <strong> Aden , Yemen  </strong>
                            </li>
                            <li class="flex items-center space-x-2"> 
                                <ion-icon name="heart-sharp" class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                From <strong> Relationship  </strong>
                            </li>
                            <li class="flex items-center space-x-2"> 
                                <ion-icon name="logo-rss" class="rounded-full bg-gray-200 text-xl p-1 mr-3"></ion-icon>
                                Flowwed By <strong> 3,240 People </strong>
                            </li>                                
                        </ul>
                        <div class="gap-3 grid grid-cols-3 mt-4">
                          <img src="assets/images/avatars/avatar-lg-2.jpg" alt="" class="object-cover rounded-lg col-span-full">
                          <img src="assets/images/avatars/avatar-2.jpg" alt="" class="rounded-lg">
                          <img src="assets/images/avatars/avatar-4.jpg" alt="" class="rounded-lg">
                          <img src="assets/images/avatars/avatar-5.jpg" alt="" class="rounded-lg"> 
                      </div>
                      <a href="#" class="button gray mt-3 w-full"> Chỉnh sửa </a>
                    </div>
                
                    <div class="widget card p-5 border-t">
                        <div class="flex items-center justify-between mb-4">
                            <div>
                                <h4 class="text-lg font-semibold"> Friends </h4>
                                <p class="text-sm"> 3,4510 Friends</p>
                            </div>
                            <a href="#" class="text-blue-600 ">See all</a>
                        </div>
                        <div class="grid grid-cols-3 gap-3 text-gray-600 font-semibold">
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-1.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Dennis Han </div>
                            </a>
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-2.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Erica Jones </div>
                            </a>
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-3.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Stella Johnson </div>
                            </a>
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-4.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Alex Dolgove</div>
                            </a>
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-5.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Jonathan Ali </div>
                            </a>
                            <a href="#">  
                                <div class="avatar relative rounded-md overflow-hidden w-full h-24 mb-2"> 
                                    <img src="assets/images/avatars/avatar-6.jpg" alt="" class="w-full h-full object-cover absolute">
                                </div>
                                <div class="text-sm truncate"> Erica Han </div>
                            </a>
                        </div>
                      <a href="#" class="button gray mt-3 w-full">  See all </a>
                    </div>

                    <div class="widget card p-5 border-t">
                        <div class="flex items-center justify-between mb-2">
                            <div>
                                <h4 class="text-lg font-semibold"> Groups </h4>
                            </div>
                            <a href="#" class="text-blue-600 "> See all</a>
                        </div>
                        <div>
                      
                          <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                              <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                  <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                              </a>
                              <div class="flex-1">
                                  <a href="timeline-page.html" class="text-base font-semibold capitalize"> Graphic Design  </a>
                                  <div class="text-sm text-gray-500 mt-0.5"> 345K  Following</div>
                              </div>
                              <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                  Join
                              </a>
                          </div>
                          <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                              <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                  <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                              </a>
                              <div class="flex-1">
                                  <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders </a>
                                  <div class="text-sm text-gray-500 mt-0.5"> 452k Following </div>
                              </div>
                              <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                  Join
                              </a>
                          </div>
                          <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                              <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                  <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0" alt="">
                              </a>
                              <div class="flex-1">
                                  <a href="timeline-page.html" class="text-base font-semibold capitalize">  Coffee Addicts  </a>
                                  <div class="text-sm text-gray-500 mt-0.5"> 845K Following</div>
                              </div>
                              <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                  Join
                              </a>
                          </div>
                          <div class="flex items-center space-x-4 rounded-md -mx-2 p-2 hover:bg-gray-50">
                              <a href="timeline-group.html" class="w-12 h-12 flex-shrink-0 overflow-hidden rounded-full relative">
                                  <img src="assets/images/group/group-1.jpg" class="absolute w-full h-full inset-0" alt="">
                              </a>
                              <div class="flex-1">
                                  <a href="timeline-page.html" class="text-base font-semibold capitalize"> Architecture    </a>
                                  <div class="text-sm text-gray-500 mt-0.5"> 237K Following</div>
                              </div>
                              <a href="timeline-page.html" class="flex items-center justify-center h-8 px-3 rounded-md text-sm border font-semibold bg-blue-500 text-white">
                                  Join
                              </a>
                          </div>
                  
                        </div>
                    </div>

                </div>
            </div>
                  
            <!-- Friends  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <h2 class="text-xl font-bold"> Friends</h2>

                <nav class="responsive-nav border-b">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2"> All Friends <span> 3,4510 </span> </a></li>
                        <li><a href="#" class="lg:px-2"> Recently added </a></li>
                        <li><a href="#" class="lg:px-2"> Family </a></li>
                        <li><a href="#" class="lg:px-2"> University </a></li> 
                    </ul>
                </nav>

                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-x-2 gap-y-4 mt-3">

                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-2.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5">  James Lewis </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5"> Monroe Parker  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-4.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5">  Martin Gray  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-7.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5">  Alex Michael </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-5.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5"> Jesse Stevens  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-6.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5"> Erica Jones  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-2.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5">  James Lewis </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card p-2">
                        <a href="timeline.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-md shadow-sm w-full">
                        </a>
                        <div class="pt-3 px-1">
                            <a href="timeline.html" class="text-base font-semibold mb-0.5"> Monroe Parker  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-blue-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md text-blue-600 text-sm mb-1">
                                Following
                            </button>
                        </div>
                    </div>

                </div>
                     
                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>

            </div>

            <!-- Photos  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <div class="flex justify-between items-start relative md:mb-4 mb-3">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold"> Photos </h2>
                        <nav class="responsive-nav style-2 md:m-0 -mx-4">
                            <ul>
                                <li class="active"><a href="#">  Photos of you  <span> 230</span> </a></li>
                                <li><a href="#"> Recently added </a></li>
                                <li><a href="#"> Family </a></li>
                                <li><a href="#"> University </a></li>
                                <li><a href="#"> Albums </a></li>
                            </ul>
                        </nav>
                    </div>
                    <a href="#offcanvas-create" uk-toggle class="flex items-center justify-center z-10 h-10 w-10 rounded-full bg-blue-600 text-white absolute right-0"
                    data-tippy-placement="left" title="Create New Album">
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M10 5a1 1 0 011 1v3h3a1 1 0 110 2h-3v3a1 1 0 11-2 0v-3H6a1 1 0 110-2h3V6a1 1 0 011-1z" clip-rule="evenodd"></path></svg>
                    </a>
                </div>

                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-3 mt-5">
                    <div>
                        <div class="bg-green-400 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/post/img-1.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/post/img-2.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/avatars/avatar-3.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/post/img-4.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/avatars/avatar-7.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/avatars/avatar-4.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/post/img-1.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                    <div>
                        <div class="bg-gray-200 max-w-full lg:h-44 h-36 rounded-lg relative overflow-hidden shadow uk-transition-toggle">
                            <img src="assets/images/post/img-2.jpg" class="w-full h-full absolute object-cover inset-0">
                            <!-- overly-->
                            <div class="-bottom-12 absolute bg-gradient-to-b from-transparent h-1/2 to-gray-800 uk-transition-slide-bottom-small w-full"></div>
                            <div class="absolute bottom-0 w-full p-3 text-white uk-transition-slide-bottom-small">
                                <div class="text-base"> Image description  </div>
                                <div class="flex justify-between text-xs">
                                   <a href="#">  Like</a>
                                   <a href="#">  Comment </a>
                                   <a href="#">  Share </a> 
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>

            </div>

            <!-- Pages  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <h2 class="text-xl font-bold"> Pages</h2>
                <nav class="responsive-nav border-b md:m-0 -mx-4">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2"> Following </a></li>
                        <li><a href="#" class="lg:px-2"> Newest </a></li>
                        <li><a href="#" class="lg:px-2"> My pages</a></li>
                        <li><a href="#" class="lg:px-2"> Suggestions</a></li>
                    </ul>
                </nav>

                <div class="grid md:grid-cols-4 sm:grid-cols-3 grid-cols-2 gap-4 mt-5">
                    
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-4.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> John Michael  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                   
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> 
                                Alex Dolgove </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-5.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Dennis Han  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-7.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5">  Monroe Parker   </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-6.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> Erica Jones </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-2.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5">  Stella Johnson</a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-4.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> John Michael  </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>
                   
                    <div class="card">
                        <a href="timeline-page.html">
                            <img src="assets/images/avatars/avatar-3.jpg" class="h-36 object-cover rounded-t-md shadow-sm w-full">
                        </a>
                        <div class="p-3">
                            <a href="timeline-page.html" class="text-base font-semibold mb-0.5"> 
                                Alex Dolgove </a>
                            <p class="font-medium text-sm">843K Following </p>
                            <button class="bg-gray-100 w-full flex font-semibold h-8 items-center justify-center mt-3 px-3 rounded-md  text-sm">
                                Following
                            </button>
                        </div>
                    </div>

                </div>
                 
                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>
                
            </div>

            <!-- Groups  -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">

                <div class="flex justify-between items-start relative md:mb-4 mb-3">
                    <div class="flex-1">
                        <h2 class="text-xl font-bold"> Groups </h2>
                        <nav class="responsive-nav style-2 md:m-0 -mx-4">
                            <ul>
                                <li class="active"><a href="#"> Joined <span> 230</span> </a></li>
                                <li><a href="#"> My Groups </a></li>
                                <li><a href="#"> Discover </a></li> 
                            </ul>
                        </nav>
                    </div>
                    <a href="create-group.html" data-tippy-placement="left" data-tippy="" data-original-title="Create New Album" class="bg-blue-100 font-semibold py-2 px-6 rounded-md text-sm md:mt-0 mt-3 text-blue-600">
                        Create       
                    </a>
                </div>

                <div class="grid md:grid-cols-2  grid-cols-2 gap-x-2 gap-y-4 mt-3"> 
                     
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">Graphic Design </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders  </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">  Coffee Addicts  </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-5.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">  Property Rent  </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-1.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Architecture </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-3.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">Graphic Design </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-4.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize"> Mountain Riders  </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    <div class="flex items-center flex-col md:flex-row justify-center p-4 rounded-md shadow hover:shadow-md md:space-x-4">
                        <a href="timeline-group.html" iv="" class="w-16 h-16 flex-shrink-0 overflow-hidden rounded-full relative">
                            <img src="assets/images/group/group-2.jpg" class="absolute w-full h-full inset-0 " alt="">
                        </a>
                        <div class="flex-1">
                            <a href="timeline-page.html" class="text-base font-semibold capitalize">  Coffee Addicts  </a>
                            <div class="text-sm text-gray-500"> 54 mutual friends </div>
                        </div>
                        <button class="bg-gray-100 font-semibold py-2 px-3 rounded-md text-sm md:mt-0 mt-3">
                            Following
                        </button>
                    </div>
                    
                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white dark:bg-gray-900 font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>

            </div>

             <!-- Videos -->
            <div class="card md:p-6 p-2 max-w-3xl mx-auto">  
                
                <h2 class="text-xl font-semibold"> Friend</h2>
                <nav class="responsive-nav border-b">
                    <ul>
                        <li class="active"><a href="#" class="lg:px-2">   Suggestions </a></li>
                        <li><a href="#" class="lg:px-2"> Newest </a></li>
                        <li><a href="#" class="lg:px-2"> My Videos </a></li>
                    </ul>
                </nav>

                <div class="grid md:grid-cols-3 grid-cols-2  gap-x-2 gap-y-4 mt-3">  
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-1.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-2.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-3.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-4.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-5.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                        
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-6.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-3.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-2.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                    <div>
                        <a href="video-watch.html" class="w-full h-36 overflow-hidden rounded-lg relative block">
                            <img src="assets/images/video/img-4.png" alt="" class="w-full h-full absolute inset-0 object-cover">
                            <span class="absolute bg-black bg-opacity-60 bottom-1 font-semibold px-1.5 py-0.5 right-1 rounded text-white text-xs"> 12:21</span>
                            <img src="assets/images/icon-play.svg" class="w-12 h-12 uk-position-center" alt="">
                        </a>
                    </div>
                </div>

                <div class="flex justify-center mt-6">
                    <a href="#" class="bg-white font-semibold my-3 px-6 py-2 rounded-full shadow-md dark:bg-gray-800 dark:text-white">
                        Load more ..</a>
                </div>
                
            </div>


        </div>

    </div>
</div>

@endsection
@section('js')

@endsection
