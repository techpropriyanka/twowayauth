<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Registeration </title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="shortcut icon" href="<?php echo site_url('asset/images/black-logo.png'); ?>">
        <link href="<?php echo site_url('asset/css/config/default/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?php echo site_url('asset/css/config/default/app.min.css'); ?>" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="<?php echo site_url('asset/css/config/default/bootstrap-dark.min.css'); ?>" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="<?php echo site_url('asset/css/config/default/app-dark.min.css'); ?>" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
        <link href="<?php echo site_url('asset/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
    </head>
    <body class="loading authentication-bg authentication-bg-pattern">
        <div class="account-pages mt-5 mb-5">
            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-md-8 col-lg-6 col-xl-4">
                        <div class="card bg-pattern">
                            <div class="card-body p-4">
                                <div class="text-center w-75 m-auto">
                                    <div class="auth-logo">
                                        <a href="<?php echo site_url('/'); ?>" class="logo logo-dark text-center">
                                            <span class="logo-lg">
                                                <h2> User Register </h2>
                                            </span>
                                        </a>
                                        <a href="<?php echo site_url(''); ?>" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <h2> Don't have an account? Create your account, it takes less than a minute </h2>
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">.</p>
                                </div>
                                <form id="register-form">
                                    <div class="mb-3">
                                        <label for="first_name" class="form-label">First Name</label>
                                        <input class="form-control first_name" type="text" name="first_name" placeholder="Enter your name" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="last_name" class="form-label">First Name</label>
                                        <input class="form-control last_name" type="text" name="last_name" placeholder="Enter your name" required="">
                                    </div>
                                    <div class="mb-3">
                                        <label for="email_id" class="form-label">Email * </label>
                                        <input class="form-control email_id" type="email" id="email_id" name="email_id" required="" placeholder="Enter your Email Id">
                                    </div>
                                    <div class="mb-3">
                                        <label for="profile_photo" class="form-label">Profile Photo </label>
                                        <input class="form-control profile_photo" type="file" id="profile_photo" name="profile_photo" required="" placeholder="Enter your Email Id">
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary register-btn" type="submit"> Register </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">You have an account? <a href="<?php echo site_url('/') ?>" class="text-white ms-1"><b>Sign In</b></a></p>
                    </div> <!-- end col -->
                </div>
            </div>
        </div>
        <footer class="footer footer-alt">
            2020 - <script>document.write(new Date().getFullYear())</script> &copy; All rights reserved  
        </footer>
        <script src="<?php echo site_url('asset/js/vendor.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/app.min.js'); ?>"></script>
        <!-- <script src="<?php echo site_url('asset/ajax/user/login.js'); ?>"></script> -->
        <script src="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document).find("title").text("User Register");
                
                $(document).on( 'submit', '#register-form', function (e) {
                    e.preventDefault();
                    var first_name = $(document).find(".first_name").val();
                    var last_name = $(document).find(".last_name").val();
                    var email_id = $(document).find(".email_id").val();
                    if(first_name=="")
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Required...",
                            text: "First Name is required!"
                        });
                    }
                    else if(last_name=="")
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Required...",
                            text: "Last Name is required!"
                        });
                    }
                    else if(email_id=="")
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Required...",
                            text: "Email Id is required!"
                        });
                    }
                    else
                    {
                        var formData = new FormData(this);
                        $.ajax({
                            url:  '<?php echo site_url('user/loginath');?>',
                            method: "POST",
                            data: formData,
                            contentType:false,
                            cache:false,
                            processData:false,
                            success:function(response)
                            {
                                var res = JSON.parse(response);
                        
                                if(res['status'] == 1)
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: "User Registered!",
                                        text: res['message']
                                    });
                                    setTimeout(function () {
                                        window.location.href = "<?php echo base_url('/'); ?>";
                                    }, 1000);

                                }
                                else if(res['status'] == 2 || res['status'] == 3)
                                {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: res['message']
                                    });
                                }
                                else
                                {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "Something went wrong! Try again later"
                                    });
                                } 
                            }
                        });
                    }
                });
            });
        </script>
    </body>
</html>