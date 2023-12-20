<div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách báo cáo</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-3 col-6">
                                <div class="d-flex">
                                        <input type="text" name="kw" class="form-control search"
                                            placeholder="Tìm kiếm...">
                                        <button type="submit" class="btn btn-primary mx-1">
                                            <i class="ri-search-line search-icon"></i>
                                </div>
                            </div>
                            <div class="col-sm-7 d-sm-block d-none"></div>
                            <div class="col-sm-2 col-6 float-end d-flex justify-content-end">
                                <select wire:model='option' name="option" wire:change='changeOption()' class="form-select w-75">
                                    <option value="0">Bài viết</option>
                                    <option value="1">Người dùng</option>
                                    <option value="2">Khóa học</option>
                                </select>
                            </div>

                            <div class="table-responsive table-card mt-3 mb-1">
                                <table class="table align-middle table-nowrap" id="customerTable">
                                    <thead class="table-light">
                                        <tr>
                                            <th scope="col" style="width: 50px;">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" onclick="check()">
                                                </div>
                                            </th>
                                            @if ($option == 0)
                                            <th>Bài viết</th>
                                            @elseif($option == 1)
                                            <th>Người dùng</th>
                                            @else
                                            <th>Khóa học</th>
                                            @endif
                                            <th>Số người tố cáo</th>
                                            <th>Trạng thái</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($report as $row)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            onclick="anhien()" name="checkboxes[]"
                                                            value="{{ $row->id }}">
                                                    </div>
                                                </th>
                                                @if($option == 0)
                                                <td>{{ $row->post_title}}</td>
                                                @elseif($option == 1)
                                                <td>{{ $row->user_name}}</td>
                                                @else
                                                <td>{{ $row->course_name}}</td>
                                                @endif
                                                <td>{{ $row->vote }}</td>
                                                @if($row->vote>10)
                                                <td><span class="badge bg-danger-subtle text-danger text-uppercase">Cảnh báo</span></td>
                                                @else
                                                <td><span class="badge bg-success-subtle text-success text-uppercase">Chú ý</span></td>
                                                @endif
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="add">
                                                            @if($option == 0)
                                                            <a href= "#"
                                                                class="btn btn-sm btn-success edit-item-btn">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            @elseif ($option == 1)
                                                            <a href= "{{route('profile', ['id'=>$row->user_id]) }}"
                                                                class="btn btn-sm btn-success edit-item-btn">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            @else
                                                            <a href= "{{route('courses_intro', ['slug'=>$row->course_slug]) }}"
                                                                class="btn btn-sm btn-success edit-item-btn">
                                                                <i class="ri-eye-line"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                        <div class="block">
                                                            @if($option == 0)
                                                            <a wire:click='block({{ $row->post_id }})'
                                                                class="btn btn-sm btn-warning edit-item-btn">
                                                                <i class="ri-close-circle-line"></i>
                                                            </a>
                                                            @elseif ($option == 1)
                                                            {{$row->user_banned}}
                                                            @if($row->user_banned==1)
                                                            <a wire:click='unblock({{ $row->user_id }})'
                                                                class="btn btn-sm btn-warning edit-item-btn">
                                                                <i class="ri-delete-back-fill"></i>
                                                            @else
                                                            <a wire:click='block({{ $row->user_id}})'
                                                                class="btn btn-sm btn-warning edit-item-btn">
                                                                <i class="ri-close-circle-line"></i>
                                                            </a>
                                                            @endif
                                                            @else
                                                            <a wire:click='block({{ $row->course_id }})'
                                                                class="btn btn-sm btn-warning edit-item-btn">
                                                                <i class="ri-close-circle-line"></i>
                                                            </a>
                                                            @endif
                                                        </div>
                                                        <div class="edit">
                                                            <button wire:click="delete({{ $row->id }})"
                                                                class="btn btn-sm btn-danger edit-item-btn">
                                                                <i class="ri-delete-bin-line"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div><!-- end card -->
                </div> <!-- end col -->
            </div> <!-- end col -->
        </div>

    </div>
