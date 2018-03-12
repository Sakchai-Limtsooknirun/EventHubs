## Member
| Name | Student ID  | Role
|--|--|--|
| นราธิป สุวรรณวณิช | 5810450300 | ออกแบบ Database , CSS , SQL Schema , Bugs Fix
| ศุภวิชญ์ ชาญพิทยานุกูลกิจ | 5810450440 | ระบบ Webboard , QR Code Checkin , Attendants Dashboard , .htaccess 
| ศักย์ชัย ลิ้มสุขนิรันดร์ | 5810451063 | ระบบ Login&Register , Logs,Admins Dashboard , Profile , Permission , Bugs Fix
| อนพัทย์ อินทร์สุวรรณ | 5810451152 | ระบบ Event Organizers Dashboard , E-Mail Sending , PDF Export , QR Code

## Directory

    ├── PHPMailer_v5.0.2        	# Library สำหรับส่ง E-mail
    ├── css                    		# สำหรับเก็บไฟล์ css
    ├── js                     		# สำหรับเก็บไฟล์ JavaScript
    ├── event				# ระบบของ Event ทั้งหมด ไม่ว่าจะเป็นการ ดู แก้ ลบ สมัคร
    ├── img                   		# เก็บไฟล์รูปทั้งหมดบนเว็บ แล้วเก็บ path ไว้ที่ Database แทน
    ├── logs				# เก็บไฟล์ System logs ของระบบแยกตามวันเดือนปี (.txt)
    ├── phpqrcode			# Library สำหรับใช้งาน QR Code
    ├── survey				# ระบบของการทำแบบสำรวจความพึงพอใจทั้งหมด
    ├── .htaccess			# นำมาใช้ในการ Rewrite URL เพื่อความปลอดภัย
	└── ...
		
## Installation

 1. Upload ไฟล์ทั้งหมดขึ้นบน Server และสร้างฐานข้อมูลใหม่พร้อมทั้ง Import ฐานข้อมูลเข้า
 2. แก้ไขไฟล์ connection.php เพื่อเชื่อมต่อกับฐานข้อมูล
 3. โปรดตรวจสอบว่ามีไฟล์ .htaccess หากไม่มีให้ทำการสร้างใหม่ หรือเปลี่ยนชื่อไฟล์ จุดhtaccess เป็น .htaccess
 4. พร้อมใช้งาน

## ScreenShot
![หน้าแรก](https://uppic.cc/d/91m)
----
![หน้าแสดงรายละเอียดกิจกรรม](https://uppic.cc/d/91n)
----

> Project นี้เป็นส่วนหนึ่งของวิชา 01418443 สมาชิกในกลุ่มทุกคนต่างได้เรียนรู้และรู้จักการทำงานร่วมกัน และรู้จักการแบ่งงาน การทำงานเป็นทีม ความรับผิดชอบ และการเสนอความคิดเห็น

