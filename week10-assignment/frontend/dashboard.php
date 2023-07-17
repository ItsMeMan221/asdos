<!DOCTYPE html>
<html lang="en">


<?php include '../static/head.php' ?>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Product List</h1>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Price</th>
                </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
    </div>

    <!-- Code Your Modal Structure Below Here!  -->


    <!-- To make your life easier, I provided the structure for the form, make sure the form is inside the modal structure! -->
    <!--
    <form method="POST" id="productForm">
        <div class="form-outline form-dark mb-4">
            <label class="form-label" for="productName">Product Name</label>
            <input type="text" name="productName" id="productName" class="form-control form-control" />
            <small class="text-danger ml-5" id="productNameError"></small>
        </div>
        <div class="form-outline form-dark mb-4">
            <label class="form-label" for="price">Price</label>
            <input type="number" name="price" id="price" class="form-control form-control" />
            <small class="text-danger ml-5" id="priceError"></small>
        </div>
        <div class="form-outline form-dark mb-4">
            <label class="form-label" for="brand">Brand</label>
            <select class="form-select" id="brand" aria-label="Floating label select example" name="brand"></select>
        </div>
        <div class="form-outline form-dark mb-4">
            <label class="form-label" for="releaseYear">Release Year</label>
            <input type="number" class="form-select" id="releaseYear" aria-label="Floating label select example" name="releaseYear"></input>
            <small class="text-danger ml-5" id="releaseYearError"></small>
        </div>
        </select>
    </form>
    -->
</body>

</html>

<script>
    // Code your AJAX below here to add and show all of the product!
</script>

<style>
    .prev-img {
        width: 45px;
        height: 45px;
    }
</style>