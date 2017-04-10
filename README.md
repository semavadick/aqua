Корневая директория для веба - web.

Дать права на запись+чтение+исполнение юзеру веб-сервера (например www-data) на следующие папки:
web/assets
web/files
web/images
runtime

В папках web/assets, web/files, web/images отключить исполнение скриптов.

Также для ЧПУ нужно настроить внутренний редирект на web/index.php всех файлов и папок, которые физически не существуют в папке web.
Грубый пример настройки редиректа для nginx:
location / {
    try_files   $uri    $uri/   /index.php?$args;
}

Выполнять миграции командой:
./yii migrate/up