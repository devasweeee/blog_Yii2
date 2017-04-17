Блог на Yii Framework 2

Для того, что бы развернуть блог необходимо:

1. Склонировать репозиторий.

2. Запустить composer в консоли:

composer global require "fxp/composer-asset-plugin:~1.1.2"


3. Выполнить установку composer install или обновление зависимостей composer update.


4. Настроить подключение к БД в конфиге:

/config/db.php



5. Запустить миграции:

php yii migrate



Пользователь по-умолчанию:

Логин: demoadmin

Пароль: demoadmin
