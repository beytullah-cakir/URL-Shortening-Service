# URL Shortening Service

> 🇬🇧 [English](#english) | 🇹🇷 [Türkçe](#türkçe)

---

<a name="english"></a>
# 🇬🇧 English

A RESTful API-based URL shortening service built with **Laravel 12** and **Laravel Sail** (Docker). Users can register, authenticate, and manage their shortened URLs. Each redirect is automatically logged with IP address, user agent, and referer information.

---

## Tech Stack

| Layer | Technology |
|---|---|
| Backend Framework | Laravel 12 (PHP 8.2+) |
| Authentication | Laravel Sanctum (token-based) |
| Database | MySQL 8.4 |
| Cache / Queue | Redis |
| Containerization | Docker / Laravel Sail |
| Testing | PestPHP |

---

## Architecture

```
routes/
  web.php        → Public redirect route (/{short_code})
  api.php        → Authenticated API routes (/api/...)

app/
  Http/Controllers/Api/
    AuthController.php         → Register, Login, Logout, Me
    UrlController.php          → CRUD operations for URLs
    UrlRedirectController.php  → Short code redirect + click logging
  Models/
    User.php       → User model (Sanctum auth)
    Url.php        → URL model (short_code, is_active, click_count)
    ClickLog.php   → Click log model (ip, user_agent, referer, visited_at)
  Policies/
    UrlPolicy.php  → Authorization: only owner can view/update/delete
  Services/
    UrlShortenerService.php  → Base62 encoding algorithm for short codes
```

**Database Tables:**
- `users` — Registered users
- `urls` — Shortened URLs with short codes
- `click_logs` — Click tracking per redirect
- `personal_access_tokens` — Sanctum API tokens

---

## API Endpoints

All API routes are prefixed with `/api`. Authenticated routes require the header:
```
Authorization: Bearer {token}
```

### Auth

| Method | Endpoint | Auth | Description |
|---|---|---|---|
| `POST` | `/api/register` | ❌ | Register a new user |
| `POST` | `/api/login` | ❌ | Login and receive token |
| `POST` | `/api/logout` | ✅ | Logout (revoke current token) |
| `GET` | `/api/me` | ✅ | Get authenticated user info |

#### Register `POST /api/register`
```json
// Request Body
{
  "name": "John Doe",
  "email": "john@example.com",
  "password": "password123",
  "password_confirmation": "password123"
}

// Response 200
{
  "user": { "id": 1, "name": "John Doe", "email": "john@example.com" },
  "token": "1|abc123...",
  "message": "Register successfully"
}
```

#### Login `POST /api/login`
```json
// Request Body
{
  "email": "john@example.com",
  "password": "password123"
}

// Response 200
{
  "user": { "id": 1, "name": "John Doe", "email": "john@example.com" },
  "token": "2|xyz789...",
  "message": "Login successfully"
}
```

---

### URL Management (Requires Auth)

| Method | Endpoint | Description |
|---|---|---|
| `POST` | `/api/urls` | Create a new short URL |
| `GET` | `/api/urls` | List all URLs belonging to the user |
| `GET` | `/api/urls/{id}` | Get details of a specific URL |
| `POST` | `/api/urls/{id}` | Update a URL |
| `DELETE` | `/api/urls/{id}` | Delete a URL |

#### Create Short URL `POST /api/urls`
```json
// Request Body
{
  "original_url": "https://www.example.com/very/long/path"
}

// Response 200
{
  "message": "Url saved successfully",
  "original_url": "https://www.example.com/very/long/path",
  "short_code": "000001"
}
```

#### Update URL `POST /api/urls/{id}`
```json
// Request Body
{
  "original_url": "https://www.updated-example.com",
  "is_active": 1
}
```

---

### Redirect (Public)

| Method | Endpoint | Description |
|---|---|---|
| `GET` | `/{short_code}` | Redirect to the original URL |

Accessing `http://localhost/000001` will:
1. Look up the short code in the database (must be `is_active = 1`)
2. Log the click (IP, User Agent, Referer, timestamp)
3. Increment the `click_count` on the URL
4. Redirect (`302`) to the original URL

---

## Requirements

The only tool you need installed locally is:
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)

---

## Installation & Setup (First Time)

### Step 1 — Clone the repository
```bash
git clone https://github.com/your-username/URL-Shortening-Service.git
cd URL-Shortening-Service
```

### Step 2 — Create the environment file
```bash
cp .env.example .env
```

