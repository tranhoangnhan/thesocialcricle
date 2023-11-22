<div>
    <div class="content-wrapper" >
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <div class="container-fluid">
            <div class="row mb-2">
              <div class="col-sm-6">
                <h1>Quản lý video</h1>
              </div>
              <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                  <li class="breadcrumb-item"><a href="#">Home</a></li>
                  <li class="breadcrumb-item active">DataTables</li>
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
                @foreach ($sections as $section)
                    
                <div class="card">
                  <div class="card-header">
                    <h3 class="card-title">Phần {{$loop->iteration}}: {{$section->section_name}}</h3>
                  </div>
                  <!-- /.card-header -->
                  <div class="card-body">
                    <table id="example2" class="table table-bordered table-hover">
                      <thead>
                      <tr>
                        <th>Video</th>
                        <th>Tiêu đề</th>
                        <th>Vị trí</th>
                        <th>Xem trước</th>
                        <th>Thao tác</th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($sectionVideos[$section->section_id] as $video)                            
                      <tr>
                        <td width='200'><video  height="200" controls src="{{$video->material_url}}"></video></td>
                        <td>{{$video->material_name}}
                        </td>
                        <td>
                            <a wire:click='upPotision({{$section->section_id}}, "{{$video->slug}}")'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-up-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 0 0 8a8 8 0 0 0 16 0zm-7.5 3.5a.5.5 0 0 1-1 0V5.707L5.354 7.854a.5.5 0 1 1-.708-.708l3-3a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1-.708.708L8.5 5.707V11.5z"/>
                                </svg>
                            </a>
                            <a wire:click='downPotision({{$section->section_id}}, "{{$video->slug}}")'>
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-down-circle-fill" viewBox="0 0 16 16">
                                    <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8.5 4.5a.5.5 0 0 0-1 0v5.793L5.354 8.146a.5.5 0 1 0-.708.708l3 3a.5.5 0 0 0 .708 0l3-3a.5.5 0 0 0-.708-.708L8.5 10.293V4.5z"/>
                                </svg>
                            </a>
                     
                        </td>
                        @if($video->review == 1)

                        <td >
                            <button wire:click.prevent='turnOnPreview({{$video->material_id}})'  class="btn btn-primary">Bật</button>
                            <button disabled wire:click.prevent='turnOffPreview({{$video->material_id}})'  class="btn btn-danger">Tắt</button></td>              

                            @else
                            <td >
                            <button disabled wire:click.prevent='turnOnPreview({{$video->material_id}})'  class="btn btn-primary">Bật</button>
                                <button wire:click.prevent='turnOffPreview({{$video->material_id}})'  class="btn btn-danger">Tắt</button></td>              
                                              @endif
                        <td> <a wire:navigate href="{{route('control-video-edit', ['slug' => $course->slug])}}" class="btn btn-primary">Sửa</a> | <a class="btn btn-danger">Xóa</a></td>
                      </tr>
                      @endforeach
                     
                      </tbody>
                     
                    </table>
                  </div>
                  <!-- /.card-body -->
                </div>
                @endforeach

                <!-- /.card -->
    
           
                <!-- /.card -->
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->
          </div>
          <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
      </div></div>
