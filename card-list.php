
<?php
// AirAsia Rewards - Gift Card List

require_once __DIR__ . '/includes/db.php';

$pageTitle = 'Gift Card List - AirAsia Rewards';

$stmt = $pdo->query(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD
     ORDER BY cardId'
);

$giftCards = $stmt->fetchAll();

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Available Gift Cards</h2>
    <p>Browse our gift cards and redeem your reward points.</p>

    <a class="btn" href="card-add.php">Add Gift Card</a>

    <div class="card-grid">
        <?php foreach ($giftCards as $card): ?>
            <div class="gift-card">
                <a href="card-details.php?id=<?= (int)$card['cardId'] ?>">
                    <img src="images/gift-card.png"
                         alt="Gift Card">
                </a>

                <h3>
                    <a href="card-details.php?id=<?= (int)$card['cardId'] ?>">
                        <?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>
                    </a>
                </h3>

                <p>
                    Type:
                    <?= htmlspecialchars($card['cardType'], ENT_QUOTES, 'UTF-8') ?>
                </p>

                <p>
                    Value: $<?= number_format((float)$card['cardValue'], 2) ?>
                </p>

                <p>
                    <strong>Points Required:</strong>
                    <?= number_format((int)$card['points']) ?>
                </p>

                <a href="card-details.php?id=<?= (int)$card['cardId'] ?>">
                    View Details
                </a>
            </div>
        <?php endforeach; ?>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
