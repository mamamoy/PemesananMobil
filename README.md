PHP versi 8.0
Framework: Laravel 9.^
Database : MySql

user role admin:
email: admin@gmail.com
pass : admin123

user role approval
email: approval@gmail.com
pass : approval123

cara penggunaan
buka terminal
atur agar mengarak lokasi file
"composer install" / "update"
atur .env pada bagian database untuk mengatur nama tabelnya dan koneksinya
"php artisan key:generate"
migrasi dan seed penuh dengan kode "php artisan migrate:fresh --seed"
jalankan: "php artisan serve"