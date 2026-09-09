<?php
require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../src/functions.php';

use App\Render;

const VIEWS_PATH = __DIR__ . '/../views/';
const LAYOUT_PATH = __DIR__ . '/../views/layout.php';

$renderer = new Render(VIEWS_PATH, LAYOUT_PATH);

$pages = [
    'task1' => 'task1.view.php',
    'task2' => 'task2.view.php',
    'task3' => 'task3.view.php',
];

$task = $_GET['task'] ?? null;

$params = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    handle_post_request($task, $params);
}

$view = $pages[$task] ?? 'main.view.php';
$renderer->render($view, $params);

function handle_post_request(string $task, array &$params): void
{
    switch ($task) {
        case 'task1':
            handle_task1($params);
            break;
        case 'task2':
            handle_task2($params);
            break;
        case 'task3':
            handle_task3($params);
            break;
    }
}

