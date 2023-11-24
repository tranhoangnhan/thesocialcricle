import Axios from "axios";
import locale_all from "@pqina/pintura/locale/vi_VN/index.js";
import { openDefaultEditor } from "@pqina/pintura/pintura.js";
import useEditorWithDropzone from "@pqina/dropzone-pintura/dist/useEditorWithDropzone.js";
const locale = {
    ...locale_all,
};

document.addEventListener("DOMContentLoaded", function () {
    function initializeEditor(elementId, type) {
        var element = document.getElementById(elementId);
        if (element) {
            element.addEventListener("click", function () {
                var imageSrc = element.getAttribute("data-image-src");
                var proxyUrl =
                    "http://127.0.0.1:8000/proxy?url=" +
                    encodeURIComponent(imageSrc);
                var pintura = openDefaultEditor({
                    src: proxyUrl,
                    locale: locale,
                    mimeType: "image/*",
                });
                pintura.on("process", (imageWriterResult) => {
                    uploadImageToDrive(imageWriterResult.dest, type);
                });
            });
        }
    }

    function uploadImageToDrive(destImage, type) {
        if (destImage) {
            var formData = new FormData();
            formData.append("file", destImage, destImage.name);
            axios
                .post("/upload", formData)
                .then((response) => {
                    updateAvatar(response.data, type);
                })
                .catch((error) => {
                    console.error("Lỗi khi tải ảnh lên");
                });
        } else {
            console.error("Không có tệp để tải lên.");
        }
    }

    function updateAvatar(data, type) {
        if (data) {
            var postData = {
                data: data,
                type: type,
            };
            axios
                .post("/profile/updateAvatar", postData)
                .then((response) => {
                    window.location.reload();
                })
                .catch((error) => {
                    window.location.reload();
                });
        }
    }

    initializeEditor("edit_Avatar", "avatar");
    initializeEditor("edit_Cover", "cover");
});
document.addEventListener("livewire:initialized", () => {
    if(document.getElementById("uploadMessage")){
 document.getElementById("uploadMessage").addEventListener("click", function () {
            document.getElementById("fileInput").click();
            document.getElementById("fileInput").addEventListener("change", function (event) {
                    const fileInput = event.target;
                    const file = fileInput.files[0];

                    if (file) {
                        openPintura(file);
                    }
                });

            function openPintura(file) {
                var pintura = openDefaultEditor({
                    src: URL.createObjectURL(file),
                    locale: locale,
                    mimeType: file.type,
                });

                pintura.on("process", (imageWriterResult) => {
                    processImage(imageWriterResult.dest);
                });
                async function processImage(file) {
                    Livewire.dispatch("uploadImageMessage", {
                        image: await readFileAsDataURL(file),
                    });
                    fileInput.value = null;
                }

                function readFileAsDataURL(file) {
                    return new Promise((resolve) => {
                        const reader = new FileReader();
                        reader.onloadend = () => {
                            resolve(reader.result);
                        };
                        reader.readAsDataURL(file);
                    });
                }
            }
        });
    }

});

function initializeDropzone(elementId, type) {
    Dropzone.options[elementId] = useEditorWithDropzone(
        openDefaultEditor,
        {
            imageCropAspectRatio: elementId === "pinturaDropzone" ? 1 : "",
            locale: locale,
        },

        {
            url: "/upload",
            maxFiles: 1,
            // acceptedFiles: "image/*,video/*",
            addRemoveLinks: true,
            dictDefaultMessage: "Kéo và thả hoặc nhấn để tải lên",
            dictFileTooBig:
                "Tệp quá lớn ({{filesize}} MB). Kích thước tối đa: {{maxFilesize}} MB.",
            dictRemoveFile: "Xóa",
            dictMaxFilesExceeded: "Bạn không thể upload quá {{maxFiles}} file",
            dictCancelUpload: "Hủy tải lên",
            dictInvalidFileType: "Định dạng này không hỗ trợ",
            dictFallbackMessage:
                "Trình duyệt bạn không hỗ trợ tải file lên. Vui lòng dùng trình duyệt khác!",
            method: "post",
            paramName: "file",
            headers: {
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            maxFilesize: 10,
            acceptedFiles:
                type == "story"
                    ? "image/jpeg,image/jpg,image/png,image/gif,image/webp,video/mp4,video/avi,video/mkv,video/mov"
                    : "image/jpeg,image/jpg,image/png,image/gif,image/webp",

            dictDefaultMessage:
                type == "story"
                    ? "Kéo hoặc chọn video, ảnh tải lên"
                    : "Kéo hoặc chọn ảnh để tải lên",
            autoProcessQueue: false,
            init: function () {
                var dropzoneInstance = this;
                let isVideo;
                var uploadButton = document.getElementById("U" + elementId);
                if (uploadButton) {
                    uploadButton.addEventListener("click", function () {
                        if (dropzoneInstance.getQueuedFiles().length > 0) {
                            dropzoneInstance.processQueue();
                        }
                    });
                }
                this.on("addedfile", function (file) {
                    isVideo = file.type.startsWith("video/");
                });
                this.on("error", function (file, errorMessage) {
                    console.log("Error:", errorMessage);
                });

                this.on("success", function (file, response) {
                    if (type == "avatar" || type == "cover") {
                        Livewire.dispatch("uploadAvatarProfile", {
                            data: response,
                            type: type,
                        });
                    }
                    if (type == "story") {
                        Livewire.dispatch("uploadStory", {
                            data: response,
                            type: type,
                            log: isVideo ? "video" : "image",
                        });
                    }

                    this.uploadedFileName = response.filename;
                    this.fileId = response.fileId;
                });

                this.on("removedfile", function (file) {
                    var fileId = this.fileId;
                    if (fileId) {
                        $.ajax({
                            type: "POST",
                            url: "/upload/delete",
                            headers: {
                                "X-CSRF-TOKEN": $(
                                    'meta[name="csrf-token"]'
                                ).attr("content"),
                            },
                            data: {
                                fileId: fileId,
                            },
                            success: function (data) {
                                dropzoneInstance.fileId = null;
                                dropzoneInstance.uploadedFileName = null;
                            },
                            error: function (xhr, status, error) {
                                console.log(xhr.responseText);
                            },
                        });
                    }
                });
            },
        }
    );
}
initializeDropzone("pinturaDropzone", "avatar");
initializeDropzone("uploadCoverProfile", "cover");
initializeDropzone("storyDropzone", "story");
