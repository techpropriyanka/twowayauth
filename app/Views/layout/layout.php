<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <title>User Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <link rel="shortcut icon" href="<?php echo site_url('asset/images/sm-logo.png'); ?>">
        <link href="<?php echo site_url('asset/libs/flatpickr/flatpickr.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/selectize/css/selectize.bootstrap3.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/css/config/default/bootstrap.min.css'); ?>" rel="stylesheet" type="text/css" id="bs-default-stylesheet" />
        <link href="<?php echo site_url('asset/css/config/default/app.min.css'); ?>" rel="stylesheet" type="text/css" id="app-default-stylesheet" />
        <link href="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/css/config/default/bootstrap-dark.min.css'); ?>" rel="stylesheet" type="text/css" id="bs-dark-stylesheet" />
        <link href="<?php echo site_url('asset/css/config/default/app-dark.min.css'); ?>" rel="stylesheet" type="text/css" id="app-dark-stylesheet" />
        <link href="<?php echo site_url('asset/css/icons.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/datatables.net-select-bs5/css/select.bootstrap5.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/select2/css/select2.min.css'); ?>" rel="stylesheet" type="text/css" />
        <link href="<?php echo site_url('asset/libs/multiselect/css/multi-select.css'); ?>" rel="stylesheet" type="text/css" />
        <script src="<?php echo site_url('asset/js/jquery.min.js'); ?>"></script>
        <link href="<?php echo site_url('asset/libs/dropzone/min/dropzone.min.css'); ?>" rel="stylesheet" type="text/css">
        <link href="<?php echo site_url('assets/libs/dropify/css/dropify.min.css" rel="stylesheet" type="text/css'); ?>">
        <style type="text/css">
            .container {
              padding: 50px 10%;
            }

            .box {
              position: relative;
              background: #ffffff;
              width: 100%;
            }

            .box-header {
              color: #444;
              display: block;
              padding: 10px;
              position: relative;
              border-bottom: 1px solid #f4f4f4;
              margin-bottom: 10px;
            }

            .box-tools {
              position: absolute;
              right: 10px;
              top: 5px;
            }

            .dropzone-wrapper {
              border: 2px dashed #91b0b3;
              color: #92b0b3;
              position: relative;
              height: 150px;
            }

            .dropzone-desc {
              position: absolute;
              margin: 0 auto;
              left: 0;
              right: 0;
              text-align: center;
              width: 40%;
              top: 50px;
              font-size: 16px;
            }

            .dropzone,
            .dropzone:focus {
              position: absolute;
              outline: none !important;
              width: 100%;
              height: 150px;
              cursor: pointer;
              opacity: 0;
            }

            .dropzone-wrapper:hover,
            .dropzone-wrapper.dragover {
              background: #ecf0f5;
            }

            .preview-zone {
              text-align: center;
            }

            .preview-zone .box {
              box-shadow: none;
              border-radius: 0;
              margin-bottom: 0;
            }
            .hidden{
                display: none;
            }

            input[type="file"] 
            {
                display: block;
            }            

            .imageThumb {
  max-height: 75px;
  border: 2px solid;
  padding: 1px;
  cursor: pointer;
  height: 200px; 
  width: 100px;
}
.pip {
  display: inline-block;
  margin: 10px 10px 0 0;


}
.remove {
  display: block;
  background: #444;
  border: 1px solid black;
  color: white;
  text-align: center;
  cursor: pointer;
}
.remove:hover {
  background: white;
  color: black;
}


        </style>
        
    </head>
    <body class="loading" data-layout='{"mode": "light", "width": "fluid", "menuPosition": "fixed", "sidebar": { "color": "light", "size": "default", "showuser": false}, "topbar": {"color": "dark"}, "showRightSidebarOnPageLoad": true}'>
        <div id="wrapper">
            <div class="navbar-custom">
                <div class="container-fluid">
                    <ul class="list-unstyled topnav-menu float-end mb-0">
                        <li class="dropdown d-none d-lg-inline-block">
                            <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen" href="#">
                                <i class="fe-maximize noti-icon"></i>
                            </a>
                        </li>
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <?php if($user_details['profile_photo']== TRUE){?>
                                       <img src="<?php echo base_url($user_details['profile_photo'])?>" alt="" class="rounded-circle">
                                <?php } else { ?>
                                        <img src="<?php echo site_url('/asset/images/profile.png'); ?>" alt="user-image" class="rounded-circle">
                                <?php }?>
                               
                                <span class="pro-user-name ms-1">
                                    <?php echo $user_details['first_name']?> <?php echo $user_details['last_name']?> <i class="mdi mdi-chevron-down"></i> 
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>
                                <a href="<?php echo site_url('user/dashboard') ?>" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>Profile</span>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a href="<?php echo site_url('user/logout'); ?>" class="dropdown-item notify-item">
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <div class="logo-box">
                        <a href="<?php echo site_url('user/dashboard'); ?>" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <h4 style="color: white; padding-top: 10px;">Exercise</h4>
                            </span>
                            <span class="logo-lg">
                              <h2 style="color: white; padding-top: 10px;">Exercise</h2>
                            </span>
                        </a>
                        <a href="<?php echo site_url('user/dashboard'); ?>" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <h4 style="color: white; padding-top: 10px;">Exercise</h4>
                            </span>
                            <span class="logo-lg">
                              <h2 style="color: white; padding-top: 10px;">Exercise</h2>
                            </span>
                        </a>
                    </div>
                    <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
                        <li>
                            <button class="button-menu-mobile waves-effect waves-light">
                                <i class="fe-menu"></i>
                            </button>
                        </li>
                        <li>
                            <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                                <div class="lines">
                                    <span></span>
                                    <span></span>
                                    <span></span>
                                </div>
                            </a>
                        </li> 
                    </ul>
                    <div class="clearfix"></div>
                </div>
            </div>
            <div class="left-side-menu">
                <div class="h-100" data-simplebar>
                    <div class="user-box text-center">
                        <img src="<?php echo site_url('/asset/images/profile.png'); ?>" alt="user-img" title="Mat Helme"
                            class="rounded-circle avatar-md">
                        <div class="dropdown">
                            <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                                data-bs-toggle="dropdown">Geneva Kennedy</a>
                            <div class="dropdown-menu user-pro-dropdown">
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-user me-1"></i>
                                    <span>My Account</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-settings me-1"></i>
                                    <span>Settings</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-lock me-1"></i>
                                    <span>Lock Screen</span>
                                </a>
                                <a href="javascript:void(0);" class="dropdown-item notify-item">
                                    <i class="fe-log-out me-1"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </div>
                        <p class="text-muted">User Head</p>
                    </div>
                    <div id="sidebar-menu">
                        <ul id="side-menu">
                            <li>
                                <a href="<?php echo site_url('user/dashboard'); ?>">
                                    <i class="mdi mdi-home"></i>
                                    <span>Home</span>
                                </a>
                            </li>
                            
                            <li>
                                <a href="<?php echo site_url('user/user-list'); ?>">
                                    <i class="mdi mdi-video-check-outline"></i>
                                    <span>All Users</span>
                                </a>
                            </li>
                            
                        </ul>
                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?= $this->renderSection('page_content')?>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->
        </div>
        <script src="<?php echo site_url('asset/js/vendor.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/flatpickr/flatpickr.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/selectize/js/standalone/selectize.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/app.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/sweetalert2/sweetalert2.all.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net/js/jquery.dataTables.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-responsive/js/dataTables.responsive.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-buttons/js/dataTables.buttons.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-buttons/js/buttons.html5.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-buttons/js/buttons.flash.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-buttons/js/buttons.print.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-keytable/js/dataTables.keyTable.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/datatables.net-select/js/dataTables.select.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/multiselect/js/jquery.multi-select.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/select2/js/select2.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/dropify/js/dropify.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/libs/dropzone/min/dropzone.min.js'); ?>"></script>
        <script src="<?php echo site_url('asset/js/pages/form-fileuploads.init.js'); ?>"></script>
        
    </body>
</html>