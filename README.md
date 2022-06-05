## K-telecom (тестовое задание)

### ПО
- git
- php 8+
- mysql

### Установка

1. Склонируйте репозиторий
2. Установите Composer зависимости – `composer install`

### Конфигурация
1. Скопируйте "example" конфиг – `cp .env.example`
2. Установите нужные значения в параметры
   - `DB_DATABASE`
   - `DB_USERNAME`
   - `DB_PASSWORD`
   - `APP_URL`

### Миграции и тестовые данные
Для миграции схемы базы и генерации тестовых данных выполните команду – `php artisan migrate --seed`

### Запуск
Для запуска можно использовать OpenServer, Xampp, Laravel Valet или встроенный веб-сервер (`php artisan serve`)
