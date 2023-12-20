<div>
        <div class="row mt-5">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title mb-0">Danh sách khóa học</h4>
                    </div><!-- end card header -->
                    <div class="card-body">
                        <div class="listjs-table" id="customerList">
                            <div class="row g-4 mb-3">
                                <div class="col-sm-6 col-4">
                                    <div>
                                        <a href="/create-course" class="btn btn-success add-btn"><i
                                                class="ri-add-line align-bottom me-1"></i> Thêm</a>
                                        <button class="btn btn-soft-danger" hidden id="btn_delete" type="submit"
                                            onclick="return confirm('Bạn xác nhận muốn xóa tài khoản?')"><i
                                                class="ri-delete-bin-2-line"></i></button>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-8">
                                    <div class="d-flex justify-content-end">
                                        <form action="{{ route('home') }}" method="post">
                                            @csrf
                                            <div class="d-flex">
                                                <input type="text" name="kw" class="form-control search" placeholder="Tìm kiếm...">
                                                <button type="submit" class="btn btn-primary mx-1">
                                                    <i class="ri-search-line search-icon"></i>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
                                            <th>Banner</th>
                                            <th>Tên khóa học</th>
                                            <th>Trạng thái</th>
                                            <th>Danh mục</th>
                                            <th>Người tạo</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($courses as $row)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" onclick="anhien()"
                                                            name="checkboxes[]" value="{{ $row->id }}">
                                                    </div>
                                                </th>
                                                <td class="img_product"><img width="50" src="{{ asset($row->banner) }}" alt="">
                                                </td>
                                                <td>{{ $row->course_name }}</td>
                                                <td>{{ $row->status }}</td>
                                                <td>{{ $row->category_name }}</td>
                                                <td>{{ $row->user_name }}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
                                                        <div class="edit">
                                                            <a href="/courses/{{ $row->slug }}"
                                                                class="btn btn-sm btn-info edit-item-btn">
                                                                Chi tiết
                                                            </a>
                                                        </div>
                                                        <div class="edit">
                                                            @if ($row->status == 'Đang chờ duyệt')
                                                            <button wire:click="accept({{ $row->course_id }})"
                                                                class="btn btn-sm btn-success edit-item-btn">
                                                                Duyệt
                                                            </button>
                                                            @else
                                                            <button wire:click="accept({{ $row->course_id }})"
                                                                class="btn btn-sm btn-danger edit-item-btn">
                                                               Khóa
                                                            </button>
                                                            @endif
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
