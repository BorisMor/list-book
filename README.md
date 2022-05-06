# Список книг

### Собрать докер
```shell
make build # собрать образ
make composer-install # установить зависимости composer
make migrate-up # установить миграции
make start # запустить
```
Работает на `http://localhost:8080/`

### Разбито на сервисы:
- `services/author` - работа с авторами
- `services/book` - работа с книгами
- `services/report` - отчеты
- `services/subscription` - подписки
