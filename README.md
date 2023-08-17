1.	Tải Xampp bản 7.2.34 <Link tải: https://sourceforge.net/projects/xampp/files/XAMPP%20Windows/7.2.34/xampp-windows-x64-7.2.34-2-VC15-installer.exe/download>
Tải sẵn PHP về máy (version 7)

2.	Tải Folder Source code về và cho vào folder “htdocs” trong xampp (folder xampp được tạo khi ta tải Xampp về )

3.	Khởi chạy Apache và MySQL trên Xampp
 ![image](https://github.com/huychac03/web_olms/assets/99818828/993d5443-c184-42f3-9d8a-36c838bd2a82)


4.	Ấn vào Admin cảu MySQL để chuyển hướng tới trang myAdmin 

5.	Tạo 1 Database mới với tên “db_olms” và loại như trong hình:
 ![image](https://github.com/huychac03/web_olms/assets/99818828/86925086-b4be-4ab6-8663-0e99fe689063)


6.	Sau khi tạo Database, ta Import dữ liệu:
 
![image](https://github.com/huychac03/web_olms/assets/99818828/f6544734-b15b-4694-b9be-26d36ee7d683)

Chọn Import và “Choose file”, tải lên file db_olms trong source vừa rồi.

7.	Mở file source code bằng VSCode, mở Terminal lên và chạy lệnh:
php artisan config:cache
8.	Truy cập và sử dụng:
-	Người dùng: http://localhost/olms/public/user/login
Tài khoản demo: 
	Email: user1@gmail.com
	Pass: 123456

-	Admin: http://localhost/olms/public/admin/login
Tài khoản demo: 
	Email: admin1@gmail.com
	Pass: 123456


