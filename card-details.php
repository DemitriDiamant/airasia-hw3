
<?php
// AirAsia Rewards - Gift Card Details

require_once __DIR__ . '/includes/db.php';

// Get the selected gift card ID
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Find the gift card in the database
$stmt = $pdo->prepare(
    'SELECT cardId, cardName, cardType, cardValue, points
     FROM GIFTCARD
     WHERE cardId = :id'
);

$stmt->execute(['id' => $id]);
$card = $stmt->fetch();

if (!$card) {
    http_response_code(404);
    exit('Gift card not found.');
}

$pageTitle = 'Gift Card Details - AirAsia Rewards';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Gift Card Details</h2>

    <div class="gift-card">
        <img src="images/gift-card.png"
             alt="Gift Card">

        <h3>
            <?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>
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

        <a class="btn"
           href="card-update.php?id=<?= (int)$card['cardId'] ?>">
            Update Gift Card
        </a>

        <a class="btn"
           href="card-delete.php?id=<?= (int)$card['cardId'] ?>">
            Delete Gift Card
        </a>

        <p>
            <a href="card-list.php">Back to Gift Card List</a>
        </p>
    </div>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
