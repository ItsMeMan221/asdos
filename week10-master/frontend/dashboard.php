<!DOCTYPE html>
<html lang="en">


<?php include '../static/head.php' ?>

<body>
    <div class="container">
        <h1 class="text-center mb-5">Product List</h1>
        <button class="btn btn-success mt-3" id="newProduct"> <i class="bi bi-plus-lg"></i> New Product </button>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">No</th>
                    <th scope="col">Product Name</th>
                    <th scope="col">Brand</th>
                    <th scope="col">Release Year</th>
                    <th scope="col">Price</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody id="content">
            </tbody>
        </table>
    </div>


    <!-- Modal Content -->
    <div class="modal fade" id="modalProduct" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="modalTitle">Add New Product</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
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
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-outline-dark px-5" id="saveProduct">Add Product</button>
                </div>
            </div>
        </div>
    </div>
</body>

</html>

<script>
    $(document).ready(function(e) {
        let id_product = '';
        let id_brand = '';
        const getAllData = () => {
            const url = "../backend/product.php"
            let content = "";
            $.ajax({
                type: "GET",
                url: url,
                data: "",
                dataType: "JSON",
                success: function(response) {
                    const value = response
                    for (x in value) {
                        content += `<tr>
                                <td>${response[x]['id']}</td>
                                <td>${response[x]['product_name']}</td>
                                <td>${response[x]['brand_name']}</td>
                                <td>${response[x]['release_year']}</td>
                                <td>${response[x]['price']}</td>
                                <td>
                                <button class='btn btn-warning' data-id='${response[x]['id']}'
                                data-brand='${response[x]['brand_id']}' id='editModal'>Edit</button>
                                <button class='btn btn-danger' data-id='${response[x]['id']}' id='deleteProduct'>Delete</button>
                                </td>

                            </tr>`
                    }
                    $('#content').html(content)
                }
            });
        }
        const getProductById = (id_product) => {
            const url = "../backend/product.php"

            $.ajax({
                type: "GET",
                url: url,
                data: {
                    "id_product": id_product
                },
                dataType: "JSON",
                success: function(response) {
                    $.each(response, function(i, item) {
                        $('input[name=productName]').val(item.product_name)
                        $('input[name=releaseYear]').val(item.release_year)
                        $('input[name=price]').val(item.price)
                    })

                }
            });
        }
        const getAllBrand = (id_brand) => {
            let content = "";
            const url = "../backend/product.php";
            $.ajax({
                type: "GET",
                url: url,
                data: {
                    "req": 'brands'
                },
                dataType: "JSON",
                success: function(response) {

                    for (x in response) {
                        if (response[x]['id'] == id_brand) {
                            content += `
                        <option value='${response[x]['id']}' selected>${response[x]['description']}</option>
                    `
                        } else {
                            content += `
                        <option value='${response[x]['id']}'>${response[x]['description']}</option>
                    `
                        }
                    }
                    $('#brand').html(content)
                }
            });
        }
        $('#saveProduct').on('click', function(e) {
            e.preventDefault()

            let formData = new FormData($('#productForm')[0])

            let formEl = $('#productForm')

            const url = '../backend/product.php'
            if (id_product == '') {
                formData.append("action", 'insert')
            } else {
                formData.append("action", "update");
                formData.append("id_product", id_product)
            }
            $(this).attr('disabled', true)
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function(response) {
                    $('#saveProduct').attr('disabled', false)

                    if (response.error == true) {
                        formEl.find('small').text('')
                        for (let key in response) {
                            const errorContainer = formEl.find(`#${key}Error`)
                            if (errorContainer.length !== 0) {
                                errorContainer.html(response[key]);
                            }
                        }
                    }
                    if (response.status == 'OK') {
                        formEl.trigger('reset');
                        formEl.find('small').text('');

                        Swal.fire({
                            icon: 'success',
                            title: response.title,
                            text: response.msg,
                        }).then(() => {
                            $("#modalProduct").modal("hide");
                            getAllData();
                        })
                    } else if (response.status == "error") {
                        Swal.fire({
                            icon: 'error',
                            title: response.title,
                            text: response.msg,
                        })
                    }
                }
            });

        })

        getAllData()
        // New Product
        $('#newProduct').on('click', function() {
            $('#modalTitle').text('Add new product')
            $('#saveProduct').text('Add Product')
            $("#modalProduct").modal("show");
            $('input[name=productName]').val("")
            $('input[name=releaseYear]').val("")
            $('input[name=price]').val("")
            id_product = '';
            id_brand = '';
            getAllBrand()
        })
        // Edit Product
        $(document).on('click', "#editModal", function() {
            $('#modalTitle').text('Edit product')
            $('#saveProduct').text('Save')
            id_product = $(this).data("id")
            id_brand = $(this).data("brand");
            $("#modalProduct").modal("show");
            getAllBrand(id_brand)
            getProductById(id_product);
        })

        $(document).on('click', "#deleteProduct", function() {
            id_product = $(this).data("id")
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes!'
            }).then((result) => {
                if (result.isConfirmed) {
                    const url = "../backend/product.php";
                    $.ajax({
                        type: "POST",
                        url: url,
                        data: {
                            "id_product": id_product,
                            "action": "delete"
                        },
                        dataType: "JSON",
                        success: function(response) {
                            if (response.status == 'OK') {
                                Swal.fire({
                                    icon: 'success',
                                    title: response.title,
                                    text: response.msg,
                                }).then(() => {
                                    getAllData();
                                })
                            } else {
                                Swal.fire({
                                    icon: 'error',
                                    title: response.title,
                                    text: response.msg,
                                }).then(() => {
                                    getAllData();
                                })
                            }
                        }
                    });
                }
            })
        })

    })
</script>

<style>
    .prev-img {
        width: 45px;
        height: 45px;
    }
</style>