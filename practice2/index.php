<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Array of Fruits</title>
</head>
<body>
    <h2>FRUITS</h2>
    <?php
// Create an array of fruits with at least five elements
$fruits = ["Apple", "Banana", "Orange", "Grapes", "Mango"];

// Use a for loop to display each element in an ordered list
echo "<ol>";
for ($i = 0; $i < count($fruits); $i++) {
    echo "<li>" . $fruits[$i] . "</li>";
}
echo "</ol>";
?>
    
</body>
</html>