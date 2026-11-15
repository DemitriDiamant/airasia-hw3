
<?php
// AirAsia Rewards - Delete Gift Card
require_once __DIR__ . '/includes/db.php';

$id = filter_input(INPUT_GET, 'id', FILTER_VALIDATE_INT);

if (!$id || $id < 1) {
    http_response_code(400);
    exit('Invalid gift card ID.');
}

// Find the selected gift card
$stmt = $pdo->prepare(
    'SELECT cardId, cardName FROM GIFTCARD WHERE cardId = :id'
);
$stmt->execute(['id' => $id]);
$card = $stmt->fetch();

if (!$card) {
    http_response_code(404);
    exit('Gift card not found.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $submittedId = filter_input(INPUT_POST, 'id', FILTER_VALIDATE_INT);

    if ($submittedId !== $id) {
        http_response_code(400);
        exit('Invalid delete request.');
    }

    $stmt = $pdo->prepare(
        'DELETE FROM GIFTCARD WHERE cardId = :id'
    );
    $stmt->execute(['id' => $id]);

    header('Location: card-list.php');
    exit;
}

$pageTitle = 'Delete Gift Card - AirAsia Rewards';
require __DIR__ . '/includes/header.php';
require __DIR__ . '/includes/nav.php';
?>

<main>
    <h2>Delete Gift Card</h2>

    <p>
        Are you sure you want to delete
        <strong>
            <?= htmlspecialchars($card['cardName'], ENT_QUOTES, 'UTF-8') ?>
        </strong>?
    </p>

    <p>This action cannot be undone.</p>

    <form method="POST"
          action="card-delete.php?id=<?= (int)$card['cardId'] ?>">

        <input type="hidden" name="id"
               value="<?= (int)$card['cardId'] ?>">

        <button type="submit" class="btn">
            Confirm Delete
        </button>
    </form>

    <p>
        <a href="card-details.php?id=<?= (int)$card['cardId'] ?>">
            Cancel and Return to Gift Card
        </a>
    </p>
</main>

<?php require __DIR__ . '/includes/footer.php'; ?>
