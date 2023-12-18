<div>
    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Quản lý tài khoản</h4>
                    </div><!-- end card header -->

                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-auto">
                                    <div>
                                        <button type="button" class="btn btn-success add-btn" data-bs-toggle="modal" id="create-btn" data-bs-target="#showModal"><i class="ri-add-line align-bottom me-1"></i> Thêm</button>
                                    </div>
                                </div>
                                <div class="col-sm">
                                    <div class="d-flex justify-content-sm-end">
                                        <div class="search-box ms-2">
                                            <input type="text" class="form-control search" placeholder="Search...">
                                            <i class="ri-search-line search-icon"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                    <tr>
                                        <th scope="col" style="width: 50px;">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            </div>
                                        </th>
                                        <th class="sort" data-sort="customer_name">Tên người dùng</th>
                                        <th class="sort" data-sort="email">Email</th>
                                        <th class="sort" data-sort="phone">Số điện thoại</th>
                                        <th class="sort" data-sort="date">Ngày tham gia</th>
                                        <th class="sort" data-sort="date">Thấy lần cuối</th>
                                        <th class="sort" data-sort="status">Vai trò</th>
                                        <th class="sort" data-sort="status">Trạng thái</th>
                                        <th class="sort" data-sort="action">Chức năng</th>
                                    </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                    @foreach($users as $users)
                                    <tr>
                                        <th scope="row">
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="chk_child" value="option1">
                                            </div>
                                        </th>

                                            <td class="id" style="display:none;"><a href="javascript:void(0);" class="fw-medium link-primary">#VZ2101</a></td>
                                            <td class="customer_name">{{$users->user_fullname}}</td>
                                            <td class="email">{{$users->user_email}}</td>
                                            <td class="phone">{{$users->user_phone}}</td>
                                            <td class="date">{{$users->user_registered}}</td>
                                            <td class="date">{{$users->user_last_seen}}</td>
                                            <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">
                                                @if($users->user_role == 0)
                                                        Người dùng
                                                    @elseif($users->user_role == 1)
                                                        Giảng viên
                                                    @elseif($users->user_role == 9)
                                                        Mod
                                                    @elseif($users->user_role == 10)
                                                        Admin
                                                    @endif
                                                </span></td>
                                            @if($users->user_banned == 0)
                                            <td class="status"><span class="badge bg-success-subtle text-success text-uppercase">
                                                    Đang hoạt động
                                                </span></td>
                                            @elseif($users->user_banned == 1)
                                            <td class="status"><span class="badge bg-danger-subtle text-warning text-uppercase">
                                                    Bị chặn
                                                </span></td>
                                            @endif

                                        <td>
                                            @if(Auth::user()->user_role == 10 && Auth::user()->user_banned == 0)
                                                @if($users->user_banned == 0)
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button wire:click.prevent="getUpdateId({{$users->user_id}})" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#updateModal">Sửa</button>
                                                        </div>
                                                        <div class="block">
                                                            <button wire:click="getBlockId({{$users->user_id}})" class="btn btn-sm btn-warning remove-item-btn" data-bs-toggle="modal" data-bs-target="#blockRecordModal">Chặn</button>
                                                        </div>
                                                        <div wire:click="getDeleteId({{$users->user_id}})" class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Xoá</button>
                                                        </div>
                                                    </div>
                                                @elseif($users->user_banned == 1)
                                                    <div class="d-flex gap-2">
                                                        <div wire:click="getUnblockId({{$users->user_id}})" class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#unblockRecordModal">Bỏ chặn</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @elseif(Auth::user()->user_role == 9 && Auth::user()->user_banned == 0)
                                                @if($users->user_banned == 0 && $users->user_role == 0 || $users->user_role == 1)
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <button wire:click="confirmUpdateId({{$users->user_id}})" class="btn btn-sm btn-success edit-item-btn" data-bs-toggle="modal" data-bs-target="#updateModal">Sửa</button>
                                                        </div>
                                                        <div class="block">
                                                            <button wire:click="getBlockId({{$users->user_id}})" class="btn btn-sm btn-warning remove-item-btn" data-bs-toggle="modal" data-bs-target="#blockRecordModal">Chặn</button>
                                                        </div>
                                                        <div wire:click="getDeleteId({{$users->user_id}})" class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#deleteRecordModal">Xoá</button>
                                                        </div>
                                                    </div>
                                                @elseif($users->user_banned == 1 && $users->user_role == 0 || $users->user_role == 1)
                                                    <div class="d-flex gap-2">
                                                        <div wire:click="getUnblockId({{$users->user_id}})" class="remove">
                                                            <button class="btn btn-sm btn-danger remove-item-btn" data-bs-toggle="modal" data-bs-target="#unblockRecordModal">Bỏ chặn</button>
                                                        </div>
                                                    </div>
                                                @endif
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                                <div class="noresult" style="display: none">
                                    <div class="text-center">
                                        <lord-icon src="https://cdn.lordicon.com/msoeawqm.json" trigger="loop" colors="primary:#121331,secondary:#08a88a" style="width:75px;height:75px"></lord-icon>
                                        <h5 class="mt-2">Sorry! No Result Found</h5>
                                        <p class="text-muted mb-0">We've searched more than 150+ Orders We did not find any orders for you search.</p>
                                    </div>
                                </div>
                            </div>

                            <div class="d-flex justify-content-end">
                                <div class="pagination-wrap hstack gap-2">
                                    <a class="page-item pagination-prev disabled" href="javascript:void(0);">
                                        Previous
                                    </a>
                                    <ul class="pagination listjs-pagination mb-0"></ul>
                                    <a class="page-item pagination-next" href="javascript:void(0);">
                                        Next
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div>
                <!-- end col -->
            </div>
            <!-- end col -->
        </div>
    </div>

