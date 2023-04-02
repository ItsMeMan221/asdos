<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Saving directory
    $save_dir = 'image/';

    // Generate random name
    $rand_name = md5(uniqid(mt_rand(), true));

    // Original Name
    $org_name = $save_dir . basename($_FILES["uploadFile"]["name"]);

    // Tipe File
    $file_type = strtolower(pathinfo($org_name, PATHINFO_EXTENSION));

    // Add format file to random name
    $rand_name .= "." . $file_type;

    // Finally concat tthe string of saving directory and name of the file
    $target_file = $save_dir . $rand_name;

    // Checking whether upload is Valid or not 
    $uploadOK = 1;
    $err = "";

    if (isset($_POST['submit'])) {
        // Validate file
        $checker = getimagesize($_FILES['uploadFile']['tmp_name']);
        if ($checker !== false) {
            $uploadOK = 1;
        } else {
            $err = "Please provide image type file";
            $uploadOK = 0;
        }
        if ($_FILES['uploadFile']['size'] > 500000) {
            $uploadOK = 0;
            $err  = "File was too large";
        }
        if ($uploadOK == 1) {
            try {
                if (move_uploaded_file($_FILES['uploadFile']['tmp_name'], $target_file)) {
                    echo "File is uploaded";
                } else {
                    throw new Exception("Internal Error");
                }
            } catch (Exception $err) {
                echo "ERROR : " . $err;
            }
        } else {
            echo $err;
        }
    }
}


?>

<!DOCTYPE html>
<html lang="en">
<?php
$head = "Upload Files";
include './framework/bootstrap.php';
?>

<style>
    .prev-img {
        width: 200px;
        height: 200px;
    }
</style>

<body>
    <div class="">
        <img id="prev-img" class="w-25 h-25 prev-img img-thumbnail">
    </div>
    <form method="POST" enctype="multipart/form-data" action="">
        <div class="mb-3">
            <label for="uploadFile" class="form-label">Upload Your Image</label>
            <input class="form-control" type="file" name="uploadFile" id="uploadFile" multiple>
        </div>
        <div>
            <input type="submit" name="submit" class="btn btn-primary">
        </div>
    </form>
    <img>
</body>

</html>
<script>
    $(document).ready(function() {
        $('#uploadFile').on('change', function() {
            const file = document.getElementById("uploadFile").files[0];
            const image = URL.createObjectURL(file);
            $('#prev-img').attr('src', image);
        })
    })
</script>