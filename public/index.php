<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Транспорт</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<h2>Добавить транспорт</h2>

<form action="save.php" method="post">

    <label>
        Тип транспорта:
        <input type="text" name="type" required>
    </label>

    <label>
        Госномер:
        <input type="text" name="plate_number" required>
    </label>

    <label>
        Модель:
        <input type="text" name="model">
    </label>

    <label>
        Год выпуска:
        <input type="number" name="year">
    </label>

    <label>
        Описание:
        <textarea name="description"></textarea>
    </label>

    <button type="submit">Сохранить</button>

</form>

</body>
</html>
