# Deployment SIAKAD UYM ke Railway

## Langkah-langkah Deployment

### 1. **Persiapan Project**
Pastikan project sudah siap untuk deployment:
```bash
# Install dependencies
composer install --no-dev --optimize-autoloader
npm install
npm run build

# Generate app key
php artisan key:generate
```

### 2. **Login ke Railway**
```bash
railway login
```

### 3. **Link Project**
```bash
# Link ke project yang sudah ada
railway link -p 3a35a03d-faea-41e1-8abd-0c7fac24cb4c

# Atau buat project baru
railway init
```

### 4. **Setup Database**
```bash
# Buat MySQL database di Railway
railway add

# Pilih MySQL dari list yang tersedia
```

### 5. **Set Environment Variables**
```bash
# Set environment variables
railway variables set APP_ENV=production
railway variables set APP_DEBUG=false
railway variables set APP_URL=https://your-app-name.railway.app
railway variables set DB_CONNECTION=mysql
railway variables set CACHE_DRIVER=file
railway variables set SESSION_DRIVER=file
railway variables set QUEUE_CONNECTION=sync

# Railway akan otomatis set DATABASE_URL
```

### 6. **Deploy**
```bash
railway up
```

### 7. **Run Migrations & Seed**
```bash
# Setelah deploy, jalankan migrations
railway run php artisan migrate --force

# Optional: Seed database
railway run php artisan db:seed --force
```

## File Konfigurasi

### `railway.json`
```json
{
  "$schema": "https://railway.app/railway.schema.json",
  "build": {
    "builder": "NIXPACKS"
  },
  "deploy": {
    "numReplicas": 1,
    "restartPolicyType": "ON_FAILURE",
    "restartPolicyMaxRetries": 10
  },
  "variables": {
    "APP_ENV": "production",
    "APP_DEBUG": "false",
    "APP_URL": "https://your-app-name.railway.app",
    "DB_CONNECTION": "mysql",
    "CACHE_DRIVER": "file",
    "SESSION_DRIVER": "file",
    "QUEUE_CONNECTION": "sync"
  }
}
```

### `nixpacks.toml`
```toml
[phases.setup]
nixPkgs = ["php", "composer", "nodejs", "npm"]

[phases.install]
cmds = [
  "composer install --no-dev --optimize-autoloader",
  "npm install",
  "npm run build"
]

[phases.build]
cmds = [
  "php artisan key:generate --force",
  "php artisan config:cache",
  "php artisan route:cache",
  "php artisan view:cache"
]

[start]
cmd = "php artisan serve --host=0.0.0.0 --port=$PORT"
```

## Environment Variables yang Diperlukan

### **Wajib:**
- `APP_KEY` - Laravel app key
- `APP_URL` - URL aplikasi
- `DATABASE_URL` - Railway otomatis set

### **Opsional:**
- `APP_ENV=production`
- `APP_DEBUG=false`
- `DB_CONNECTION=mysql`
- `CACHE_DRIVER=file`
- `SESSION_DRIVER=file`
- `QUEUE_CONNECTION=sync`

## Troubleshooting

### **Error: "No application encryption key has been specified"**
```bash
railway run php artisan key:generate --force
```

### **Error: Database connection failed**
- Pastikan MySQL database sudah dibuat di Railway
- Cek `DATABASE_URL` di Railway dashboard
- Pastikan migrations sudah dijalankan

### **Error: "Class not found"**
```bash
railway run composer dump-autoload
```

### **Error: Assets not loading**
```bash
railway run npm run build
```

## Monitoring

### **View Logs**
```bash
railway logs
```

### **Check Status**
```bash
railway status
```

### **Open App**
```bash
railway open
```

## Kredensial Login

Setelah deployment berhasil, gunakan kredensial dari file `CREDENTIALS.md`:

### **Admin**
- Username: `admin`
- Password: `admin123`

### **Dosen**
- Username: NIP (contoh: `198501012010012001`)
- Password: `dosen123`

### **Mahasiswa**
- Username: NIM (contoh: `2021001`)
- Password: `mahasiswa123`

## Update Deployment

Untuk update aplikasi:
```bash
# Commit perubahan
git add .
git commit -m "Update aplikasi"
git push

# Railway akan otomatis deploy
# Atau deploy manual
railway up
``` 