> **Important:** If you already have another Docker container using port `6379` (Redis default), add the following line to your `.env` to avoid a port conflict:
> ```
> FORWARD_REDIS_PORT=6380
> ```

### Step 3 — Start Docker containers
Make sure Docker Desktop is running, then:
```bash
docker compose up -d
```
> The first run will download and build images. This may take a few minutes depending on your internet speed. Subsequent startups will be almost instant.

### Step 4 — Install PHP dependencies
```bash
docker compose exec laravel.test composer install
```

### Step 5 — Generate the application key
```bash
docker compose exec laravel.test php artisan key:generate
```

### Step 6 — Run database migrations
```bash
docker compose exec laravel.test php artisan migrate
```

The application is now running at **[http://localhost](http://localhost)**.

---

## Common Commands (During Development)

| Action | Command |
|---|---|
| Stop containers | `docker compose down` |
| Restart containers | `docker compose up -d` |
| Run tests | `docker compose exec laravel.test php artisan test` |
| Artisan commands | `docker compose exec laravel.test php artisan <command>` |
| Composer packages | `docker compose exec laravel.test composer require <package>` |
| Reset database | `docker compose exec laravel.test php artisan migrate:fresh --seed` |
| Open container shell | `docker compose exec -it laravel.test bash` |

---

<a name="türkçe"></a>
# 🇹🇷 Türkçe

**Laravel 12** ve **Laravel Sail** (Docker) ile geliştirilmiş REST API tabanlı bir URL kısaltma servisi. Kullanıcılar kayıt olabilir, giriş yapabilir ve kısaltılmış URL'lerini yönetebilir. Her yönlendirme işlemi otomatik olarak IP adresi, kullanıcı tarayıcısı ve referer bilgileriyle loglanır.

---

## Teknoloji Yığını

| Katman | Teknoloji |
|---|---|
| Backend Framework | Laravel 12 (PHP 8.2+) |
| Kimlik Doğrulama | Laravel Sanctum (token tabanlı) |
| Veritabanı | MySQL 8.4 |
| Önbellek / Kuyruk | Redis |
| Konteynerizasyon | Docker / Laravel Sail |
| Test | PestPHP |

---

## Mimari

```
routes/
  web.php        → Herkese açık yönlendirme rotası (/{short_code})
  api.php        → Kimlik doğrulama gerektiren API rotaları (/api/...)

app/
  Http/Controllers/Api/
    AuthController.php         → Kayıt, Giriş, Çıkış, Me (Ben)
    UrlController.php          → URL CRUD işlemleri
    UrlRedirectController.php  → Kısa kod yönlendirme + tıklama loglama
  Models/
    User.php       → Kullanıcı modeli (Sanctum auth)
    Url.php        → URL modeli (short_code, is_active, click_count)
    ClickLog.php   → Tıklama log modeli (ip, user_agent, referer, visited_at)
  Policies/
    UrlPolicy.php  → Yetkilendirme: sadece sahibi görüntüleyebilir/güncelleyebilir/silebilir
  Services/
    UrlShortenerService.php  → Kısa kod üretimi için Base62 kodlama algoritması
```

**Veritabanı Tabloları:**
- `users` — Kayıtlı kullanıcılar
- `urls` — Kısa kodlarla birlikte kısaltılmış URL''ler
- `click_logs` — Her yönlendirme için tıklama takibi
- `personal_access_tokens` — Sanctum API token''ları

---

## API Endpoint''leri

Tüm API rotaları `/api` öneki ile başlar. Kimlik doğrulama gerektiren rotalar için şu başlık gereklidir:
```
Authorization: Bearer {token}
```

### Kimlik Doğrulama

| Metot | Endpoint | Auth | Açıklama |
|---|---|---|---|
| `POST` | `/api/register` | ❌ | Yeni kullanıcı kaydı |
| `POST` | `/api/login` | ❌ | Giriş yap ve token al |
| `POST` | `/api/logout` | ✅ | Çıkış yap (token iptal edilir) |
| `GET` | `/api/me` | ✅ | Giriş yapan kullanıcı bilgileri |

#### Kayıt `POST /api/register`
```json
// İstek Gövdesi
{
  "name": "Ahmet Yılmaz",
  "email": "ahmet@example.com",
  "password": "sifre1234",
  "password_confirmation": "sifre1234"
}

// Yanıt 200
{
  "user": { "id": 1, "name": "Ahmet Yılmaz", "email": "ahmet@example.com" },
  "token": "1|abc123...",
  "message": "Register successfully"
}
```

#### Giriş `POST /api/login`
```json
// İstek Gövdesi
{
  "email": "ahmet@example.com",
  "password": "sifre1234"
}

// Yanıt 200
{
  "user": { "id": 1, "name": "Ahmet Yılmaz", "email": "ahmet@example.com" },
  "token": "2|xyz789...",
  "message": "Login successfully"
}
```

---

### URL Yönetimi (Kimlik Doğrulama Gerekli)

| Metot | Endpoint | Açıklama |
|---|---|---|
| `POST` | `/api/urls` | Yeni kısa URL oluştur |
| `GET` | `/api/urls` | Kullanıcıya ait tüm URL''leri listele |
| `GET` | `/api/urls/{id}` | Belirli bir URL''nin detaylarını getir |
| `POST` | `/api/urls/{id}` | URL''yi güncelle |
| `DELETE` | `/api/urls/{id}` | URL''yi sil |

#### Kısa URL Oluştur `POST /api/urls`
```json
// İstek Gövdesi
{
  "original_url": "https://www.uzun-url-ornegi.com/cok/uzun/bir/yol"
}

// Yanıt 200
{
  "message": "Url saved successfully",
  "original_url": "https://www.uzun-url-ornegi.com/cok/uzun/bir/yol",
  "short_code": "000001"
}
```

#### URL Güncelle `POST /api/urls/{id}`
```json
// İstek Gövdesi
{
  "original_url": "https://www.yeni-url.com",
  "is_active": 1
}
```

---

### Yönlendirme (Herkese Açık)

| Metot | Endpoint | Açıklama |
|---|---|---|
| `GET` | `/{short_code}` | Orijinal URL''ye yönlendir |

`http://localhost/000001` adresine gidildiğinde:
1. Kısa kod veritabanında aranır (`is_active = 1` olmalı)
2. Tıklama loglanır (IP, User Agent, Referer, zaman)
3. URL''nin `click_count` değeri 1 artırılır
4. Orijinal URL''ye `302` yönlendirmesi yapılır

---

## Gereksinimler

Yerel makinenizde kurulu olması gereken tek araç:
- [Docker Desktop](https://www.docker.com/products/docker-desktop/)

---

## Kurulum ve İlk Çalıştırma

### 1. Adım — Projeyi klonlayın
```bash
git clone https://github.com/your-username/URL-Shortening-Service.git
cd URL-Shortening-Service
```

### 2. Adım — Ortam dosyasını oluşturun
```bash
cp .env.example .env
```

> **Önemli:** Bilgisayarınızda halihazırda `6379` portunu kullanan başka bir Docker konteyneri (Redis) varsa port çakışmasını önlemek için `.env` dosyanıza şu satırı ekleyin:
> ```
> FORWARD_REDIS_PORT=6380
> ```

### 3. Adım — Docker konteynerlerini başlatın
Docker Desktop''ın açık olduğundan emin olun, ardından:
```bash
docker compose up -d
```
> İlk çalıştırmada imajların indirilmesi ve derlenmesi internet hızınıza bağlı olarak birkaç dakika sürebilir. Sonraki başlatmalar neredeyse anlık olacaktır.

### 4. Adım — PHP bağımlılıklarını yükleyin
```bash
docker compose exec laravel.test composer install
```

### 5. Adım — Uygulama anahtarını üretin
```bash
docker compose exec laravel.test php artisan key:generate
```

### 6. Adım — Veritabanı tablolarını oluşturun
```bash
docker compose exec laravel.test php artisan migrate
```

Kurulum tamamlandı! Uygulama **[http://localhost](http://localhost)** adresinde çalışıyor.

---

## Geliştirme Sürecinde Sık Kullanılan Komutlar

| İşlem | Komut |
|---|---|
| Konteynerleri durdur | `docker compose down` |
| Konteynerleri yeniden başlat | `docker compose up -d` |
| Testleri çalıştır | `docker compose exec laravel.test php artisan test` |
| Artisan komutu çalıştır | `docker compose exec laravel.test php artisan <komut>` |
| Composer paketi ekle | `docker compose exec laravel.test composer require <paket>` |
| Veritabanını sıfırla | `docker compose exec laravel.test php artisan migrate:fresh --seed` |
| Konteyner içine bağlan | `docker compose exec -it laravel.test bash` |
