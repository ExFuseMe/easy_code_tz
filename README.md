# Тесто проект компании EasyCode

## Установка проекта
```bash
cp .env.example .env
composer i
vendor/bin/sail artisan key:generate
vendor/bin/sail up -d
vendor/bin/sail migrate --seed
```
