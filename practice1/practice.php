<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Triangle calulator</title>
</head>
<body>
    <h2>Calculate the Area of a Triangle using Heron's Formula</h2>

    <!-- HTML Form -->
    <form method="POST" action="">
        <label for="side1">Side 1:</label>
        <input type="number" step="any" id="side1" name="side1" required><br><br>

        <label for="side2">Side 2:</label>
        <input type="number" step="any" id="side2" name="side2" required><br><br>

        <label for="side3">Side 3:</label>
        <input type="number" step="any" id="side3" name="side3" required><br><br>

        <button type="submit">Calculate Area</button>
    </form>

    <?php
    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get input values from the form
        $side1 = $_POST['side1'];
        $side2 = $_POST['side2'];
        $side3 = $_POST['side3'];
    ?>
    
</body>
</html>