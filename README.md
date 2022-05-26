<h1>Perpusku Library App</h1>
<h6 class="text-gray">Created by Pangestu-k</h6>

## Detail Aplikasi

Hai teman-teman, <b>Perpusku</b> adalah sebuah aplikasi perpustakaan yang dibangun dengan menggunakan framework Laravel, yang akan mempermudah baik petugas maupun user dalam bertransaksi/ pinjam meminjam buku di perpustakaan, dilengkapi dengan multiple role sederhana dengan petugas dan member, dalam hal ini petugas dapat menambah buku, mengelola member yg meminjam, menkofirmasi peminjaman, memberikan denda, melakukan pembayaran denda, edit profile, dll. Sedangkan user dapat meminjam buku, melihat riwayat buku yang telah dia pinjam serta melihat tanggal pengembalian buku, dan juga update profile, selain itu aplikasi ini juga telah dilengkap dengan berbagai validasi data yang cukup lengkap. Projek ini juga masih bisa di kembangkan kembali sesuai dengan keinginan. Syarat untuk clone projek ini simple, kalian cukup like dan follow akun github saya di https://github.com/pangestu-k , ya follow itu gratis gk si.. (¬‿¬)


<h3>Tata Cara Install 🌱</h3> 

- composer install
- copy file .env.example lalu ubah menjadi .env
- php artisan key:generate
- php artisan storage:link 
- Buat Database di mysql atau postgree (postgree ada konfigurasi sendiri)
- Tulis nama Database di file .env
- php artisan migrate
- php artisan db:seed

<h6 class="text-gray">Email (admin/petugas) : perpus@petugas.com</h6>
<h6 class="text-gray">Password	            : password</h6>

<p>
    Jika ingin menambahkan admin/petugas bisa ditambahkan secara manual
    dengan cara mengganti role user/member menjadi petugas di mysql, atau
    projek ini juga bisa kalian kembangkan sendiri.
</p>

Jika ada pertanyaan bisa langsung tanya di Instagram saya di @rizky.pangestu17 , jangan lupa like and follow ya 😏.


<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
