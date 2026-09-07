<h1>Task 1</h1>

<form method="post">
    <label for="number-input">Enter your number: </label>
    <input type="number" id="number-input" name="number" placeholder="0" required>
    <input type="submit" value="Calculate">
</form>

<?php if (isset($factorial)): ?>
    <div class="result">
        <h3>Factorial result: <?= e((string)$factorial) ?></h3>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error">
        <p><?= e($error) ?></p>
    </div>
<?php endif; ?>

<a href="index.php">Back</a>