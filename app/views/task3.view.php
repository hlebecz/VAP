<div class="card">
    <h1>Task 3</h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="array-input">Enter array values (comma-separated):</label>
            <input type="text" id="array-input" name="array" placeholder="5, 2, 8, 1, 9" required>
        </div>

        <div class="form-group">
            <label>Sort order:</label>
            <div class="radio-group">
                <label class="radio-label">
                    <input type="radio" name="sort_order" value="asc" checked>
                    <span>Ascending (sort)</span>
                </label>
                <label class="radio-label">
                    <input type="radio" name="sort_order" value="desc">
                    <span>Descending (rsort)</span>
                </label>
            </div>
        </div>

        <button type="submit" class="btn btn-primary">Sort Array</button>
    </form>

    <?php if (isset($sortedArray)): ?>
        <div class="result">
            <h3>Original Array:</h3>
            <div class="array-display">
                [<?= e(implode(', ', $originalArray)) ?>]
            </div>

            <h3>Sorted Array (<?= e($sortType) ?>):</h3>
            <div class="array-display highlight">
                [<?= e(implode(', ', $sortedArray)) ?>]
            </div>
        </div>
    <?php endif; ?>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <p><?= e($error) ?></p>
        </div>
    <?php endif; ?>

    <a href="index.php" class="btn btn-secondary">Back to Main</a>
</div>