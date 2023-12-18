<div>
  <div class="content-wrapper">
      <!-- Content Header (Page header) -->
      <section class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1>Quản lý thành viên</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active">Quản lý thành viên</li>
              </ol>
            </div>
          </div>
        </div><!-- /.container-fluid -->
      </section>
  
      <!-- Main content -->
      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-12">
              <div class="card">
                <div class="card-header">
                  <h3 class="card-title">Tổng số thành viên khóa học: {{$count_enroll}}</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                  <table id="example2" class="table table-bordered table-hover">
                    <thead>
                    <tr>
                      <th>STT</th>
                      <th>Tên thành viên</th>
                      <th>Ngày tham gia khóa học</th>
                      <th>Thao tác</th>
                    </tr>
                    </thead>
                    <tbody>
                      @foreach($enrolls as $enroll)
                    <tr>
                      <td>{{$loop->iteration}}</td>
                      <td> <a href="/<?= '@' ?>{{$enroll->user_id}}">{{$enroll->user_fullname}}</a></td>
                      </td>
                      <td>{{$enroll->created_at}}</td>
                      <td><button class="btn btn-danger" wire:click='delete({{$enroll->user_id}})'>Xóa</button></td>
                    </tr>
                  @endforeach
                    </tbody>
               
                  </table>
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
           
            </div>
            <!-- /.col -->
          </div>
          <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
      </section>
      <!-- /.content -->
    </div>
  @section('js')
  <script>
      $(function () {
        $("#example1").DataTable({
          "responsive": true, "lengthChange": false, "autoWidth": false,
          "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
        }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
        $('#example2').DataTable({
          "paging": true,
          "lengthChange": false,
          "searching": false,
          "ordering": true,
          "info": true,
          "autoWidth": false,
          "responsive": true,
        });
      });
    </script>
  @endsection
  </div>
