<div>
    @if(auth()->user()->user_id == $course->instructor_id)
    <a href="{{route('control-index', ['slug' => $course->slug])}}">Truy cập quản trị</a>
@endif
    <ul class="flex align-items-start text-gray-500 text-sm">
        <li> Tạo bởi <a href="/profile/{{ $course->instructor_id }}" class="font-bold">
                {{ $course->user_fullname }}</a> </li>
        <span class="middot mx-3 text-2xl">·</span>
        <li>Ngày tạo: {{ $time}}</li>
        <span class="middot mx-3 text-2xl">·</span>
        <li>Số lượng thành viên: {{$enroll}} </li>
    </ul>
    @if ($enroller==true)
    <div class="row d-flex justify-content-between">
        <div class="col-6">
            <a class="btn btn-primary w-100" href="/courses/{{$course->slug}}/enroll/{{$first_video}}"> <i class="uil-play mr-1"></i>  Xem nội dung khóa học</a>
        </div>
        <div class="col-6">
            <button class="btn btn-danger" data-bs-toggle="modal" data-bs-target="#confirmDelete"><i class="uil-cancel mr-1"></i>  Hủy Tham gia </button>
        </div>
    </div>
    @else
        @if($checkCourse==1)
    <button wire:click='enroll({{$course->course_id}})' class="btn btn-primary w-100"> <i class="uil-plus mr-1"></i>Tham gia</button>
        @else
   
        <form action="/courses/{{$course->slug}}/checkout" method="post">
            @csrf
    <button type="submit"  name="redirect" class="btn btn-primary w-100"> <i class="uil-plus mr-1"></i>Đăng ký khóa học với {{$this->course->amount}} VND</button>
             
</form>
    @endif
    @endif
    <div wire:ignore.self class="modal fade" id="confirmDelete" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Cảnh báo hành động</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true close-btn">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Bạn có muốn rời khỏi khóa học {{$course->course_name}}?</p>
                    <p>(Điều này sẽ xoá câu hỏi cùng các câu trả lời)</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary close-btn" data-bs-dismiss="modal">Không</button>
                    <button type="button" wire:click.prevent='enroll({{$course->course_id}})' class="btn btn-danger close-modal" data-bs-dismiss="modal">Có, tôi muốn xoá</button>
                </div>
            </div>
        </div>
    </div>
</div>
