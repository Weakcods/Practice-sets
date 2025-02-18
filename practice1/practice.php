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

    // Validate triangle inequality theorem (optional but recommended)
    if (($side1 + $side2 > $side3) && ($side1 + $side3 > $side2) && ($side2 + $side3 > $side1)) {
        // Calculate semi-perimeter (s)
        $s = ($side1 + $side2 + $side3) / 2;

        // Calculate the area using Heron's formula without sqrt (using ** 0.5)
        $area_squared = $s * ($s - $side1) * ($s - $side2) * ($s - $side3);
        $area = $area_squared ** 0.5; // Equivalent to sqrt()

        // Format the result to two decimal places
        $formatted_area = number_format($area, 2);

         // Display the result
         echo "<h3>The area of the triangle is: $formatted_area</h3>";
        } else {
            echo "<p style='color:red;'>Error: The given sides do not form a valid triangle.</p>";
        }
    }
   ?>
</body>
</html>