<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'Array Operations' ?></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<header class="header">
    <nav class="nav">
        <a href="index.php?task=task1" class="nav-link">Task 1: Random Array</a>
        <a href="index.php?task=task2" class="nav-link">Task 2-3: Recursive Iterator</a>
    </nav>
</header>

<main class="container">
    <?= $content ?>
</main>

<script>
    // Simple toggle for tree elements
    document.addEventListener('click', function(e) {
        if (e.target.classList.contains('tree-toggle')) {
            const parentLi = e.target.parentElement;
            parentLi.classList.toggle('collapsed');
            e.target.textContent = parentLi.classList.contains('collapsed') ? '▶' : '▼';
        }
    });
</script>
</body>
</html>