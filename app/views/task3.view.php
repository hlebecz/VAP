<h1>Task 3</h1>

<form method="post">
    <label for="array-input">Enter array values (comma-separated): </label>
    <input type="text" id="array-input" name="array" placeholder="5, 2, 8, 1, 9" required>

    <div class="sort-options">
        <label>
            <input type="radio" name="sort_order" value="asc" checked>
            Ascending (sort)
        </label>
        <label>
            <input type="radio" name="sort_order" value="desc">
            Descending (rsort)
        </label>
    </div>

    <input type="submit" value="Sort Array">
</form>

<?php if (isset($sortedArray)): ?>
    <div class="result">
        <h3>Original Array:</h3>
        <p>[<?= e(implode(', ', $originalArray)) ?>]</p>

        <h3>Sorted Array (<?= e($sortType) ?>):</h3>
        <p>[<?= e(implode(', ', $sortedArray)) ?>]</p>
    </div>
<?php endif; ?>

<?php if (isset($error)): ?>
    <div class="error">
        <p><?= e($error) ?></p>
    </div>
<?php endif; ?>

<a href="index.php">Back</a>