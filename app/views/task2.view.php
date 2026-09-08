<div class="card">
    <h1>Task 2</h1>
    
    <form method="post" class="form">
        <div class="form-group">
            <label for="length-input">Enter string length:</label>
            <input type="number" id="length-input" name="length" placeholder="10" min="1" required>
            <small>Minimum length: 1</small>
        </div>
        <button type="submit" class="btn btn-primary">Generate</button>
    </form>

    <?php if (isset($randomString)): ?>
        <div class="result">
            <h3>Generated String:</h3>
            <div class="array-display highlight">
                <p><?= e($randomString) ?></p>
            </div>
            <p><strong>Length:</strong> <?= strlen($randomString) ?></p>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <p><?= e($error) ?></p>
        </div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary">Back to Main</a>
</div>