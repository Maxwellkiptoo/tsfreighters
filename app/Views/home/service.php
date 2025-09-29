<!-- app/Views/home/service.php -->
<!DOCTYPE html>
<html>
<head>
    <title>Our Services</title>
</head>
<body>
    <h1>Our Services</h1>

    <?php if (!empty($services)): ?>
        <ul>
            <?php foreach ($services as $service): ?>
                <li>
                    <strong><?= htmlspecialchars($service['title']) ?></strong><br>
                    <?= nl2br(htmlspecialchars($service['description'])) ?><br>
                    Price: $<?= number_format($service['price'], 2) ?>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php else: ?>
        <p>No services available.</p>
    <?php endif; ?>
</body>
</html>
