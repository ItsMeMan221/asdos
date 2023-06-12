<!DOCTYPE html>
<html lang="en">


<?php include '../static/head.php' ?>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Product List</h1>
        <table class="table mt-5">
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
</body>

</html>

<script>
    // TODO 2: Call the API that has been made using jquery

    $(document).ready(function(e) {
        const url = "../backend/product_xml.php"
        // Getting the json data using ajax
        let content = "";
        $.ajax({
            type: "GET",
            url: url,
            data: "",
            dataType: "XML",
            success: function(response) {
                const value = $(response).find("Item");
                value.each(function() {
                    let item = $(this)
                    content += `
                            <tr>
                                <td>${item.find('id').text()}</td>
                                <td>${item.find('product_name').text()}</td>
                                <td>${item.find('brand_name').text()}</td>
                                <td>${item.find('release_year').text()}</td>
                                <td>${item.find('price').text()}</td>
                            </tr>
                    `
                })
                $('#content').html(content)
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