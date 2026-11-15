
<?php
// AirAsia Rewards - Update Gift Card

require_once __DIR__ . '/includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Find the existing gift card
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

$errors = [];

$name = $card['cardName'];
$type = $card['cardType'];
$value = $card['cardValue'];
$points = $card['points'];

// Process the update form
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $name = trim($_POST['cardName'] ?? '');
    $type = trim($_POST['cardType'] ?? '');
    $value = trim($_POST['cardValue'] ?? '');
    $points = trim($_POST['points'] ?? '');

    // Validate the information
    if ($name === '' || mb_strlen($name) > 120) {
        $errors[] = 'Enter a valid gift card name.';
    }

    if ($type === '') {
        $errors[] = 'Enter a gift card type.';
    }

    if (!is_numeric($value) || (float)$value <= 0) {
        $errors[] = 'Enter a valid card value.';
    }

    if (filter_var($points, FILTER_VALIDATE_INT) === false
        || (int)$points <= 0) {
        $errors[] = 'Enter valid reward points.';
    }

    // Save the updated gift card
    if (empty($errors)) {

        $stmt = $pdo->prepare(
            'UPDATE GIFTCARD
             SET cardName = :name,
                 cardType = :type,
                 cardValue = :value,
                 points = :points
             WHERE cardId = :id'
        );

        $stmt->execute([
            'name' => $name,
            'type' => $type,
            'value' => $value,
            'points' => $points,
            'id' => $id
        ]);

        header('Location: card-details.php?id=' . $id);
        exit;
    }
}

$pageTitle = 'Update Gift Card - AirAsia Rewards';

require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Update Gift Card</h2>

    <p>Edit the gift card information below.</p>

    <?php if (!empty($errors)): ?>
        <div class="error">
            <?php foreach ($errors as $error): ?>
                <p><?= htmlspecialchars($error) ?></p>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <form method="POST"
          action="card-update.php?id=<?= (int)$id ?>">

        <label for="cardName">Gift Card Name:</label>
        <input
            type="text"
            id="cardName"
            name="cardName"
            value="<?= htmlspecialchars((string)$name, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <label for="cardType">Gift Card Type:</label>
        <input
            type="text"
            id="cardType"
            name="cardType"
            value="<?= htmlspecialchars((string)$type, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <label for="cardValue">Gift Card Value:</label>
        <input
            type="number"
            id="cardValue"
            name="cardValue"
            step="0.01"
            min="0.01"
            value="<?= htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <label for="points">Points Required:</label>
        <input
            type="number"
            id="points"
            name="points"
            min="1"
            step="1"
            value="<?= htmlspecialchars((string)$points, ENT_QUOTES, 'UTF-8') ?>"
            required
        >

        <button type="submit" class="btn">
            Save Changes
        </button>

    </form>

    <p>
        <a href="card-details.php?id=<?= (int)$id ?>">
            Cancel and Return to Gift Card
        </a>
    </p>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
