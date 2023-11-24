!(function (e, n) {
    "object" == typeof exports && "undefined" != typeof module
        ? n(exports)
        : "function" == typeof define && define.amd
        ? define(["exports"], n)
        : n(
              (((e =
                  "undefined" != typeof globalThis
                      ? globalThis
                      : e || self).Fancybox = e.Fancybox || {}),
              (e.Fancybox.l10n = e.Fancybox.l10n || {}))
          );
})(this, function (e) {
    "use strict";
    const n = {
        PANUP: "Lên",
        PANDOWN: "Xuống",
        PANLEFT: "Trái",
        PANRIGHT: "Phải",
        ZOOMIN: "Phóng to",
        ZOOMOUT: "Thu nhỏ",
        TOGGLEZOOM: "Chuyển đổi mức phóng to",
        TOGGLE1TO1: "Chuyển đổi đúng tỷ lệ",
        ITERATEZOOM: "Chuyển đổi mức phóng to",
        ROTATECCW: "Xoay ngược chiều kim đồng hồ",
        ROTATECW: "Xoay theo chiều kim đồng hồ",
        FLIPX: "Lật ngang",
        FLIPY: "Lật dọc",
        FITX: "Căn chỉnh theo chiều ngang",
        FITY: "Căn chỉnh theo chiều dọc",
        RESET: "Thiết lập lại",
        TOGGLEFS: "Chuyển đổi chế độ toàn màn hình",
        CLOSE: "Đóng",
        NEXT: "Tiếp theo",
        PREV: "Trước đó",
        MODAL: "Bạn có thể đóng nội dung này bằng phím ESC",
        ERROR: "Có lỗi xảy ra, vui lòng thử lại sau",
        IMAGE_ERROR: "Không tìm thấy hình ảnh",
        ELEMENT_NOT_FOUND: "Không tìm thấy phần tử HTML",
        AJAX_NOT_FOUND: "Lỗi khi tải AJAX: Không tìm thấy",
        AJAX_FORBIDDEN: "Lỗi khi tải AJAX: Bị cấm",
        IFRAME_ERROR: "Lỗi khi tải trang",
        TOGGLE_ZOOM: "Chuyển đổi mức phóng to",
        TOGGLE_THUMBS: "Chuyển đổi xem trước",
        TOGGLE_SLIDESHOW: "Chuyển đổi chế độ trình chiếu ảnh",
        TOGGLE_FULLSCREEN: "Chuyển đổi chế độ toàn màn hình",
        DOWNLOAD: "Tải về",
    };
    e.vi = n;
});