{{--    Modals--}}

{{--    Modal-add--}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header bg-light p-3">
                    <h5 class="modal-title" id="exampleModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                </div>
                <div class="card-body">
                    <form class="form-steps" autocomplete="off">
                        <div class="modal-body">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title mb-0">Nhập thông tin tài khoản</h4>
                                </div><!-- end card header -->
                                <div class="card-body">
                                    <form action="#" class="form-steps" autocomplete="off">
                                        <div class="text-center pt-3 pb-4 mb-1">
                                            <h5>Đăng ký tài khoản</h5>
                                        </div>
                                        <div id="custom-progress-bar" class="progress-nav mb-4">
                                            <div class="progress" style="height: 1px;">
                                                <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>

                                            <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
                                                </li>
                                                <li class="nav-item" role="presentation">
                                                    <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab" data-bs-toggle="pill" data-bs-target="#pills-info-desc" type="button" role="tab" aria-controls="pills-info-desc" aria-selected="false">2</button>
                                                </li>
                                            </ul>
                                        </div>

                                        <div class="tab-content">
                                            <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                                <div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Tên tài khoản</label>
                                                                <input wire:model="user_name" type="text" class="form-control" id="gen-info-username-input" placeholder="Nhập tên tài khoản" required >
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Họ và tên</label>
                                                                <input wire:model="user_fullname" type="text" class="form-control" id="gen-info-username-input" placeholder="Nhập họ và tên" required >
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-email-input">Email</label>
                                                        <input wire:model="user_email" type="email" class="form-control" id="gen-info-email-input" placeholder="Nhập email" required >
                                                        <div class="invalid-feedback">Please enter an email address</div>
                                                    </div>
                                                    <div class="mb-3">
                                                        <label class="form-label" for="gen-info-password-input">Mật khẩu</label>
                                                        <input wire:model="user_password" type="password" class="form-control" id="gen-info-password-input" placeholder="Nhập Password" required >
                                                        <div class="invalid-feedback">Please enter a password</div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Số điện thoại</label>
                                                                <input wire:model="user_phone" type="text" class="form-control" id="gen-info-username-input" placeholder="Nhập số điện thoại" required >
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Ngày sinh</label>
                                                                <input wire:model="user_date" type="date" class="form-control" id="gen-info-username-input" required >
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Giới tính: </label>
                                                                <select wire:model="user_gender" id="cars">
                                                                    <option value="0" selected>Nam</option>
                                                                    <option value="1">Nữ</option>
                                                                    <option value="2">Khác</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Kích hoạt tài khoản: </label>
                                                                <select wire:model="user_active" id="cars">
                                                                    <option value="1" selected>Có</option>
                                                                    <option value="0">Không</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                        <div class="col-lg-6">
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-username-input">Vai trò: </label>
                                                                <select wire:model="user_role" id="cars">
                                                                    <option value="0" selected>Người dùng</option>
                                                                    <option value="1">Giảng viên</option>
                                                                    <option value="9">Mod</option>
                                                                    <option value="10">Admin</option>
                                                                </select>
                                                                <div class="invalid-feedback">Please enter a user name</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- end tab pane -->

                                            <!-- end tab pane -->
                                        </div>
                                        <!-- end tab content -->
                                    </form>
                                </div>
                                <!-- end card body -->
                            </div>
                        </div>
                        <div class="modal-footer">
                            <div class="hstack gap-2 justify-content-end">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                <button wire:click="createUser" type="submit" class="btn btn-success" id="add-btn" data-bs-dismiss="modal">Thêm</button>
                                <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
{{--Modal-update--}}
    @if($modalOpen)
        <div wire:click="closeModal" wire:ignore class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header bg-light p-3">
                        <h5 class="modal-title" id="exampleModalLabel"></h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="close-modal"></button>
                    </div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('update-user') }}"  class="form-steps" autocomplete="off">
                            @csrf
                                <div class="modal-body">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title mb-0">Thay đổi thông tin tài khoản</h4>
                                        </div><!-- end card header -->
                                        <div class="card-body">
                                            <form action="#" class="form-steps" autocomplete="off">
                                                <div class="text-center pt-3 pb-4 mb-1">
                                                    <h5>Chinh sửa tài khoản</h5>
                                                </div>
                                                <div id="custom-progress-bar" class="progress-nav mb-4">
                                                    <div class="progress" style="height: 1px;">
                                                        <div class="progress-bar" role="progressbar" style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                                    </div>

                                                    <ul class="nav nav-pills progress-bar-tab custom-nav" role="tablist">
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link rounded-pill active" data-progressbar="custom-progress-bar" id="pills-gen-info-tab" data-bs-toggle="pill" data-bs-target="#pills-gen-info" type="button" role="tab" aria-controls="pills-gen-info" aria-selected="true">1</button>
                                                        </li>
                                                        <li class="nav-item" role="presentation">
                                                            <button class="nav-link rounded-pill" data-progressbar="custom-progress-bar" id="pills-info-desc-tab2" data-bs-toggle="pill" data-bs-target="#pills-info-desc2" type="button" role="tab" aria-controls="pills-info-desc2" aria-selected="false">2</button>
                                                        </li>
                                                    </ul>
                                                </div>

                                                <div class="tab-content">
                                                    <div class="tab-pane fade show active" id="pills-gen-info" role="tabpanel" aria-labelledby="pills-gen-info-tab">
                                                        <div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Tên tài khoản</label>
                                                                        <input type="text" class="form-control" id="gen-info-username-input" name="username" placeholder="" value="{{$dataUpdate->user_username}}" required >
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Họ và tên</label>
                                                                        <input type="text" class="form-control" id="gen-info-username-input" name="fullname" placeholder="" value="{{$dataUpdate->user_fullname}}" required >
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-email-input">Email</label>
                                                                <input type="email" class="form-control" id="gen-info-email-input" name="email" value="{{$dataUpdate->user_email}}" placeholder="Nhập email" required >
                                                                <div class="invalid-feedback">Please enter an email address</div>
                                                            </div>
                                                            <div class="mb-3">
                                                                <label class="form-label" for="gen-info-password-input">Nhập mật khẩu mới( bắt buộc )</label>
                                                                <input type="password" class="form-control" id="gen-info-password-input" name="password" value="" placeholder="Nhập Password" required >
                                                                <div class="invalid-feedback">Please enter a password</div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Số điện thoại</label>
                                                                        <input type="text" class="form-control" id="gen-info-username-input" name="phone" value="{{$dataUpdate->user_phone}}" placeholder="Nhập số điện thoại" required >
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Ngày sinh</label>
                                                                        <input type="date" class="form-control" id="gen-info-username-input" name="birthday" value="{{$dataUpdate->user_birthday}}" required >
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="row">
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Giới tính: </label>
                                                                        <select name="genre" value="{{$dataUpdate->user_gender}}" id="cars">
                                                                            <option value="0" selected>Nam</option>
                                                                            <option value="1">Nữ</option>
                                                                            <option value="2">Khác</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Kích hoạt tài khoản: </label>
                                                                        <select name="active" value="{{$dataUpdate->user_email_verified}}" id="cars">
                                                                            <option value="1" selected>Có</option>
                                                                            <option value="0">Không</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6">
                                                                    <div class="mb-3">
                                                                        <label class="form-label" for="gen-info-username-input">Vai trò: </label>
                                                                        <select name="role" value="{{$dataUpdate->user_role}}" id="cars">
                                                                            <option value="0" selected>Người dùng</option>
                                                                            <option value="1">Giảng viên</option>
                                                                            <option value="9">Mod</option>
                                                                            <option value="10">Admin</option>
                                                                        </select>
                                                                        <div class="invalid-feedback">Please enter a user name</div>
                                                                    </div>
                                                                </div>
                                                                <input type="hidden" name="id" value="{{$dataUpdate->user_id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- end tab pane -->
                                                    <!-- end tab pane -->
                                                </div>
                                                <!-- end tab content -->
                                                <div class="hstack gap-2 justify-content-end">
                                                    <button wire:click="closeModal" type="button" class="btn btn-light" data-bs-dismiss="modal">Đóng</button>
                                                    <input type="submit" class="btn btn-success" id="add-btn">
                                                    <!-- <button type="button" class="btn btn-success" id="edit-btn">Update</button> -->
                                                </div>
                                            </form>
                                        </div>
                                        <!-- end card body -->
                                    </div>
                                </div>
                                <div class="modal-footer">

                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endif
{{--    Modal-block--}}
    <div wire:ignore class="modal fade zoomIn" id="blockRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/zoffwdeh.json"
                            trigger="loop"
                            style="width:250px;height:250px">
                        </lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Bạn có muốn chặn tài khoản này không ?</h4>
                            <p class="text-muted mx-4 mb-0">Tài khoản này sẽ dừng hoạt động sau khi xác nhận!</p>
                            <p>Người thực hiện chặn: {{Auth::user()->user_fullname}}</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button wire:click="confirmBlockId" type="submit" class="btn w-sm btn-danger " id="delete-record" data-bs-dismiss="modal">Tôi xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
{{--    Modal-unblock--}}
    <div wire:ignore class="modal fade zoomIn" id="unblockRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon
                            src="https://cdn.lordicon.com/guqkthkk.json"
                            trigger="loop"
                            style="width:250px;height:250px">
                        </lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Bạn có muốn bỏ chặn tài khoản này không ?</h4>
                            <p class="text-muted mx-4 mb-0">Tài khoản này sẽ hoạt động trở lại sau khi xác nhận!</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button wire:click="confirmUnlockId" type="submit" class="btn w-sm btn-danger " id="delete-record" data-bs-dismiss="modal">Tôi xác nhận</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal-delete -->
    <div wire:ignore class="modal fade zoomIn" id="deleteRecordModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" id="btn-close"></button>
                </div>
                <div class="modal-body">
                    <div class="mt-2 text-center">
                        <lord-icon src="https://cdn.lordicon.com/gsqxdxog.json" trigger="loop" colors="primary:#f7b84b,secondary:#f06548" style="width:100px;height:100px"></lord-icon>
                        <div class="mt-4 pt-2 fs-15 mx-4 mx-sm-5">
                            <h4>Bạn đã chắc muốn xoá không ?</h4>
                            <p class="text-muted mx-4 mb-0">Sau khi xoá tài khoản sẽ không thể khôi phục!</p>
                        </div>
                    </div>
                    <div class="d-flex gap-2 justify-content-center mt-4 mb-2">
                        <button type="button" class="btn w-sm btn-light" data-bs-dismiss="modal">Đóng</button>
                        <button wire:click="confirmDeleteId" type="submit" class="btn w-sm btn-danger " id="delete-record" data-bs-dismiss="modal">Xoá</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--end modal -->
</div>
