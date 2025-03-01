<?php

function calculateTotalPrice(array $items): float {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['price'];
    }
    return $total;
}

function processString(string $inputString): string {
    $processed = str_replace(' ', '', $inputString);
    return strtolower($processed);
}

function checkNumberParity(int $number): string {
    return ($number % 2 == 0) 
        ? "The number {$number} is even."
        : "The number {$number} is odd.";
}

$items = [
    ['name' => 'Widget A', 'price' => 10],
    ['name' => 'Widget B', 'price' => 15],
    ['name' => 'Widget C', 'price' => 20],
];

$total = calculateTotalPrice($items);
echo "Total price: $" . $total;

$string = "This is a poorly written program with little structure and readability.";
$modifiedString = processString($string);
echo "\nModified string: " . $modifiedString;

$number = 42;
echo "\n" . checkNumberParity($number);
?>