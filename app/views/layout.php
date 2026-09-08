<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $title ?? 'VAP Tasks' ?></title>
    <link rel="stylesheet" href="/style.css">
</head>
<body>
<header class="header">
    <nav class="nav">
        <a href="index.php" class="nav-link">Home</a>
        <a href="index.php?task=task1" class="nav-link">Task 1: Factorial</a>
        <a href="index.php?task=task2" class="nav-link">Task 2: Random String</a>
        <a href="index.php?task=task3" class="nav-link">Task 3: Array Sort</a>
    </nav>
</header>

<main class="container">
    <?php $content ??= "";
    echo $content; ?>
</main>

</body>
</html>