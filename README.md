# VA Telkom BE

**Deskripsi Singkat**:  
Proyek ini adalah implementasi back-end untuk Virtual Assistant Telkom Indonesia yang memungkinkan pengguna berinteraksi dengan bot atau asisten virtual melalui antarmuka chat. Back-end akan memberikan response menggunakan pendekatan REST API dengan struktur response seperti berikut:

Detail dokumentasi API ada pada Postman Doc [di sini](https://documenter.getpostman.com/view/36842696/2sA3s6GA15)
1. **Success Response Example**:
    ```json
    {
	    "is_success": true,
	    "message": "Success reply user question.",
	    "data": {
            "id": 105,
            "chat_session_id": 2,
            "created_at": "2024-08-14 19:57:26",
            "chat": {
                "fullname": "Telkom Indonesia",
                "message": "Telkom Indonesia didirikan pada tanggal 6 Juli 1965. Awalnya, perusahaan ini beroperasi sebagai bagian dari Direktorat Pos dan Telekomunikasi Indonesia dan kemudian menjadi entitas terpisah dengan fokus pada layanan telekomunikasi. "
            }
        }
    }
    ```
2. **Failed/Error Response**:
    ```json
    {
        "is_success": false,
        "message": "Chat session not found.",
        "errors": []
    }
    ```

## Features

Detail dokumentasi API ada pada Postman Doc [di sini](https://documenter.getpostman.com/view/36842696/2sA3s6GA15)

- **FAQ:**
  - `GET /faqs`: Mendapatkan list questions yang sudah didefinisikasn sebelumnya di database.
- **Chat Session:**
  - `GET /chats`: Mendapatkan list chat session yang tersedia.
  - `POST /chats`: Membuat chat session baru.
- **Chat**:
  - `GET /chats/{chatSessionID}`: Mendapatkan seluruh isi chat/pesan yang ada pada chat session tersebut.
  - `POST /chats/{chatSessionID}`: Mengirimkan pesan ke chat session tersebut.

## Project Structure

Laravel umumnya menggunakan architectural pattern [MVC (Model View Controller)](https://developer.mozilla.org/en-US/docs/Glossary/MVC)

`<---`: folder yang sering digunakan
```plaintext
va-telkom-be/
├── app/
│   ├── Helpers/                        <---
│   │   └── ApiResponseHelper.php
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── Api/                    <---
│   │   ├── Requests/                   <---
│   │   └── Resources/                  <---
│   ├── Models/                         <---
│   ├── Providers/
│   └── Services/                       <---
├── boostrap/
├── config/
├── database/
│   ├── factories/
│   ├── migration/                      <---
│   └── seeders/                        <---
├── public/
├── resources/
├── routes/
│   ├── api.php                         <---
│   └── ...
├── storage/
├── vendor/
├── .editorconfig
├── .env                                <---
└── ...
```

## Teknologi yang Digunakan

- [**Laravel**](https://laravel.com/): Framework PHP untuk pengembangan web dengan arsitektur MVC.
- [**MySQL**](https://www.mysql.com/): Basis data relasional yang digunakan untuk menyimpan data aplikasi.
- [**Composer**](https://getcomposer.org/): Manajer dependensi untuk PHP, digunakan untuk mengelola paket-paket Laravel dan pustaka lainnya.
- [**PHP**](https://www.php.net/): Bahasa pemrograman utama yang digunakan dalam pengembangan proyek ini.
- [**Nginx/Apache**](https://nginx.org/en/): Server web yang digunakan untuk menyajikan aplikasi.


## Instalasi

1. **Clone Repository**:

    ```bash
    git clone https://github.com/uqisya/va-telkom-be.git
    cd va-telkom-be
    code .
    ```

2. **Install dependensi**:

    Open Terminal
    ```bash
    composer install
    ```

3. **Konfigurasi Environment**:

    ```bash
    cp .env.example .env
    ```

4. **Konfigurasi Database**:

    Pada bagian ini di `.env`, atur DB_CONNECTION, DB_HOST, DB_PORT, DB_DATABASE, DB_USERNAME, DB_PASSWORD.
    Default:
   ```plaintext
    DB_CONNECTION=mysql
    DB_HOST=127.0.0.1
    DB_PORT=3306
    DB_DATABASE=va_telkom
    DB_USERNAME=root
    DB_PASSWORD=
   ```

5. **Generate Application Key**:

    ```bash
    php artisan key:generate
    ```

6. **Migrasi dan Seed Database**:

    ```bash
    php artisan migrate --seed
    ```

7. **Jalankan Aplikasi**:

    ```bash
    php artisan serve
    ```

    `INFO  Server running on [http://127.0.0.1:8000]`
   
   Anda bisa menggunakan `http://localhost:8000/api` atau `http://127.0.0.1:8000/api` sebagai BASE_URL untuk keperluan hit API ke project ini

5. **Instruksi Penggunaan Hit API**:

   Anda bisa menggunakan tools seperti [Postman](https://www.postman.com/)
   
   Jika ingin mencoba dalam bentuk user interface yang sudah jadi, bisa lihat project va-telkom-fe di bawah.
   
   Lihat instruksi project frontend ReactJs [di sini](https://github.com/uqisya/va-telkom-fe) va-telkom-fe.
