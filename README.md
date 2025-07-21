# Cấu trúc thư mục trong Laravel 12 - Hiểu đúng ngay từ đầu

Laravel là một framework PHP mạnh mẽ và phổ biến, được thiết kế với cấu trúc thư mục rõ ràng, giúp lập trình viên dễ dàng quản lý mã nguồn. Việc **hiểu rõ cấu trúc thư mục** ngay từ đầu sẽ giúp bạn **làm việc hiệu quả**, **dễ debug**, và **phát triển dự án quy mô lớn** dễ dàng hơn.

Dưới đây là phần giải thích chi tiết từng thư mục chính trong Laravel 12.

## 1. `app\` - Trung tâm logic của ứng dụng 

Đây là nơi chứa **logic cốt lõi** của ứng dụng Laravel. Bạn sẽ làm việc ở đây rất thường xuyên.

### Các thư mục con:

- `Http` : Thư mục này là cầu nối giữa **request từ người dùng**  và  **phản hồi từ ứng dụng**. Gồm 3 phần quan trọng: Controller, Middleware, Form Request.

### - `Controllers` : Bộ điều khiển
- Chịu trách nhiệm **xử lý request**, gọi model, và trả về response (thường là view hoặc JSON).
-Mỗi Controller thường đại diện cho 1 nhóm chức năng, ví dụ:
`UserController`,  `ProductController`
- Tạo controller bằng lệnh `php artisan make:controller UserController`


---


### - `Middleware` : Lớp bảo về giữa request và controller
- Dùng để kiểm tra hoặc can thiệp vào request trước khi nó đến controller.
- Ví dụ : xác thực người dùng (auth), kiểm tra quyền (isAdmin), giới hạn truy cập IP. . .
- Tạo Middleware bằng lệnh `php artisan make::middleware AuthMiddleware`

### - `Request` : Kiểm tra dữ liệu đầu vào
- Đây là nơi xử lý Form Request Validation - kiểm tra dữ liệu người dùng gửi lên (từ form hoặc API).
- Giúp tách phần kiểm tra ra khỏi Controller => sạch sẽ, dễ bảo trì.
- Ví dụ: `LoginRequest`, `CreateUserRequest`, . . .
- Tạo request bằng lệnh `php artisan make:request LoginRequest`

-----

- `Models` : Nơi đặt các class model, đại diện cho bảng trong CSDL.

- `Providers` : Nơi đăng ký các Service Providers (khởi tạo logic hoặc dịch vụ).

##2. `bootstrap` - khởi động ứng dụng

- Chứa file `app.php` để khởi tạo và bootstrap ứng dụng.
- Thư mục `cache/` : chứa file cache cấu hình giúp tăng tốc độ xử lý.


----


##3. `config` - Cấu hình hệ thống

Chứa tất cả các tệp cấu hình của ứng dụng.

**Ví dụ**

- `app.php` : cấu hình tên app, timezone, locale,. . .
- `database.php` : thông tin kết nối CSDL.
- `mail.php` : cấu hình gửi mail, . . .

**Tip** : Laravel tự động load tất cả các file trong thư mục  `config`.

## 4. ``database/ - Tất cả liên quan tới dữ liệu

- `migrations` : quản lý các thay đổi cấu trúc bảng.
- `seeders` : thêm dữ liệu mẫu cho bảng.
- `factories` : tạo dữ liệu mẫu để test.

**Gợi ý** : Có thể chạy `php artisan migrate -- seed` để tạo bảng và thêm dữ liệu mẫu nhanh chóng.


---


## 5. `public` - Cổng vào của ứng dụng 

Đây là thư mục duy nhất trình duyệt wed truy cập được.

- Chứa `index.php` - file chạy chính của Laravel.
- Chứa tài nguyên tĩnh: ảnh, CSS, JavaScript, . . .

Nếu deploy online, cấu hình web server trỏ vào thư mục `public`.
 

----


## 6. `resources` - Giao diện người dùng & ngôn ngữ

- `views/` : nơi chứa file Blade template (HTML)
- `lang/` : chứa file ngôn ngữ đa ngữ (đa ngôn ngữ).
- `js`, `css/` : nơi bạn viết front-end (Nếu dùng Laravel Mix/Vite).

**Thường dùng nhiều nhất là `views/`** để tạo giao diện.


---


## 7. `routes/` - Định nghĩa các đường dẫn trong ứng dụng (URL)

- `web.php` : route cho giao diện web.
- `api.php` : route cho RESTful API.
- `console.php` : dùng cho Broadcast event qua websocket.

**Khi bạn truy cập 1 đường dẫn** Laravel sẽ kiểm tra route ở đây trước.

---


## 8. `storage` - Lưu trữ tạm & người dùng


- `app` : lưu các file upload từ người dùng.
- `framework` : cache, sessions, views, . . .
- `logs` : ghi log hoạt động ứng dụng.

Thư mục này thường cần phân quyền ghi khi deploy.


## 9. `tests` - Kiểm thử ứng dụng


- `Feature` : kiểm thử tính năng (sát với thực tế)
- `Unit` : kiểm thử đơn vị (logic nhỏ, độc lập).

Laravel sử dụng PHPUnit để test. Bạn có thể viết test để kiểm tra tính ổn định hệ thống.

----


## 10. `vendor` - Thư viện bên thứ ba


Chứa toàn bộ package được cài qua Composer. Bạn không nên chỉnh sửa trực tiếp file trong này.


----


## 11. Các tệp gốc quan trọng

- `.env` : cấu hình môi trường (database, private key, . . .)
- `conposer.json` : khai báo các dependency
- `artisan` : CLI giúp chạy các lệnh Laravel như migrate, route:list, . . .


--- 



## Tổng kết cấu trúc thư mục trong Laravel sẽ giúp bạn:

- Dễ dàng điều hướng và phát triển dự án.
- Giảm thời gian tìm kiếm file.
- Viết mã sạch (clean code), dễ bảo trì.

Hãy dành thời igan **mở từng thư mục, đọc và thực hành** để nhanh chóng làm chủ Laravel nhé!
