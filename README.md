
# Tugas Rutin 7 - Sistem Login & Register PHP Native

Aplikasi web sederhana untuk sistem autentikasi (Login, Register, Dashboard, dan Logout) menggunakan PHP Native. Proyek ini tidak memerlukan database SQL karena penyimpanan data akun pengguna menggunakan file berformat JSON (users.json)[cite: 21, 36].

---

## Struktur File Project

Berikut adalah daftar file yang terdapat di dalam folder Tugas_Rutin_7:

- register.php — Halaman dan proses pendaftaran akun baru[cite: 37].
- login.php — Halaman dan proses autentikasi masuk akun[cite: 34].
- dashboard.php — Halaman utama yang diproteksi session (hanya bisa diakses setelah login)[cite: 18, 25, 33].
- logout.php — File untuk menghapus sesi dan keluar akun[cite: 18, 25, 35].
- users.json — File penyimpanan data teks berbentuk JSON untuk menampung data user[cite: 21, 38].
- README.md — Dokumentasi penjelasan proyek[cite: 36].

---

## Cara Menjalankan Proyek (Menggunakan Laragon)

Ikuti langkah-langkah di bawah ini untuk menjalankan proyek di komputer lokalmu menggunakan Laragon:

1. Pindahkan Folder Project:

   - Pastikan folder project kamu bernama Tugas_Rutin_7[cite: 36].
   - Salin (Copy) folder tersebut dan letakkan ke direktori server Laragon di: C:\laragon\www\[cite: 36].
2. Nyalakan Laragon:

   - Buka aplikasi Laragon di komputermu[cite: 36].
   - Klik tombol Start All di bagian tengah bawah hingga layanan Apache menyala aktif[cite: 36].
3. Buka di Browser:

   - Buka browser internet (Google Chrome / Microsoft Edge).
   - Ketik alamat berikut pada address bar lalu tekan Enter: http://localhost/Tugas_Rutin_7/login.php[cite: 36]
   - (Atau gunakan otomatis domain lokal Laragon: http://tugas-rutin-7.test/login.php)

---

## Cara Penggunaan Aplikasi

1. Saat pertama kali dibuka, halaman akan mengarah ke form Login[cite: 34, 36].
2. Jika belum punya akun, klik tautan Daftar untuk beralih ke halaman register.php[cite: 37].
3. Masukkan data diri, lalu klik tombol Daftar. Data akun akan otomatis tersimpan ke dalam file users.json[cite: 23, 26, 37, 38].
4. Masukkan kembali email dan password yang telah didaftarkan pada halaman Login[cite: 34].
5. Setelah berhasil, kamu akan masuk ke halaman Dashboard[cite: 33].
6. Klik tombol Logout di pojok kanan atas jika ingin keluar dari sesi akun[cite: 25, 33, 35].
