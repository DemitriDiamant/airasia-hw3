
<?php
// AirAsia Rewards - Gift Card List

require_once __DIR__ . '/includes/db.php';

// Set the page title
$pageTitle = 'Gift Card List - AirAsia Rewards';

// Retrieve all gift cards from the database
$stmt = $pdo->query(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD
     ORDER BY cardId'
);

$giftCards = $stmt->fetchAll();

// Include shared header and navigation
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Available Gift Cards</h2>

    <p>Browse our gift cards and redeem your reward points.</p>

    <a class="btn" href="card-add.php">Add Gift Card</a>

    <div class="card-grid">

        <?php if (empty($giftCards)): ?>
            <p>No gift cards are currently available.</p>
        <?php else: ?>

            <?php foreach ($giftCards as $card): ?>
                <div class="gift-card">

                    <a href="card-details.php?id=<?= (int)$card['cardId'] ?>">
                        <img
                            src="images/gift-card.png"
                            alt="Gift Card"
                        >
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
                        Value:
                        $<?= number_format((float)$card['cardValue'], 2) ?>
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

        <?php endif; ?>

    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
