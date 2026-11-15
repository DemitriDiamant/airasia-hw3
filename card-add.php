
<?php
// AirAsia Rewards - Add Gift Card
require_once __DIR__ . '/includes/db.php';
require_once __DIR__ . '/includes/validation.php';
$errors = [];
$cardName = '';
$cardType = '';
$cardValue = '';
$points = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $cardName = trim($_POST['cardName'] ?? '');
    $cardType = trim($_POST['cardType'] ?? '');
    $cardValue = trim($_POST['cardValue'] ?? '');
    $points = trim($_POST['points'] ?? '');

    $errors = validateGiftCard(
    $cardName,
    $cardType,
    $cardValue,
    $points
);

    if (empty($errors)) {
        $stmt = $pdo->prepare(
            'INSERT INTO GIFTCARD
             (cardName, cardType, cardValue, points)
             VALUES (:cardName, :cardType, :cardValue, :points)'
        );

        $stmt->execute([
            'cardName' => $cardName,
            'cardType' => $cardType,
            'cardValue' => $cardValue,
            'points' => $points
        ]);

        header('Location: card-list.php');
        exit;
    }
}

$pageTitle = 'Add Gift Card - AirAsia Rewards';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Add Gift Card</h2>
    <p>Enter the gift card information below.</p>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST" action="card-add.php">

        <label for="cardName">Gift Card Name:</label>
        <input type="text" id="cardName" name="cardName"
               maxlength="120" required
               value="<?= htmlspecialchars($cardName, ENT_QUOTES, 'UTF-8') ?>">

        <label for="cardType">Gift Card Type:</label>
        <input type="text" id="cardType" name="cardType"
               required
               value="<?= htmlspecialchars($cardType, ENT_QUOTES, 'UTF-8') ?>">

        <label for="cardValue">Gift Card Value:</label>
        <input type="number" id="cardValue" name="cardValue"
               step="0.01" min="0.01" required
               value="<?= htmlspecialchars($cardValue, ENT_QUOTES, 'UTF-8') ?>">

        <label for="points">Points Required:</label>
        <input type="number" id="points" name="points"
               min="1" step="1" required
               value="<?= htmlspecialchars($points, ENT_QUOTES, 'UTF-8') ?>">

        <button type="submit" class="btn">Add Gift Card</button>
    </form>

    <p><a href="card-list.php">Back to Gift Card List</a></p>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
