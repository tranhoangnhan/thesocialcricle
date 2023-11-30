<div>
    <div class="content-wrapper">
        @if ($this->message)
            {!! $this->message !!}
        @endif
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Chỉnh sửa thông tin video khóa học: {{ $course->course_name }}</h1>
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
                                    <h3 class="card-title">Phần {{ $loop->iteration }}: {{ $section->section_name }}
                                    </h3>
                                </div>
                                <!-- /.card-header -->
                                <div class="card-body">
                                    <table id="example2" class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Video</th>
                                                <th>Tiêu đề</th>
                                                <th>Thao tác</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($sectionVideos[$section->section_id] as $video)
                                                <tr>
                                                    <td width='200'><video height="200" controls
                                                            src="{{ $video->material_url }}"></video></td>
                                                    <td>
                                                        <div class="input-group flex-nowrap">
                                                            <span class="input-group-text" id="addon-wrapping">.</span>
                                                            <input wire:model.defer='title.{{ $video['material_id'] }}'
                                                                type="text" class="form-control"
                                                                placeholder="{{ $video->material_name }}"
                                                                aria-label="Username" aria-describedby="addon-wrapping">
                                                        </div>

                                                    </td>
                                                    <td>
                                                        <button
                                                            wire:click.prevent='saveTitle({{ $video['material_id'] }})'
                                                            class="btn btn-success">Cập nhật</button>
                                                    </td>
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
    </div>
</div>
