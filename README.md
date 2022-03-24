1. Авторизация
    - [x] регистрация
    - [x] авторизация
    - [x] восстановление пароля
2. Книга контактов
    - [x] создавать, редактировать контакты (ФИО, номер телефона);
    - [x] просматривать список собственных контактов;
    - [x] просматривать контакт на отдельной странице;
    - [x] отмечать контакты как избранные;
    - [x] удалять контакты;

**Порядок установки**

```
    cp .env.example .env
    composer install
    ./vendor/bin/sail up
    ./vendor/bin/sail php artisan key:generate && ./vendor/bin/sail php artisan key:generate --env=testing
    ./vendor/bin/sail php artisan migrate && ./vendor/bin/sail php artisan migrate --env=testing
    ./vendor/bin/sail php artisan db:seed && ./vendor/bin/sail php artisan db:seed --env=testing
    ./vendor/bin/sail l5-swagger:generate
```
