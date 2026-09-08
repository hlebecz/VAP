<div class="card">
    <h1>Task 1</h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="number-input">Enter your number:</label>
            <input type="number" id="number-input" name="number" placeholder="0" max="20" required>
        </div>
        <button type="submit" class="btn btn-primary">Calculate</button>
    </form>

    <?php if (isset($factorial)): ?>
        <div class="result">
            <h3>Factorial result: <?= e((string)$factorial) ?></h3>
        <br>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <p><?= e($error) ?></p>
        </div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary">Back to Main</a>
</div>