<?php

?>

<!DOCTYPE html>
<html lang="en">

<?php
$head = 'POST METHOD | GET METHOD';
include './framework/bootstrap.php'
    ?>

<body>
    <h1 class="text-center mt-2">GET</h1>
    <form method="GET" action="4.1CatchGet.php" class="container">
        <div class="row mb-3 mt-5">
            <label for="email" class="col-sm-2 col-form-label">Email</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="email" placeholder="Input your email" name="email">
            </div>
        </div>
        <div class="row mb-3 mt-4">
            <label for="password" class="col-sm-2 col-form-label">Password</label>
            <div class="col-sm-10">
                <input type="text" class="form-control" id="password" placeholder="Input your password" name="password">
            </div>
        </div>
        <div class="row mb-3 mt-3">
            <input type="submit" class="col mx-5 mt-4 btn btn-primary" name="submit">
        </div>
    </form>
</body>

</html>