<div class="card">
    <h1>Task 1: Random Elements from Array</h1>

    <form method="post" class="form">
        <div class="form-group">
            <label for="source_array">Source Array (comma-separated):</label>
            <input type="text"
                   id="source_array"
                   name="source_array"
                   placeholder="apple, banana, cherry, date"
                   pattern="[^,]+(,[^,]+)*"
                   required>
        </div>

        <div class="form-group">
            <label for="count">Number of random elements:</label>
            <input type="number"
                   id="count"
                   name="count"
                   min="1"
                   placeholder="2"
                   required>
        </div>

        <button type="submit" class="btn">Get Random Elements</button>
    </form>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <strong>Error:</strong> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($random_elements)): ?>
        <div class="result">
            <h2>Original Array:</h2>
            <div class="array-display">
                [<?= htmlspecialchars(implode(', ', $original_array), ENT_QUOTES, 'UTF-8') ?>]
            </div>

            <h2>Random Elements (<?= $count ?>):</h2>
            <div class="array-display highlight">
                [<?= htmlspecialchars(implode(', ', $random_elements), ENT_QUOTES, 'UTF-8') ?>]
            </div>

            <button onclick="location.reload()" class="btn">Generate Again</button>
        </div>
    <?php endif; ?>
</div>