<?php

// 1. Интерфейсы и базовые компоненты
require_once __DIR__ . '/../vendor/mustache/Exception.php';
require_once __DIR__ . '/../vendor/mustache/Loader.php';
require_once __DIR__ . '/../vendor/mustache/Cache.php';
require_once __DIR__ . '/../vendor/mustache/Logger.php';

// 2. Исключения и вспомогательные классы
require_once __DIR__ . '/../vendor/mustache/Exception/InvalidArgumentException.php';
require_once __DIR__ . '/../vendor/mustache/Exception/UnknownTemplateException.php';
require_once __DIR__ . '/../vendor/mustache/Exception/RuntimeException.php';
require_once __DIR__ . '/../vendor/mustache/Cache/AbstractCache.php';
require_once __DIR__ . '/../vendor/mustache/Cache/NoopCache.php';
require_once __DIR__ . '/../vendor/mustache/Loader/FilesystemLoader.php';

// 3. Ядро
require_once __DIR__ . '/../vendor/mustache/Engine.php';
require_once __DIR__ . '/../vendor/mustache/Template.php';
require_once __DIR__ . '/../vendor/mustache/Context.php';
require_once __DIR__ . '/../vendor/mustache/LambdaHelper.php'; // ВОТ ОН, ДОБАВЬ ЭТУ СТРОКУ!
require_once __DIR__ . '/../vendor/mustache/Parser.php';
require_once __DIR__ . '/../vendor/mustache/Tokenizer.php';
require_once __DIR__ . '/../vendor/mustache/Compiler.php';
require_once __DIR__ . '/../vendor/mustache/Source.php';
require_once __DIR__ . '/../vendor/mustache/HelperCollection.php';

class Render {
    private $mustache;

    public function __construct() {
        $this->mustache = new \Mustache\Engine([
            'loader' => new \Mustache\Loader\FilesystemLoader(__DIR__ . '/views'),
            'extension' => '.mustache',
        ]);
    }

    public function renderPage($template, $data = []) {
        $html = $this->mustache->render('layout/header', $data);
        $html .= $this->mustache->render($template, $data);
        return $html;
    }
}