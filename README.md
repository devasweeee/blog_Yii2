Блог на Yii Framework 2

Для того, что бы развернуть блог необходимо:

Склонировать репозиторий.

После запустить composer в консоли:

composer global require "fxp/composer-asset-plugin:~1.1.2"


Выполнить установку composer install или обновление зависимостей composer update.


Настроить подключение к БД в конфиге:

/config/db.php



Запустить миграции:

php yii migrate



Пользователь по-умолчанию:

Логин: demoadmin

Пароль: demoadmin
