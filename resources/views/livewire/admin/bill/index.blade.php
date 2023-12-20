<div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách hóa đơn</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-6 col-sm-3">
                                <div class="d-flex">
                                    <input type="text" name="kw" class="form-control search" placeholder="Tìm kiếm...">
                                    <button type="submit" class="btn btn-primary mx-1">
                                        <i class="ri-search-line search-icon"></i>
                                    </button>
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
                                            <th>Mã hóa đơn</th>
                                            <th>Khóa học</th>
                                            <th>Tên người mua</th>
                                            <th>Tổng tiền</th>
                                            <th>Ngày mua</th>
                                            <th>Hành động</th>
                                        </tr>
                                    </thead>
                                    <tbody class="list form-check-all">
                                        @foreach ($bills as $row)
                                            <tr>
                                                <th scope="row">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox"
                                                            onclick="anhien()" name="checkboxes[]"
                                                            value="{{ $row->id }}">
                                                    </div>
                                                </th>
                                                <td>{{ $row->vnp_TxnRef }}</td>
                                                <td>{{$row->course_name}}</td>
                                                <td>{{$row->user_name}}</td>
                                                <td>{{$row->vnp_Amount}}đ</td>
                                                <td>{{$row->created_at}}</td>
                                                <td>
                                                    <div class="d-flex gap-2">
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
