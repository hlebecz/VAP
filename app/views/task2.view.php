<h1>Task 2</h1>
<form method="post">
    <label for="length-input">Enter string length: </label>
    <input type="number" id="length-input" name="length" placeholder="10" min="1" required>
    <input type="submit" value="Generate">
</form>

<?php if (isset($randomString)): ?>
    <div>
        <h3>Generated String:</h3>
        <p><?= e($randomString) ?></p>
        <p>Length: <?= strlen($randomString) ?></p>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <p><?= e($error) ?></p>
<?php endif; ?>

<a href="index.php">Back</a>