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
    <button wire:click.prevent='enroll({{$course->course_id}})' class="btn btn-secondary w-100">Hủy Tham gia </button>
    @else
    <button wire:click.prevent='enroll({{$course->course_id}})' class="btn btn-primary w-100">Tham gia </button>
    @endif
</div>
