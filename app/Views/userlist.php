<?= $this->extend('layout/layout'); ?>
<?= $this->section('page_content'); ?>

<div class="content-page">
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item">Dashboard</li>
                                <li class="breadcrumb-item">User</li>
                                <li class="breadcrumb-item active">Users List</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Users List</h4>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="table-responsive">
                                    <table id="users-list" class="table table-bordered w-100">
                                        <thead class="bg-light">
                                            <tr>
                                                <th width="50px">SL</th>
                                                <th>Profile Photo</th>
                                                <th>First Name</th>
                                                <th>Last Name</th>
                                                <th>Email ID</th>
                                            </tr>
                                        </thead>                                
                                        <tbody>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> 
    </div>
</div>


<script>
    $(document).ready(function() 
    {    
        $(document).find("title").text("Users List");

        user_list();

    function user_list()
    {
        $("#users-list").DataTable({
        dom: 'Bfrtip',
        buttons: [
            'csv'
        ],
        language:
        {
            paginate:
            {
                previous:"<i class='mdi mdi-chevron-left'>",next:"<i class='mdi mdi-chevron-right'>"
            }
        },
        drawCallback:function()
        {
            $(".dataTables_paginate > .pagination").addClass("pagination-rounded")
        },
        processing: true,
        ajax: {
            url: '<?php echo site_url('user/userlist');?>',
            type: "POST",
            data :
            {
                
            },
        },
        "columns": [
            { "data": "sl" },
            { "data": "profile_photo" },
            { "data": "first_name" },
            { "data": "last_name" },
            { "data": "email_id" }
        ],
        bSortable: true,
        });
    }
    });
</script>


<?= $this->endSection(); ?>