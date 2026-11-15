
<?php

require_once __DIR__ . '/../includes/validation.php';

$tests = [
    [
        'name' => 'Valid gift card',
        'data' => ['Amazon Gift Card', 'Shopping', '25', '2500'],
        'expected' => true
    ],
    [
        'name' => 'Empty gift card name',
        'data' => ['', 'Shopping', '25', '2500'],
        'expected' => false
    ],
    [
        'name' => 'Empty gift card type',
        'data' => ['Test Card', '', '25', '2500'],
        'expected' => false
    ],
    [
        'name' => 'Negative gift card value',
        'data' => ['Test Card', 'Shopping', '-25', '2500'],
        'expected' => false
    ],
    [
        'name' => 'Negative reward points',
        'data' => ['Test Card', 'Shopping', '25', '-500'],
        'expected' => false
    ],
    [
        'name' => 'Zero reward points',
        'data' => ['Test Card', 'Shopping', '25', '0'],
        'expected' => false
    ],
    [
        'name' => 'Non-numeric gift card value',
        'data' => ['Test Card', 'Shopping', 'abc', '2500'],
        'expected' => false
    ]
];

$passed = 0;
$failed = 0;

foreach ($tests as $test) {
    $errors = validateGiftCard(...$test['data']);
    $valid = empty($errors);

    if ($valid === $test['expected']) {
        echo "PASS: {$test['name']}\n";
        $passed++;
    } else {
        echo "FAIL: {$test['name']}\n";
        $failed++;
    }
}

echo "\nResults: $passed passed, $failed failed.\n";

if ($failed > 0) {
    exit(1);
}
