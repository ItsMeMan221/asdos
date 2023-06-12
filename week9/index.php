<!DOCTYPE html>
<html lang="en">
<?php include './static/head.php' ?>


<body class="back-color">
    <section class="vh-100 gradint">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-12 col-md-8 col-lg-6 col-xl-5">
                    <div class="card bg-white text-dark" style="border-radius: 1rem;">
                        <div class="card-body p-5 text-center">

                            <div class="mb-md-5 mt-md-4 pb-5">

                                <h2 class="fw-bold mb-2 text-uppercase">Login Page</h2>
                                <p class="text-dark-50 mb-5 text-a mt-3">Welcome to <span class="text-bold">TechX </span>please enter your <span class="text-bold">email</span> along with your <span class="text-bold">Password </span>!</p>
                                <form method="POST" id="loginForm">
                                    <div class="form-outline form-dark mb-4">
                                        <label class="form-label" for="email">Email Address</label>
                                        <input type="text" name="email" id="email" class="form-control form-control-lg"/>
                                        <small class="text-danger ml-5" id="emailError"></small>

                                    </div>
                                    <div class="form-outline form-white mb-4">
                                        <label class="form-label" for="password">Password</label>
                                        <input type="password" id="password" name="password" class="form-control form-control-lg" />
                                        <small class="text-danger ml-5" id="passwordError"></small>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-outline-dark btn-lg px-5" value="Submit">LOG-IN</button>
                                </form>
                            </div>
                            <div>
                                <p class="mb-0">Don't have an account? <a href="" class="text-dark-50 fw-bold">Sign Up</a>
                                </p>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
</html>

<script>
    $(document).ready(function() {
        $('#loginForm').on('submit', function(e) {

            // Prevent refreshing page
            e.preventDefault()

            var formData = new FormData($(this)[0]);

            let formEl = $(this);
            formEl.find(':submit').attr('disabled', true);

            const url = './backend/login.php'
            $.ajax({
                type: "POST",
                url: url,
                data: formData,
                dataType: "JSON",
                contentType: false,
                processData: false,
                success: function (response) {
                    formEl.find(':submit').attr('disabled', false);

                    // Check Validation
                    if (response.error == true) {
                        formEl.find('small').text('')

                        // Error Printing
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
                            title: 'Login Success',
                            text: response.message,
                    }).then(() => {
                        document.location.href = './frontend/dashboard.php'
                    })
                    } else if (response.status == 'error'){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: response.message,
                    })
                    }
                },
                error: function(xhr, textStatus, errorThrown) {
                console.log(errorThrown);
                },
            });
        })
    })
</script>