# URL Shortening Service (Link Kısaltma Servisi)

Bu proje, Laravel tabanlı bir link kısaltma servisidir. Docker entegrasyonu (Laravel Sail) sayesinde herhangi bir yerel bağımlılık (PHP, MySQL, Node.js vb.) yüklemeden Docker üzerinden kolayca çalıştırtırılabilir.

---

## Gereksinimler

Projenin çalıştırılacağı bilgisayarda aşağıdaki aracın kurulu olması gerekmektedir:
* [Docker Desktop](https://www.docker.com/products/docker-desktop/) (veya Docker Engine & Compose)

---

## Yeni Bir Bilgisayarda Kurulum ve İlk Çalıştırma

Projeyi başka bir bilgisayara klonladığınızda veya ilk kez çalıştıracağınızda aşağıdaki adımları sırayla uygulayın:

### 1. Ortam Dosyasını Hazırlama
Projenin ana dizininde bir `.env` dosyası oluşturun (örnek şablondan kopyalayarak):
```bash
cp .env.example .env
```

### 2. Docker Kapsayıcılarını Başlatma
Docker Desktop uygulamasının açık olduğundan emin olun ve terminalden (PowerShell, CMD veya Git Bash) konteynerleri arka planda başlatın:
```bash
docker compose up -d
```
*Not: İlk kez çalıştırıldığında imajların indirilmesi ve derlenmesi internet hızınıza bağlı olarak birkaç dakika sürebilir. Sonraki başlatmalarınız 1-2 saniye sürecektir.*

### 3. Bağımlılıkları Yükleme ve Yapılandırma
Konteynerler ayağa kalktıktan sonra, uygulama içindeki PHP bağımlılıklarını kurun ve ayarları tamamlayın:

```bash
# Composer paketlerini yükleme
docker compose exec laravel.test composer install

# Uygulama anahtarını üretme (APP_KEY)
docker compose exec laravel.test php artisan key:generate

# Veritabanı tablolarını oluşturma (Migration)
docker compose exec laravel.test php artisan migrate

# Frontend paketlerini yükleme
docker compose exec laravel.test npm install
```

Kurulum tamamlandığında tarayıcınızdan **[http://localhost](http://localhost)** adresine giderek projeyi kullanmaya başlayabilirsiniz.

---

## Geliştirme Sürecinde Sık Kullanılan Komutlar

Docker ortamında geliştirme yaparken yerel makinenizdeki PHP/npm yerine konteyner içindeki araçları kullanmak için aşağıdaki komutlardan yararlanın:

| İşlem | Komut |
| :--- | :--- |
| **Kapsayıcıları Durdurma** | `docker compose down` |
| **Kapsayıcıları Yeniden Başlatma** | `docker compose up -d` |
| **Geliştirme Sunucusu (Vite)** | `docker compose exec laravel.test npm run dev` |
| **Production Arayüz Derleme** | `docker compose exec laravel.test npm run build` |
| **Artisan Komutları (Örn: Model)** | `docker compose exec laravel.test php artisan make:model Link` |
| **Composer Paket Ekleme** | `docker compose exec laravel.test composer require <paket-adi>` |
| **Veritabanını Sıfırlama** | `docker compose exec laravel.test php artisan migrate:fresh --seed` |
| **Kapsayıcı İçine Bağlanma (Bash)** | `docker compose exec -it laravel.test bash` |
