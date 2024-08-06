## Настройка окружения

Переименовать .env.example в .env

## Выполнить миграции

Зайти в контейтнер приложения:
docker exec -it project_app bash

Запустить миграции:
php artisan migrate --seed

## Запуск

docker-compose up -d
