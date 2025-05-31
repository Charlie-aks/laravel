# Laravel Web Application

## Giới thiệu
Đây là một ứng dụng web được xây dựng trên nền tảng Laravel Framework - một trong những PHP framework hiện đại và mạnh mẽ nhất hiện nay. Ứng dụng được thiết kế với mục tiêu cung cấp trải nghiệm người dùng tốt nhất và hiệu suất cao.

## Công nghệ sử dụng

### Backend
- **Laravel Framework 12.0**: Framework PHP hiện đại với nhiều tính năng mạnh mẽ
- **PHP 8.2**: Phiên bản PHP mới nhất với nhiều cải tiến về hiệu suất
- **Laravel Socialite**: Hỗ trợ đăng nhập bằng mạng xã hội(Google, Facebook)
- **Laravel Tinker**: Công cụ REPL cho Laravel
- **Laravel Queue**: Xử lý các tác vụ nền
- **Laravel Migration**: Quản lý cơ sở dữ liệu

### Frontend
- **Tailwind CSS**: Framework CSS utility-first
- **Vite**: Build tool hiện đại
- **Axios**: Thư viện HTTP client
- **PostCSS**: Công cụ xử lý CSS

### Công cụ phát triển
- **Laravel Sail**: Môi trường phát triển Docker
- **Laravel Pint**: Công cụ code style
- **PHPUnit**: Framework testing
- **Laravel Pail**: Công cụ quản lý logs

## Tính năng chính
1. **Hệ thống xác thực**
   - Đăng nhập/Đăng ký
   - Đăng nhập qua mạng xã hội
   - Quản lý phiên đăng nhập

2. **Quản lý người dùng**
   - Hồ sơ người dùng
   - Phân quyền và vai trò
   - Quản lý tài khoản

3. **Giao diện người dùng**
   - Thiết kế responsive
   - Tối ưu hóa trải nghiệm người dùng
   - Giao diện hiện đại với Tailwind CSS

4. **Hiệu suất và bảo mật**
   - Xử lý bất đồng bộ với Laravel Queue
   - Bảo mật cao với các tính năng của Laravel
   - Tối ưu hóa hiệu suất

## Cài đặt và Chạy

1. Clone repository
```bash
git clone [repository-url]
```

2. Cài đặt dependencies
```bash
composer install
npm install
```

3. Cấu hình môi trường
```bash
cp .env.example .env
php artisan key:generate
```

4. Chạy migrations
```bash
php artisan migrate
```

5. Khởi động ứng dụng
```bash
npm run dev
php artisan serve
```

## Đóng góp
Mọi đóng góp đều được hoan nghênh. Vui lòng đọc [Hướng dẫn đóng góp](CONTRIBUTING.md) để biết thêm chi tiết.

## Giấy phép
Ứng dụng này được phát hành dưới giấy phép MIT. Xem file [LICENSE](LICENSE) để biết thêm chi tiết.
