<div>
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
            <button wire:click.prevent='enroll({{$course->course_id}})' class="btn btn-danger">  <i class="uil-cancel mr-1"></i>  Hủy Tham gia </button>
        </div>
    </div>
    @else
    <button wire:click.prevent='enroll({{$course->course_id}})' class="btn btn-primary w-100"> <i class="uil-plus mr-1"></i></button>
    @endif
</div>
