<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Answer  Question</title>
</head>
<body>

    <?php

        print_r('heloo');
        print_r('1,2,3');

        class person{
            public $name;
            public $age;
        }

        $person = new person();
        $person->name = 'Joshua';
        $person->age = 20;
        //  Q1 what is the output of print_r($person) = ( [name] => Joshua [age] => 20 )
        print_r($person); //person Object ( [name] => Joshua [age] => 20 )


        // Q2 what is the output of var_dump($person)?
        var_dump($person); // object(person)#1 (2) { ["name"]=> string(6) "Joshua" ["age"]=> int(20) }


        // var_dump('Hello'); //string(5) "Hello"
        // var_dump([1,2,3]); //array(3) { [0]=> int(1) [1]=> int(2) [2]=> int(3) }

        $name = 'Joshua';
        $age = 20;
        $haskid = true;
        $cashOnHand = 10.5;

        // Q3 output of var_dump($cashOnHand) = float(10.5)
        var_dump($cashOnHand) // float(10.5)
    ?>
    
</body>
</html>