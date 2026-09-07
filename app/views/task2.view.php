<div class="card">
    <h1>Task 2: Recursive Iterator </h1>

    <form method="post" class="form">
        <button type="submit" class="btn">Generate Demo Data</button>
    </form>

    <?php if (isset($error)): ?>
        <div class="alert alert-error">
            <strong>Error:</strong> <?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?>
        </div>
    <?php endif; ?>

    <?php if (isset($flattened)): ?>
        <h2>Flattened Array (with paths):</h2>
        <table class="table">
            <thead>
            <tr>
                <th>Path</th>
                <th>Key</th>
                <th>Value</th>
                <th>Depth</th>
                <th>Has Children</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($flattened as $item): ?>
                <tr>
                    <td><?= htmlspecialchars($item['path'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td><?= htmlspecialchars((string)$item['key'], ENT_QUOTES, 'UTF-8') ?></td>
                    <td>
                        <?php if (is_array($item['value'])): ?>
                            <em>[Array]</em>
                        <?php else: ?>
                            <?= htmlspecialchars((string)$item['value'], ENT_QUOTES, 'UTF-8') ?>
                        <?php endif; ?>
                    </td>
                    <td><?= $item['depth'] ?></td>
                    <td><?= $item['has_children'] ? 'Yes' : 'No' ?></td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <?php if (isset($html_tree)): ?>
        <h2>Tree Structure:</h2>
        <div class="tree-container">
            <?= $html_tree ?>
        </div>
    <?php endif; ?>
</div>