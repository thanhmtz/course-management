Giới thiệu

Dự án Course Management được xây dựng bằng Laravel, dùng để quản lý khóa học, bài học và học viên.

Yêu cầu hệ thống
PHP >= 8.0
Composer
MySQL / MariaDB
XAMPP / Laragon
Hướng dẫn chạy project
1. Clone project
git clone https://github.com/thanhmtz/course-management.git
cd course-management
2. Cài đặt thư viện
composer install
3. Tạo file môi trường
cp .env.example .env
4. Cấu hình database

Mở file .env và chỉnh:

DB_DATABASE=course_db
DB_USERNAME=root
DB_PASSWORD=

Nhớ tạo database course_db trong phpMyAdmin

5. Tạo key
php artisan key:generate
6. Chạy migration
php artisan migrate
7. Tạo storage link (hiển thị ảnh)
php artisan storage:link
8. Chạy project
php artisan serve

Truy cập:
http://127.0.0.1:8000

Chức năng
CRUD khóa học
Upload ảnh
Soft Delete (xóa mềm)
Khôi phục dữ liệu
Tìm kiếm theo tên
Sắp xếp theo giá
Phân trang
Công nghệ sử dụng
Laravel
Eloquent ORM
Bootstrap
Tác giả
Nguyễn Thành
 Ghi chú

Sau khi clone project cần chạy:

composer install
php artisan key:generate
php artisan migrate
php artisan serve