<?php

// Untuk default time bisa cek di sini : https://www.php.net/manual/en/timezones.php

$desc = "";
$value = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['currDateLcl'])) {
        date_default_timezone_set("Asia/Jakarta");
        $desc = "Current date in Local Time is: ";
        $value = date("d/m/Y");
    }
    if (isset($_POST['currDateUS'])) {
        date_default_timezone_set("America/Los_Angeles");
        $desc = "Current date in Los Angles Time is: ";
        $value = date("l,Y/m/d");
    }
    if (isset($_POST['currTimeLcl'])) {
        date_default_timezone_set("Asia/Jakarta");
        $desc = "Current Time in Local Time is: ";
        $value = date("h:i:sa");
    }
    if (isset($_POST['currTimeUS'])) {
        date_default_timezone_set("America/Los_Angeles");
        $desc = "Current Time in Los Angles is: ";
        $value = date("h:i:sa");
    }
}

?>


<!DOCTYPE html>
<html lang="en">
<?php
$head = "DATE & TIME";
include './framework/bootstrap.php'
    ?>

<body>
    <?php
    if (isset($value)) {
        echo "<h5>" . $desc . "</h5>";
        echo "<h4>" . $value . "</h4>";
    }
    ?>
    <form method="POST" action="" class="container mt-5">
        <div class="row">
            <div class="col">
                <button type="submit" name="currDateLcl" class="btn btn-primary">Get Current Date (Local Time)</button>
            </div>
            <div class="col">
                <button type="submit" name="currDateUS" class="btn btn-primary">Get Current Date (Los Angles
                    Time)</button>
            </div>
            <div class="col">
                <button type="submit" name="currTimeLcl" class="btn btn-primary">Get Current Time (Local Time)</button>
            </div>
            <div class="col">
                <button type="submit" name="currTimeUS" class="btn btn-primary">Get Current Time (Los Angles
                    Time)</button>
            </div>
        </div>
    </form>
</body>

</html>