<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title><?= $pageTitle ?? 'Транспортная система' ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }

        header {
            margin-bottom: 30px;
        }

        nav a {
            margin-right: 15px;
            text-decoration: none;
            font-weight: bold;
        }

        hr {
            margin: 30px 0;
        }
    </style>
</head>
<body>

<header>
    <h1>Транспортная система</h1>
    <nav>
        <a href="/index.php">Главная</a>
        <a href="/list.php">Просмотр данных</a>
    </nav>
</header>

<hr>
