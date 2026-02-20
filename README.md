# Транспортный справочник



Учебный CRUD-проект для управления транспортной системой.
Реализована нормализованная реляционная модель базы данных (до 3NF) и базовые операции: создание, просмотр, редактирование и удаление данных.

---

#  Структура проекта

## Общая структура директорий

```text
app/
├── models/
│   └── TransportCondition.php
│
├── database/
│   └── schema.sql
│
public/
├── css/
│   └── main.css
│
├── edit/
│   ├── edit_driver.php
│   ├── edit_route.php
│   ├── edit_route_stop.php
│   ├── edit_stop.php
│   ├── edit_transport.php
│   └── edit_type.php
│
├── handlers/
│   ├── save/
│   ├── update/
│   └── delete/
│
├── partials/
│   └── header.php
│
├── index.php
├── list.php
│
```

---

#  Описание директорий

## `app/`

Содержит серверную логику и структуру базы данных.

### `models/`

Доменные модели приложения.

* `TransportCondition.php`
  Централизованный список состояний транспорта 

### `database/`

* `schema.sql` — SQL-скрипт для создания базы данных и всех таблиц.

---

## `public/`

Основная рабочая часть приложения (веб-интерфейс).

### `css/`

* `main.css` — стили интерфейса.

---

### `edit/`

Страницы редактирования сущностей.

Каждая страница:

* получает `id` через `GET`
* загружает запись из базы данных
* заполняет форму текущими значениями
* отправляет данные в `handlers/update/`

---

### `handlers/`

Обработчики CRUD-операций.

Структура разделена по типу действия:

* `save/` — создание записей
* `update/` — обновление записей
* `delete/` — удаление записей

Каждый обработчик:

* принимает `POST`-запрос
* валидирует данные
* выполняет SQL через PDO (prepared statements)


---

### `partials/`

Повторно используемые элементы интерфейса.

* `header.php` — общий HTML-шаблон (head, title, подключение CSS и т.д.)

---

### `index.php`

Главная страница приложения.

---

### `list.php`

Страница просмотра данных.

Отображает:

* Типы транспорта
* Водителей
* Маршруты
* Остановки
* Транспорт
* Остановки в маршрутах

Содержит кнопки:

* **Редактировать**
* **Удалить**

---

#  Структура базы данных

База данных: `transport_system`
Кодировка: `utf8mb4`

## Основные таблицы

Ниже — обновлённый фрагмент `README.md`, синхронизированный с твоим текущим `schema.sql`.

---

## Основные таблицы

### `transport_type`

| Поле    | Тип         | Ограничения        | Описание      |
| ------- | ----------- | ------------------ | ------------- |
| type_id | INT         | PK, AUTO_INCREMENT | Идентификатор |
| name    | VARCHAR(50) | NOT NULL, UNIQUE   | Название типа |

---

### `driver`

| Поле      | Тип          | Ограничения        | Описание      |
| --------- | ------------ | ------------------ | ------------- |
| driver_id | INT          | PK, AUTO_INCREMENT | Идентификатор |
| full_name | VARCHAR(100) | NOT NULL           | ФИО водителя  |

---

### `route`

| Поле         | Тип         | Ограничения        | Описание       |
| ------------ | ----------- | ------------------ | -------------- |
| route_id     | INT         | PK, AUTO_INCREMENT | Идентификатор  |
| route_number | VARCHAR(20) | NOT NULL, UNIQUE   | Номер маршрута |

---

### `stop`

| Поле      | Тип          | Ограничения        | Описание           |
| --------- | ------------ | ------------------ | ------------------ |
| stop_id   | INT          | PK, AUTO_INCREMENT | Идентификатор      |
| name      | VARCHAR(100) | NOT NULL           | Название остановки |
| latitude  | DECIMAL(9,6) | NOT NULL           | Широта             |
| longitude | DECIMAL(9,6) | NOT NULL           | Долгота            |

---

### `route_stop`

Связующая таблица (many-to-many) между маршрутами и остановками.

| Поле       | Тип | Ограничения | Описание           |
| ---------- | --- | ----------- | ------------------ |
| route_id   | INT | PK, FK      | Маршрут            |
| stop_id    | INT | PK, FK      | Остановка          |
| stop_order | INT | NOT NULL    | Порядок следования |

**Первичный ключ:**

```text
(route_id, stop_id)
```

**Внешние ключи:**

* `route_id` → `route(route_id)` (ON DELETE CASCADE)
* `stop_id` → `stop(stop_id)` (ON DELETE CASCADE)

---

### `transport`

| Поле         | Тип          | Ограничения        | Описание       |
| ------------ | ------------ | ------------------ | -------------- |
| transport_id | INT          | PK, AUTO_INCREMENT | Идентификатор  |
| plate_number | VARCHAR(20)  | NOT NULL, UNIQUE   | Госномер       |
| model        | VARCHAR(100) | NULL               | Модель         |
| description  | TEXT         | NULL               | Описание       |
| condition    | VARCHAR(50)  | NULL               | Состояние      |
| year         | INT          | NULL               | Год выпуска    |
| type_id      | INT          | NOT NULL, FK       | Тип транспорта |
| route_id     | INT          | NOT NULL, FK       | Маршрут        |
| driver_id    | INT          | NOT NULL, FK       | Водитель       |

**Внешние ключи:**

* `type_id` → `transport_type(type_id)` (ON DELETE CASCADE)
* `route_id` → `route(route_id)` (ON DELETE CASCADE)
* `driver_id` → `driver(driver_id)` (ON DELETE CASCADE)



