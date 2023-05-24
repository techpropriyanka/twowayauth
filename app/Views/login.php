<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Login </title>
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
                                                <h2> User Login </h2>
                                            </span>
                                        </a>
                                        <a href="<?php echo site_url(''); ?>" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="<?php echo site_url('assets/img/logo.png'); ?>" alt="" height="45" style="width: 90%;">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Enter your Email Id to Proceed for login Process.</p>
                                </div>
                                <form id="login-form">
                                    <div class="mb-3">
                                        <label for="email_id" class="form-label">Email * </label>
                                        <input class="form-control email_id" type="email" id="email_id" name="email_id" required="" placeholder="Enter your Email Id">
                                    </div>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary login-btn" type="button"> Log In </button>
                                    </div>
                                </form>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-12 text-center">
                        <p class="text-white-50">Don't have an account? <a href="<?php echo site_url('/register') ?>" class="text-white ms-1"><b>Sign Up</b></a></p>
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
                $(document).find("title").text("User Login ");
                
                $(document).find('.login-btn').on('click', function(e){
                    e.preventDefault();
                    var email_id = $(document).find("#email_id").val();
                    if(email_id=="")
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Required...",
                            text: "Email Id is required!"
                        });
                    }
                    else
                    {
                        $.ajax({
                            url:  '<?php echo site_url('user/loginath');?>',
                            method: "POST",
                            data: {
                                email_id : email_id
                            },
                            dataType: 'json',
                            success:function(response)
                            {
                                // var res = JSON.parse(response);
                                
                                if(response['status'] == 1)
                                {
                                    Swal.fire({
                                        icon: "success",
                                        title: "User verified!",
                                        text: response['message']
                                    });
                                    setTimeout(function () {
                                        window.location.href = "<?php echo base_url('user/qrcodescan'); ?>";
                                    }, 1000);
                                    
                                }
                                else if(response['status'] == 2 || response['status'] == 3)
                                {
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: response['message']
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