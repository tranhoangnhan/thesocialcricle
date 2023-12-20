<div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách danh mục khóa học</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm-6 col-5">
                                <div>
                                    <a data-bs-toggle="modal" data-bs-target="#Create"
                                        class="btn btn-success add-btn"><i class="ri-add-line align-bottom me-1"></i>
                                        Thêm</a>
                                    <button class="btn btn-soft-danger" hidden id="btn_delete" type="submit"
                                        onclick="return confirm('Bạn xác nhận muốn xóa tài khoản?')"><i
                                            class="ri-delete-bin-2-line"></i></button>
                                </div>
                            </div>
                            <div class="col-sm-6 col-7">
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
                                        <th>Tên khóa học</th>
                                        <th>Slug</th>
                                        <th>Số lượng</th>
                                        <th>Ngày tạo</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($category as $row)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" onclick="anhien()"
                                                        name="checkboxes[]" value="{{ $row->id }}">
                                                </div>
                                            </th>
                                            <td>{{ $row->category_name }}</td>
                                            <td>{{ $row->slug }}</td>
                                            <td>{{ $row->count }}</td>
                                            <td>{{ $row->created_at }}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <a data-bs-toggle="modal"
                                                            data-bs-target="#Update-{{ $row->category_id }}"
                                                            class="btn btn-sm btn-info edit-item-btn">
                                                            Chỉnh sửa
                                                        </a>
                                                    </div>
                                                    <div class="edit">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#confirmDelete-{{ $row->category_id }}"
                                                            class="btn btn-sm btn-danger edit-item-btn">
                                                            Xóa
                                                        </button>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                        <div wire:ignore.self class="modal fade" id="Update-{{ $row->category_id }}"
                                            tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cập nhật danh
                                                            mục</h5>
                                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Tên
                                                                danh mục hiện tại</label>
                                                            <input type="email" class="form-control" disabled
                                                                value="{{ $row->category_name }}">
                                                        </div>
                                                        <div class="mb-3">
                                                            <label for="exampleFormControlInput1" class="form-label">Tên
                                                                danh mục mới</label>
                                                            <input type="email" class="form-control"
                                                                wire:model='category_name'>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-bs-dismiss="modal">Hủy</button>
                                                        <button type="button"
                                                            wire:click="Update({{ $row->category_id }})"
                                                            class="btn btn-danger close-modal"
                                                            data-bs-dismiss="modal">Cập nhật</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div wire:ignore.self class="modal fade"
                                            id="confirmDelete-{{ $row->category_id }}" tabindex="-1" role="dialog"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Cảnh báo hành
                                                            động</h5>
                                                        <button type="button" class="btn btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close">
                                                        </button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Bạn có muốn xóa danh mục
                                                            {{ $row->category_name }}?</p>
                                                        <p>(Điều này sẽ xoá dữ liệu vĩnh viễn)</p>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary close-btn"
                                                            data-bs-dismiss="modal">Không</button>
                                                        <button type="button"
                                                            wire:click="delete({{ $row->category_id }})"
                                                            class="btn btn-danger close-modal"
                                                            data-bs-dismiss="modal">Có, tôi muốn xoá</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                    <div wire:ignore.self class="modal fade" id="Create" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Thêm danh mục</h5>
                                                    <button type="button" class="btn btn-close" data-bs-dismiss="modal" aria-label="Close">
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="mb-3">
                                                        <label for="exampleFormControlInput1" class="form-label">Tên danh mục</label>
                                                        <input type="email" class="form-control" wire:model='category_name'>
                                                        @error('category_name')
                                                            <small class="text-danger">{{ $message }}</small>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Hủy</button>
                                                    <button type="button" wire:click="Create()" class="btn btn-danger close-modal" data-bs-dismiss="modal">
                                                        Tạo
                                                    </button>
                                                    
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div><!-- end card -->
            </div> <!-- end col -->
        </div> <!-- end col -->
    </div>


</div>
