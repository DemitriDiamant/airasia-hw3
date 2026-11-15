
<?php

function validateGiftCard($cardName, $cardType, $cardValue, $points) {
    $errors = [];

    if (trim($cardName) === '' || strlen(trim($cardName)) > 120) {
        $errors[] = 'Gift card name must be 1 to 120 characters.';
    }

    $allowedTypes = ['Dining', 'Entertainment', 'Shopping', 'Travel'];

if (!in_array(trim($cardType), $allowedTypes, true)) {
    $errors[] = 'Select a valid gift card type.';
}
    if (!is_numeric($cardValue) || (float)$cardValue < 0.01) {
        $errors[] = 'Gift card value must be at least 0.01.';
    }

    if (filter_var($points, FILTER_VALIDATE_INT) === false || (int)$points < 1) {
        $errors[] = 'Points must be a positive whole number.';
    }

    return $errors;
}
