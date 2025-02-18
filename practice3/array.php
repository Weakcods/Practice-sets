<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array of Even Numbers</title>
</head>
<body>
    <h2>EVEN NUMBERS</h2>
    <?php
    // Define a 3x3 matrix
    $matrix = [
        [12, 23, 34],
        [45, 55, 62],
        [71, 84, 90]
    ];

    // Initialize row and column counters
    $row = 0;

    echo "Even numbers from the matrix:<br>";

    // Iterate through the matrix using a while loop
    while ($row < count($matrix)) {
        $col = 0;
        while ($col < count($matrix[$row])) {
            if ($matrix[$row][$col] % 2 == 0) {
                echo $matrix[$row][$col] . "<br>";
            }
            $col++;
        }
        $row++;
    }
?>
    
</body>
</html>