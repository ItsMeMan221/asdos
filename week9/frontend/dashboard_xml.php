<!DOCTYPE html>
<html lang="en">


<?php include '../static/head.php' ?>

<body>
    <div class="container" id="myFile"></div>
</body>

</html>

<script>
    // TODO 2: Call the API that has been made using jquery

    $(document).ready(function(e) {
        const url = "../backend/generate_product_xml.php"
        // Getting the json data using ajax
        let content = "";
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            success: function(response) {
                $('#myFile').html(`<a href='../backend/${response}'>Click Me</a>`)
            }
        });
    })
</script>

<style>
    .prev-img {
        width: 45px;
        height: 45px;
    }
</style>