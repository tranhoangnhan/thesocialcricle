@extends('layouts.auth')
@section('css')
@endsection
@section('content')
    <div class="lg:p-12 max-w-5xl lg:my-0 my-12 mx-auto p-6 space-y- w-full flex flex-col">
        <div class="lg:p-12 p-7 space-y-3 relative bg-white shadow-xl rounded-md w-100 text-center relative">
            <img src="{{ asset('clients/assets/images/logo-dark.png') }}" class="top-5 left-5 w-24 absolute">
            <div id="error-message" class="text-6xl font-bold text-blue-600">404</div>
            <p class="text-xl text-gray-600" id="message">Trang bạn đang tìm kiếm không tồn tại.</p>
            <p class="text-xl text-blue-600" id="contact">Mọi đóng góp hoặc thắc mắc xin liên hệ
                <a href="https://facebook.com/thanhson1711" class="text-info">Admin</a>
            </p>
            <img src="{{ asset('clients/assets/images/error/404.png') }}" class="m-auto w-60 md:absolute top-0 right-0"
                id="image">
            <div class=" items-center mt-3"> <!-- Sử dụng "flex", "flex-col" và "items-center" -->
                <button type="button" id="goBackButton" class="bg-blue-500 font-semibold px-5 py-3 rounded-md text-white">
                    Trở lại
                </button>
                <button onclick="window.location.href='{{ route('home') }}'"
                    class="bg-blue-600 font-semibold px-5 py-3 rounded-md text-white">
                    Về trang chủ
                </button>
            </div>
            <p class="text-gray-600 bottom-0 left-5 absolute" id="time"></p>
        </div>
    </div>
@endsection
@section('js')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.2/gsap.min.js"></script>
    <script>
        let tl = gsap.timeline()
        tl.fromTo("#error-message", {
            x: -300,
            duration: 1,
            ease: "none",
            rotation: 360,
            color: "#9A4444",
            yoyo: true,
        }, {
            x: 0,
            duration: 2,
            rotation: 360,
            color: "#2563EB",
            yoyo: true,
        });

        tl.from("#contact", {
            duration: 1,
            opacity: 0,
            x: -50,
        });
        tl.fromTo("#image", {
            opacity: 0,
            duration: 0.2,
        }, {
            x: 0,
            opacity: 1,
            duration: 1,
            rotation: 0,
        });
        const tlerror = gsap.timeline({
            repeat: -1
        }); // Tạo một timeline vô hạn
        tlerror.fromTo("#error-message", {
            color: "#D80032",
        }, {
            color: "#2563EB",
            duration: 1,
            yoyo: true,
        });

        gsap.fromTo("#message", {
            x: 300,
            duration: 2,
            rotation: 360,
            color: "#2563EB",
        }, {
            x: 0,
            duration: 2,
            rotation: 360,
            color: "#2563EB",
        });
        document.getElementById('goBackButton').addEventListener('click', function() {
            history.back();
        });
        // const timeElement = document.getElementById("time");
        // const currentTime = new Date();
        // const formattedTime =
        //     `${currentTime.getHours()}:${currentTime.getMinutes()} ${currentTime.getDate()}/${currentTime.getMonth() + 1}/${currentTime.getFullYear()}`;
        // timeElement.textContent = formattedTime;

        const timeElement = document.getElementById("time");

        // Hàm để lấy thời gian hiện tại và định dạng nó thành "hh:mm dd/mm/yyyy"
        function getCurrentTime() {
            const currentTime = new Date();
            const hours = currentTime.getHours();
            const minutes = currentTime.getMinutes();
            const day = currentTime.getDate();
            const month = currentTime.getMonth() + 1; // Tháng trong JavaScript bắt đầu từ 0
            const year = currentTime.getFullYear();

            const formattedTime = `${hours}:${minutes} ${day}/${month}/${year}`;
            return formattedTime;
        }

        // Cập nhật thời gian trên trang web và áp dụng hiệu ứng màu
        function updateClock() {
            const formattedTime = getCurrentTime();
            timeElement.textContent = "";
            const timeArray = formattedTime.split("");

            // Duyệt qua mỗi phần tử trong mảng và áp dụng hiệu ứng màu
            timeArray.forEach((character, index) => {
                const span = document.createElement("span");
                span.textContent = character;
                timeElement.appendChild(span);

                // Áp dụng hiệu ứng màu cho từng con số
                gsap.from(span, {
                    color: getRandomColor(),
                    duration: 0.5,
                    repeat: -1,
                    yoyo: true,
                    delay: index * 0.1,
                });
            });
        }
        // Hàm để tạo màu ngẫu nhiên
        function getRandomColor() {
            const letters = "0123456789ABCDEF";
            let color = "#";
            for (let i = 0; i < 6; i++) {
                color += letters[Math.floor(Math.random() * 16)];
            }
            return color;
        }
        // Cập nhật thời gian ban đầu và sau đó cập nhật lại mỗi giây
        updateClock();
        setInterval(updateClock, 1000);
    </script>
@endsection
