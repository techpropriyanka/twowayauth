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
                                    <video id="preview" style="width:100%; height:200px; margin-top:15px;"></video>
                                    <div class="text-center d-grid">
                                        <button class="btn btn-primary scan-btn" type="button"> Start Scanning </button>
                                    </div>
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
        <script src="<?php echo site_url('asset/js/instascan.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.all.min.js'); ?>"></script>

        <script type="text/javascript">
        $(document).ready(function () {
            $(document).find("title").text("Scan QR Code");
                
            $(document).find('.scan-btn').on('click', function(e){
                e.preventDefault();
                
                var scanner = new Instascan.Scanner({ video: document.getElementById('preview'), scanPeriod: 5, mirror: false });
                scanner.addListener('scan',function(content){
                    var scan_content = content; 
                    // alert(scan_content);
                    if(scan_content=="")
                    {
                        Swal.fire({
                            icon: "error",
                            title: "Required...",
                            text: "Scan Qr code is required is required!"
                        });
                    }
                    else
                    {
                    
                        $.ajax({
                            url:  '<?php echo site_url('user/qrcodescannerath');?>',
                            method: "POST",
                            data: {
                                scan_content : scan_content
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
                                        window.location.reload();
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
                Instascan.Camera.getCameras().then(function (cameras){
                    if(cameras.length>0){
                        scanner.start(cameras[0]);
                        $('[name="options"]').on('change',function(){
                            if($(this).val()==1){
                                if(cameras[0]!=""){
                                    scanner.start(cameras[0]);
                                }else{
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "No Front Camera Found"
                                    });
                                }
                            }else if($(this).val()==2){
                                if(cameras[1]!=""){
                                    scanner.start(cameras[1]);
                                }else{
                                    Swal.fire({
                                        icon: "error",
                                        title: "Oops...",
                                        text: "No Back Camera Found"
                                    });
                                }
                            }
                        });
                    }else{
                        Swal.fire({
                            icon: "error",
                            title: "Oops...",
                            text: "No Camera Found"
                        });
                    }
                });
            });
                
            });
        </script>
    </body>
</html>