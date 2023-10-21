# DỰ ÁN MẠNG XÃ HỘI GIÁO DỤC THE SOCIAL CRICLE
# NHỚ GIẢI NÉN FILE VENDOR, ĐỔI TÊN FILE FILEENVNE THÀNH .ENV

# ĐĂNG NHẬP GIT
- git config --global user.name "TÊN"
- git config --global user.email "mail"

# Lưu ý cho anh em:
- Nếu chưa có dự án ở máy chạy lệnh: git clone https://github.com/tranhoangnhan/thesocialcricle.git (cài đặt git ssh).
- Clone về xong thì tạo branch để code: git checkout -b TênBranch
- Nếu trên GIT có code mới mà ở máy chưa có thì xài lệnh để lấy về: git pull
- Code ở nhánh, clone về rồi code xong up lên nhánh, khi nào ổn thì merge lại nhánh main

# Các bước deloy code:
 + git add . hoặc git add TênFile  (git add. là up tất cả).
 + git commit -m "Mô tả"
 + git push origin TênNhánh  (không up nhánh main).
- 
 + git status để xem trạng thái thay đổi file.
 + Vào nhánh khác sử dụng git checkout TênNhánh

# Conflict khi có người code và up lên github nhưng anh em ở máy local cũng code file đó và up lên. Vì ở Local chưa có nên sẽ bị xung độtCần pull về và push lên lại hoặc vào file cần sửa sẽ có các comment để lựa code muốn push lên.

# Link dự án: https://github.com/tranhoangnhan/thesocialcricle
# Đây là dự án được phát triển bởi nhóm F5. Dự án mang tên The Social Cricle cung cấp nền tảng giáo dục trực tuyến. Bên cạnh đó còn cho phép mọi người chia sẻ thông tin với nhau.
