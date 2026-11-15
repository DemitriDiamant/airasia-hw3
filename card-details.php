
<?php
// AirAsia Rewards - Gift Card Details

require_once __DIR__ . '/includes/db.php';

// Get gift card ID from URL
$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Find gift card in database
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

// Set page title
$pageTitle = 'Gift Card Details - AirAsia Rewards';

// Include shared layout
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Gift Card Details</h2>

    <div class="gift-card">

        <img
            src="images/gift-card.png"
            alt="Gift Card"
        >

        <h3>
            <?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>
        </h3>

        <p>
            <strong>Type:</strong>
            <?= htmlspecialchars($card['cardType'], ENT_QUOTES, 'UTF-8') ?>
        </p>

        <p>
            <strong>Value:</strong>
            $<?= number_format((float)$card['cardValue'], 2) ?>
        </p>

        <p>
            <strong>Points Required:</strong>
            <?= number_format((int)$card['points']) ?>
        </p>

        <!-- Update and Delete buttons -->
        <div style="margin-top: 25px;">

            <a
                href="card-update.php?id=<?= (int)$card['cardId'] ?>"
                style="display: inline-block;
                       background-color: #e31b23;
                       color: #ffffff !important;
                       -webkit-text-fill-color: #ffffff !important;
                       padding: 12px 20px;
                       margin: 5px;
                       border-radius: 5px;
                       text-decoration: none;
                       font-weight: bold;
                       font-size: 16px;"
            >Update Gift Card</a>

            <a
                href="card-delete.php?id=<?= (int)$card['cardId'] ?>"
                style="display: inline-block;
                       background-color: #e31b23;
                       color: #ffffff !important;
                       -webkit-text-fill-color: #ffffff !important;
                       padding: 12px 20px;
                       margin: 5px;
                       border-radius: 5px;
                       text-decoration: none;
                       font-weight: bold;
                       font-size: 16px;"
            >Delete Gift Card</a>

        </div>

        <p style="margin-top: 25px;">
            <a href="card-list.php">Back to Gift Card List</a>
        </p>

    </div>
</main>

<?php
require __DIR__ . '/includes/footer.php';
?>
