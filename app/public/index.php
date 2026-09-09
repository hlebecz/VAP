<?php

declare(strict_types=1);

use App\ArrayRandomizer;
use App\RecursiveArrayIterator;
use App\Render;

require_once __DIR__ . '/../vendor/autoload.php';

// Error logging configuration
ini_set('log_errors', '1');
ini_set('error_log', __DIR__ . '/logs/errors.log');

const VIEWS_PATH = __DIR__ . '/../views/';
const LAYOUT_PATH = __DIR__ . '/../views/layout.php';

$renderer = new Render(VIEWS_PATH, LAYOUT_PATH);

$pages = [
    'task1' => 'task1.view.php',
    'task2' => 'task2.view.php',
];

$task = $_GET['task'] ?? null;
$params = [];

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $task !== null) {
    try {
        handle_post_request($task, $params);
    } catch (Throwable $e) {
        error_log('[' . date('Y-m-d H:i:s') . '] ' . $e->getMessage() . ' in ' . $e->getFile() . ':' . $e->getLine());
        $params['error'] = $e->getMessage();
    }
}

$view = $pages[$task] ?? 'main.view.php';
$renderer->render($view, $params);

/**
 * Handle POST requests for different tasks
 *
 * @param string $task Task identifier
 * @param array &$params Parameters to pass to view
 * @return void
 */
function handle_post_request(string $task, array &$params): void
{
    switch ($task) {
        case 'task1':
            handle_task1($params);
            break;
        case 'task2':
            handle_task2($params);
            break;
    }
}

/**
 * @param array &$params Parameters for view
 * @return void
 * @throws InvalidArgumentException
 */
function handle_task1(array &$params): void
{
    $sourceArray = $_POST['source_array'] ?? '';
    $count = (int)($_POST['count'] ?? 0);

    // Parse comma-separated values
    $arrayElements = array_map('trim', explode(',', $sourceArray));
    $arrayElements = array_filter($arrayElements, 'strlen');

    if (empty($arrayElements)) {
        throw new InvalidArgumentException('Source array cannot be empty');
    }

    $randomizer = new ArrayRandomizer();
    $randomElements = $randomizer->getRandomElements($arrayElements, $count);

    $params['original_array'] = $arrayElements;
    $params['random_elements'] = $randomElements;
    $params['count'] = $count;
}

/**
 * @param array &$params Parameters for view
 * @return void
 */
function handle_task2(array &$params): void
{
    // Sample nested array for demonstration
    $nestedArray = [
        'users' => [
            'admin' => [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'roles' => ['super_admin', 'editor'],
            ],
            'moderator' => [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'roles' => ['editor', 'reviewer'],
            ],
        ],
        'settings' => [
            'theme' => 'dark',
            'notifications' => [
                'email' => true,
                'push' => false,
                'sms' => ['enabled' => true, 'limit' => 100],
            ],
        ],
        'metadata' => [
            'version' => '1.0.0',
            'created' => '2024-01-15',
        ],
    ];

    $iterator = new RecursiveArrayIterator();

    $params['nested_array'] = $nestedArray;
    $params['flattened'] = $iterator->flatten($nestedArray);
    $params['html_tree'] = $iterator->toHtmlTree($nestedArray);
}
