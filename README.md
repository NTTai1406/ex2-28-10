# xác thực bằng google

1. đăng ký app trên

https://myaccount.google.com/apppasswords

2. mod lại .env

```php
MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_PORT=587
MAIL_USERNAME=namhuynhkhachoai@gmail.com
MAIL_PASSWORD=puxljjhcbxgmdeag
MAIL_ENCRYPTION=tls
MAIL_FROM_ADDRESS="namhuynhkhachoai@gmail.com"
MAIL_FROM_NAME="Google Authentication Application"
```

3. config lại cache

`php artisan config:cache`

4. add trong user model

```php
use MustVerifyEmail
```

5. dùng thư viện sẳn có

```php
php artisan vendor:publish --tag=laravel-mail
```

6. sửa registercontroller

```php
return redirect()->route("verification.notice");
```

# Add realtime chat

1. đăng ký tài khoản ably
2. nhận key
3. thêm cnd vào views/layouts/app.blade.php
4. tạo controller xử lý tạo kênh chat
5. tạo view chat (kết nối tới ably bằng key,xử lý các sự kiện đăng ký, hủy đăng ký channel, nhận tin từ channel...)
