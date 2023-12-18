<div>
    <div class="row mt-5">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Danh sách phản hồi</h4>
                </div><!-- end card header -->
                <div class="card-body">
                    <div class="listjs-table" id="customerList">
                        <div class="row g-4 mb-3">
                            <div class="col-sm">
                                <div class="d-flex justify-content-end">
                                    <form action="{{ route('home') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-8">
                                                <input type="text" name="kw" class="form-control search"
                                                    placeholder="Tìm kiếm...">
                                            </div>
                                            <!--end col-->
                                            <div class="col-4">
                                                <button type="submit" class="btn btn-primary">
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
                                        <th>Họ tên</th>
                                        <th>Email</th>
                                        <th>Nội dung</th>
                                        <th>Ngày gửi</th>
                                        <th>Hành động</th>
                                    </tr>
                                </thead>
                                <tbody class="list form-check-all">
                                    @foreach ($feedback as $row)
                                        <tr>
                                            <th scope="row">
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" onclick="anhien()"
                                                        name="checkboxes[]" value="{{ $row->id }}">
                                                </div>
                                            </th>
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->content }}</td>
                                            <td>{{$row->created_at}}</td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <div class="edit">
                                                        <button wire:click="delete({{ $row->id}})"
                                                            class="btn btn-sm btn-danger edit-item-btn">
                                                            Xóa
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
