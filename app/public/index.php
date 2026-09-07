<?php
require __DIR__ . '/../vendor/autoload.php';

use App\Render;
use function App\handleTask1Post;
use function App\handleTask2Post;
use function App\handleTask3Post;

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
    handlePostRequest($task, $params);
}

$view = $pages[$task] ?? 'main.view.php';
$renderer->render($view, $params);

function handlePostRequest(string $task, array &$params): void
{
    switch ($task) {
        case 'task1':
            handleTask1Post($params);
            break;
        case 'task2':
            handleTask2Post($params);
            break;
        case 'task3':
            handleTask3Post($params);
            break;
    }
}

