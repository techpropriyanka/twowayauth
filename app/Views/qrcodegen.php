<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>Scan QR </title>
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
                                                <h2> Scan QR </h2>
                                            </span>
                                        </a>
                                        <a href="<?php echo site_url(''); ?>" class="logo logo-light text-center">
                                            <span class="logo-lg">
                                                <img src="<?php echo site_url('assets/img/logo.png'); ?>" alt="" height="45" style="width: 90%;">
                                            </span>
                                        </a>
                                    </div>
                                    <p class="text-muted mb-4 mt-3">Scan QR Code To Complete the login process.</p>
                                </div>
                                    <div class="mb-3">
                                        <input class="form-control token" type="hidden" id="token" name="token" value="<?php echo $token; ?>">
                                    </div>
                                    <div id="qrcode" style="width:100%; height:200px; margin-top:15px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
                
            </div>
        </div>
        <footer class="footer footer-alt">
            2020 - <script>document.write(new Date().getFullYear())</script> &copy; All rights reserved  
        </footer>
        <script src="<?php echo site_url('asset/js/vendor.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/app.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/qrcode.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

        <script type="text/javascript">
            $(document).ready(function () {
                $(document).find("title").text("Scan QR Code");
                
                var qrcode = new QRCode(document.getElementById("qrcode"), {
                    width : 200,
                    height : 200
                });

                function makeCode () {      
                    var elText = document.getElementById("token");
                    
                    if (!elText.value) {
                        alert("Input a text");
                        elText.focus();
                        return;
                    }
                    
                    qrcode.makeCode(elText.value);
                }

                makeCode();

                $("#token").
                    on("blur", function () {
                        makeCode();
                    }).
                    on("keydown", function (e) {
                        if (e.keyCode == 13) {
                            makeCode();
                        }
                    });

                 setInterval(myFunction, 1000);
                 function myFunction()
                 {
                    callAjax();
                 }
                function callAjax() {
                    $.ajax({
                            url:  '<?php echo site_url('user/qrcodegenath');?>',
                            method: "POST",
                            data: {
                                // email_id : email_id
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
                                        window.location.href = "<?php echo base_url('user/dashboard'); ?>";
                                    }, 5000);
                                    
                                }
                                
                                 
                            }
                        });
                    }



            });
        </script>
    </body>
</html>