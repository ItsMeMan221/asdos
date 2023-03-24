<?php

class Car
{
    public $model;

    function Car($model)
    {
        $this->model = $model;
    }
}
$herbie = new Car("Volkswagen");
echo $herbie->model;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>

</body>

</html>