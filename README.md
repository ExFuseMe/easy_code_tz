# Тесто проект компании EasyCode

## Установка проекта
```bash
cp .env.example .env
composer i
vendor/bin/sail artisan key:generate
vendor/bin/sail up -d
vendor/bin/sail migrate --seed
vendor/bin/sail l5-swagger:generate
```
## Запуск очередей для проверки exception_at у запроса
```bash
vendor/bin/sail artisan queue:work
```
## Проверка запросов
Весь код задокументирован при помощи библиотеки L5-swagger и сваггер кода
Алгоритм:
1. Переходим на страницу: http://localhost/api/documentation
2. Во вкладке Auth авторизуемся(креды соответствуют DatabaseSeeder)
3. Выданный токен вставляем в инпут поле, которое появляется при нажатии кнопки Authorize
4. Во вкладке Settings все запросы
