# Panduan Deployment SIAKAD UYM

## Konfigurasi Database untuk Production

### 1. **File `.env`**
Buat file `.env` di root project dengan konfigurasi berikut:

```env
APP_NAME="SIAKAD UYM"
APP_ENV=production
APP_KEY=base64:YOUR_APP_KEY_HERE
APP_DEBUG=false
APP_URL=https://your-domain.com

# Database Configuration
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=mahasiswa_uym
DB_USERNAME=your_username
DB_PASSWORD=your_password

# Atau gunakan DATABASE_URL untuk deployment
DATABASE_URL=${{ MySQL.MYSQL_URL }}
```

### 2. **Penggunaan `${{ MySQL.MYSQL_URL }}`**

#### **A. GitHub Actions (CI/CD)**
```yaml
# .github/workflows/deploy.yml
name: Deploy to Production

on:
  push:
    branches: [ main ]

jobs:
  deploy:
    runs-on: ubuntu-latest
    steps:
      - uses: actions/checkout@v2
      
      - name: Setup PHP
        uses: shivammathur/setup-php@v2
        with:
          php-version: '8.1'
          
      - name: Setup MySQL
        uses: mysql/action@v1.0
        with:
          mysql-version: '8.0'
          mysql-root-password: ${{ secrets.MYSQL_ROOT_PASSWORD }}
          
      - name: Deploy to Server
        env:
          MYSQL_URL: ${{ secrets.MYSQL_URL }}
        run: |
          # Set environment variable
          echo "DATABASE_URL=$MYSQL_URL" >> .env
```

#### **B. Heroku**
```bash
# Set environment variable di Heroku
heroku config:set DATABASE_URL=${{ MySQL.MYSQL_URL }}
```

#### **C. Docker Compose**
```yaml
# docker-compose.yml
version: '3.8'
services:
  app:
    build: .
    environment:
      - DATABASE_URL=${MYSQL_URL}
    depends_on:
      - mysql
      
  mysql:
    image: mysql:8.0
    environment:
      MYSQL_ROOT_PASSWORD: ${MYSQL_ROOT_PASSWORD}
      MYSQL_DATABASE: ${MYSQL_DATABASE}
```

#### **D. Laravel Forge / Vapor**
```env
# .env.production
DATABASE_URL=${{ MySQL.MYSQL_URL }}
```

### 3. **Format MySQL URL**
```
mysql://username:password@host:port/database_name
```

**Contoh:**
```
mysql://root:mypassword@localhost:3306/mahasiswa_uym
```

### 4. **Konfigurasi di `config/database.php`**
Laravel sudah mendukung `DATABASE_URL` secara otomatis. Di file `config/database.php`:

```php
'mysql' => [
    'driver' => 'mysql',
    'url' => env('DATABASE_URL'),  // ← Ini yang membaca MySQL URL
    'host' => env('DB_HOST', '127.0.0.1'),
    'port' => env('DB_PORT', '3306'),
    'database' => env('DB_DATABASE', 'forge'),
    'username' => env('DB_USERNAME', 'forge'),
    'password' => env('DB_PASSWORD', ''),
    // ...
],
```

### 5. **Langkah Deployment**

#### **A. Generate App Key**
```bash
php artisan key:generate
```

#### **B. Set Environment Variables**
```bash
# Di server production
export DATABASE_URL="${{ MySQL.MYSQL_URL }}"
```

#### **C. Run Migrations**
```bash
php artisan migrate --force
```

#### **D. Seed Database (Optional)**
```bash
php artisan db:seed --force
```

### 6. **Contoh Penggunaan di Platform**

#### **Railway**
```json
// railway.json
{
  "variables": {
    "DATABASE_URL": "${{ MySQL.MYSQL_URL }}"
  }
}
```

#### **DigitalOcean App Platform**
```yaml
# .do/app.yaml
name: siakad-uym
services:
  - name: web
    environment_slug: php
    envs:
      - key: DATABASE_URL
        value: ${{ MySQL.MYSQL_URL }}
```

#### **Vercel**
```json
// vercel.json
{
  "env": {
    "DATABASE_URL": "${{ MySQL.MYSQL_URL }}"
  }
}
```

### 7. **Keamanan**
- Jangan commit file `.env` ke repository
- Gunakan environment variables di server
- Enkripsi password database
- Gunakan SSL untuk koneksi database

### 8. **Troubleshooting**
- Pastikan format MySQL URL benar
- Cek koneksi database dengan `php artisan tinker`
- Lihat log Laravel di `storage/logs/laravel.log`
- Pastikan database server bisa diakses dari aplikasi 