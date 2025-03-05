# Deptech - Laravel Project

Ini adalah proyek Laravel yang dikembangkan untuk **[deskripsi proyek Anda]**. Berikut adalah langkah-langkah untuk meng-clone dan menjalankan proyek ini secara lokal.

## 🛠 Persyaratan Minimum

Sebelum memulai, pastikan Anda memiliki:
- **PHP** (\u2265 8.1)
- **Composer** (\u2265 2.0)
- **Node.js & NPM** (opsional untuk frontend)
- **Git**
- **MySQL** / Database lain sesuai konfigurasi

---

## 📥 1. Clone Repository

Gunakan perintah berikut untuk meng-clone proyek:

```sh
git clone https://github.com/Sarwidad/deptech.git
cd deptech
```

---

## 🔧 2. Install Dependencies

Jalankan perintah berikut untuk menginstall semua dependency Laravel:

```sh
composer install
```

Jika menggunakan frontend (Vite), jalankan juga:

```sh
npm install
```

---

## 🔑 3. Konfigurasi Environment

Salin file **.env.example** menjadi **.env** dan konfigurasi sesuai kebutuhan:

```sh
cp .env.example .env
```

Lalu, **generate application key**:

```sh
php artisan key:generate
```

---

## 🛢 4. Setup Database

1. Buat database di MySQL (atau database lain yang digunakan).
2. Edit file **.env**, sesuaikan bagian:

   ```env
   DB_CONNECTION=mysql
   DB_HOST=127.0.0.1
   DB_PORT=3306
   DB_DATABASE=nama_database
   DB_USERNAME=root
   DB_PASSWORD=
   ```

3. Jalankan migrasi dan seeder (jika ada):

   ```sh
   php artisan migrate --seed
   ```

---

## 🚀 5. Menjalankan Laravel

Jalankan server Laravel dengan perintah:

```sh
php artisan serve
```

Proyek akan berjalan di:  
👉 **http://127.0.0.1:8000**

Jika menggunakan frontend Vite, jalankan juga:

```sh
npm run dev
```

---

## ✅ 6. Menjalankan Queue (Jika Diperlukan)

Jika proyek menggunakan queue, jalankan:

```sh
php artisan queue:work
```

---

## 🛠 Perintah Tambahan

- **Menjalankan storage link:**  
  ```sh
  php artisan storage:link
  ```
- **Menjalankan cache clear:**  
  ```sh
  php artisan config:clear && php artisan cache:clear
  ```

---

## 📌 Kontributor

- **[Nama Anda]** - [Deskripsi singkat]

Jika ada pertanyaan atau kendala, silakan buat **issue** atau hubungi saya. 🚀

