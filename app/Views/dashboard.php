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
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                        <h4 class="page-title">Update Profile</h4>
                    </div>
                </div>
            </div> 
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8">
                    <div class="card">
                        <div class="card-body">
                            <form id="profile-form">
                            <div class="row">
                                <div class="col-6 mb-2">
                                    <label>First Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control name" name="first_name" value="<?php echo $user_details['first_name']; ?>">
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Last Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control last_name" name="last_name" value="<?php echo $user_details['last_name']; ?>">
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control email_id" value="<?php echo $user_details['email_id']; ?>" disabled>
                                </div>
                                <div class="col-6 mb-2">
                                    <label>Profile Photo</label>
                                    <input type="file" class="form-control profile_photo" name="profile_photo" value="<?php echo $user_details['profile_photo']; ?>">
                                </div>
                                <div class="col-3 mx-auto">
                                    <button class="btn btn-primary w-100">Save Changes</button>
                                </div>
                            </div>
                            </form>
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
        $(document).find("title").text("User Profile");

        $(document).find('#profile-form').on('submit', function(e){
            e.preventDefault();
            var first_name = $(document).find(".first_name").val();
            var last_name = $(document).find(".last_name").val();
            if (first_name == "") 
            {
                Swal.fire({
                    icon: "error",
                    title: "Warning",
                    text: "First Name is required!"
                });
            } 
            else if (last_name == "") 
            {
                Swal.fire({
                    icon: "error",
                    title: "Warning",
                    text: "Last Name is required!"
                });
            } 
            else
            {   
                var formData = new FormData(this);
                $.ajax(
                    {
                    method: "POST", 
                    url: "<?php echo site_url('/user/profile/update') ?>",
                    data: formData,
                    contentType:false,
                    cache:false,
                    processData:false,
                    dataType: 'json',
                    success:function (response)
                    {
                        if(response['status'] == "1")
                        { 
                           Swal.fire({
                                icon: "success",
                                title: "Profile Udpated",
                                text: response['message']
                            });
                            window.location.reload();
                        }
                        else if(response['status'] == "2")
                        {
                            Swal.fire({
                                icon: "error",
                                title: "Warning",
                                text: response['message']
                            });
                        }
                    }
                });
            }
        });
    });
</script>


<?= $this->endSection(); ?>