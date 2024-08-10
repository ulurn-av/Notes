# Приложение Notes
REST API сервис для создание своих заметок - Yii2 + Vue.js + MySQL
---

## Используемые технологии

- **Бекенд**: Yii2 (PHP)
- **Фронтенд**: Vue.js
- **База данных**: MySQL

## Бекенд (Yii2)

Бекенд реализован с использованием фреймворка Yii2 и предоставляет RESTful API для управления заметками.

### Зависимости бекенда

Для установки зависимостей для бекенда, перейдите в директорию `backend` и выполните команду:

```bash
composer install
```

### Запуск Бекенда

1. **Настройка окружения**: Настройте подключение к базе данных Notes/backend/config/db.php 
```php
<?php
return [
  'class' => 'yii\db\Connection',
  'dsn' => 'mysql:host=localhost;dbname=db',
  'username' => 'root',
  'password' => 'password',
  'charset' => 'utf8',
];
```

2. **Применение миграций**: Выполните следующую команду для применения миграций базы данных:

   ```bash
   php yii migrate
   ```

3. **Запуск сервера бекенда**: Чтобы запустить сервер бекенда, выполните:

   ```bash
   php yii serve --port=8080
   ```

   Бекенд будет доступен по адресу `http://localhost:8080`.

## Фронтенд (Vue.js)

Фронтенд реализован с использованием Vue.js и предоставляет динамический пользовательский интерфейс для взаимодействия с приложением заметок.

### Зависимости фронтенда

Для установки зависимостей для фронтенда перейдите в директорию `frontend` и выполните команду:

```bash
npm install
```

### Настройка подключения к бекенду
Отредактируйте url бекенд сервера в файле frontend/src/config.js
```js
export const BASE_URL = 'https://www-my-backend.serveo.net';
```

### Запуск Фронтенда

Для запуска сервера разработки фронтенда выполните команду:

```bash
PORT=3000 npm run serve
```

Приложение будет доступно по адресу `http://localhost:3000`.

## Как использовать

1. **Создание заметки**: используйте круглую кнопку для создания новой заметки. Заполните заголовок и содержание, затем сохраните.
2. **Просмотр заметок**: Все сохраненные заметки отображаются на главной странице.
3. **Редактирование заметки**: Откройте заметку и нажмите "Редактировать", чтобы изменить её содержание. Сохраните изменения после редактирования.
4. **Удаление заметки**: Нажмите на крестик рядом с заметкой, чтобы удалить её из базы данных.
