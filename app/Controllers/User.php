<?php
namespace App\Controllers;
use App\Models\UserModel;
use App\Controllers\BaseController;

class User extends BaseController
{
    public function __construct()
	{
        $this->user = new UserModel();
    }
    
    public function index()
    {
        if(session()->get('isLoggedIn'))
        {
            return redirect("user/dashboard");
        }
        else
        {
            return view('login');
        }
    }

    public function register()
    {
        return view('register');
    }

    public function registerath()
    {
        $data['first_name'] = $this->request->getVar('first_name');
        $data['last_name'] = $this->request->getVar('last_name');
        $data['email_id'] = $this->request->getVar('email_id');
        $emailexist = $this->user->where("email_id", $data['email_id'])->first();
        if($emailexist)
        {
            echo json_encode(array(
                "status" => 2,
                "message" => "Email already exist! Use another Email Id!"
            ));
        }
        else
        {
            $profile_photo = $this->request->getFile("profile_photo");
            if($profile_photo->isValid() && !$profile_photo->hasMoved())
            {
                $name = $profile_photo->getName();
                $ext = $profile_photo->getClientExtension();
                $newName = $profile_photo->getRandomName();
                $profile_photo->move('public/uploads/user/', $newName);
                $data['profile_photo'] = "public/uploads/user/".$newName;
            }
            $data['created_at'] = date('Y-m-d H:i:s');
            $data['modified_at'] = date('Y-m-d H:i:s');
            // echo "<pre>"; print_r($data); die();
            $inserted = $this->user->insert($data);
            if($inserted)
            {
                echo json_encode(array(
                    "status" => 1,
                    "message" => "New User Registered successfully!"
                ));
            }
            else
            {
                echo json_encode(array(
                    "status" => 2,
                    "message" => "Unable to Register User! Try again later!"
                ));
            }
        }
    }

    // public function loginath()
    // {
    //     $email_id = $this->request->getVar('email_id');
    //     if(isset($email_id) && $email_id != NULL)
    //     {
    //         $data = $this->user->where('email_id', $email_id)->first();
    //         if($data)
    //         {
    //                 $session = session();
    //                 $ses_data = [
    //                     'id' => $data['id'],
    //                     'first_name' => $data['first_name'],
    //                     'last_name' => $data['last_name'],
    //                     'email_id' => $data['email_id'],
    //                     'profile_photo' => $data['profile_photo'],
    //                     'isLoggedIn' => TRUE
    //                 ];
    //                 $session->set($ses_data);
    //                 echo json_encode(array(
    //                     "status" => 1,
    //                     "message" => "Correct Email Id! Be ready to Scan QR Code!"
    //                 ));   
                
    //         }
    //         else
    //         {
    //             echo json_encode(array(
    //                 "status" => 2,
    //                 "message" => "You have entered Incorrect Email Id!"
    //             ));
    //         }
    //     }
    //     else
    //     {
    //         echo json_encode(array(
    //             "status" => 3,
    //             "message" => "Something went wrong! Try again later"
    //         ));
    //     }
    // }

    public function loginath()
    {
        $email_id = $this->request->getVar('email_id');
        $token = rand(1000000, 9999999);
        $auth_token = $email_id."|".$token;
        if(isset($email_id) && $email_id != NULL)
        {
            $data = $this->user->where('email_id', $email_id)->first();
            if($data)
            {
                $id = $data['id'];
                $update_data['auth_token'] = $auth_token;
                $update_data['is_active'] = "0"; 
                $data_updated = $this->user->update($id,$update_data);
                if(session()->get('istokengenerated'))
                {
                    session()->destroy();
                }
                    $session = session();
                    $ses_data = [
                        'token' => $auth_token,
                        'email_id' => $email_id,
                        'istokengenerated' => TRUE
                    ];
                    $session->set($ses_data);
                    // echo "<pre>"; print_r($ses_data); die();
        
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "Correct Email Id! Be ready to Scan QR Code!"
                    ));   
                
            }
            else
            {
                echo json_encode(array(
                    "status" => 2,
                    "message" => "You have entered Incorrect Email Id!"
                ));
            }
        }
        else
        {
            echo json_encode(array(
                "status" => 3,
                "message" => "Something went wrong! Try again later"
            ));
        }
    }

    public function qrcodegen()
    {
        $istokengenerated = session()->get('istokengenerated');
        if(isset($istokengenerated) && $istokengenerated!="")
        {
            $data['token'] = session()->get('token');
            // echo "<pre>"; print_r($token); die();
            return view('/qrcodegen', $data);
        }
        else
        {
        return redirect('/');
        }
        
    }

    public function qrcodescanner()
    {
        return view('qrcodescanner');
    }

    public function qrcodescannerath()
    {
        $scan_content = $this->request->getVar('scan_content');
        $email_id = session()->get('email_id');
        if(isset($email_id) && $email_id != NULL && isset($scan_content) && $scan_content != NULL)
        {
            $data = $this->user->where('email_id', $email_id)->where('auth_token', $scan_content)->where('is_active', 0)->first();
            // echo "<pre>"; print_r($data); die();
            if($data)
            {
                    $id = $data['id'];
                    $update_data['is_active'] = "1"; 
                    $data_updated = $this->user->update($id,$update_data);
                    
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "QR Code Scanned successfully!"
                    ));   
                
            }
            else
            {
                echo json_encode(array(
                    "status" => 2,
                    "message" => "You Have Scanned Wrong QR Code!"
                ));
            }
        }
        else
        {
            echo json_encode(array(
                "status" => 3,
                "message" => "Something went wrong! Try again later"
            ));
        }
           
    }

    public function qrcodegenath()
    {
        $email_id = session()->get('email_id');
        // echo "<pre>"; print_r($email_id); die();
        if(isset($email_id) && $email_id != NULL)
        {

            $data = $this->user->where('email_id', $email_id)->where('is_active', 1)->first();
            // echo "<Pre>"; print_r($data); die();
            if($data)
            {

                    $id = $data['id'];
                    $update_data['is_active'] = "0"; 
                    $data_updated = $this->user->update($id,$update_data);
                    
                    // if(session()->get('istokengenerated'))
                    // {
                    //     session()->destroy();
                    // }
                   // echo "test"; die();
                    $session = session();
                    $ses_data = [
                        'id' => $data['id'],
                        'first_name' => $data['first_name'],
                        'last_name' => $data['last_name'],
                        'email_id' => $data['email_id'],
                        'profile_photo' => $data['profile_photo'],
                        'isLoggedIn' => TRUE
                    ];
                    $session->set($ses_data);
                    // echo "test session";
                   // echo "<pre>"; print_r($ses_data); die();
                    
                    echo json_encode(array(
                        "status" => 1,
                        "message" => "Welcome to the dashboard!"
                    ));   
            }
            
        }
        else
        {
            echo json_encode(array(
                "status" => 3,
                "message" => "Something went wrong! Try again later"
            ));
        }
           
    }

    public function dashboard()
    {   
        // echo "test"; die();
        $user_id = session()->get('id');
        $user_details = $this->user->where('id',$user_id)->first();
        $data['user_details'] = $user_details;
        // echo "<pre>"; print_r($data); die();
        
        return view('dashboard', $data);
    }

    public function updateprofileath()
    {
        $id= session()->get('id');
        $data['first_name'] = $this->request->getVar('first_name');
        $data['last_name'] = $this->request->getVar('last_name');
        $data['modified_at'] = date('Y-m-d H:i:s');
        $thumbnail = $this->request->getFile('profile_photo');
        if ($thumbnail->isValid() && !$thumbnail->hasMoved()) 
        {
          $name = $thumbnail->getName();
            $ext = $thumbnail->getClientExtension();
            $newName = $thumbnail->getRandomName(); 
            $thumbnail->move('public/uploads/user/', $newName);
            $data['profile_photo'] = "public/uploads/user/".$newName;
        }
        $updated = $this->user->update($id,$data);
        if($updated)
        {
            echo json_encode(array(
            "status" => 1,
            "message" => "Profile updated successfully!"
            ));
        }
        else
        {
            echo json_encode(array(
            "status" => 2,
            "message" => "Unable to update Profile!"
            ));
        }
    }
    
    public function userlist()
    {   
        $user_id = session()->get('id');
        $user_details = $this->user->where('id',$user_id)->first();
        $data['user_details'] = $user_details;
        // echo "<pre>"; print_r($data); die();
        
        return view('userlist', $data);
    }

    public function userlistath()
    {
        $params['draw'] = $this->request->getVar('draw');
        $start = $this->request->getVar('start');
        $length = $this->request->getVar('length');
        $user_data = $this->user->orderBy('id', 'DESC')->findAll();
        // echo "<pre>"; print_r($user_data); die();
        $user_data_arr = [];
        $count = 1;
        foreach($user_data as $data)
        {
            $user['sl'] = $count++.".";
            $user['profile_photo'] = "<img src='".site_url($data['profile_photo'])."' width='80px' height='80px' style='border-radius: 50%;'>";
            if($data['profile_photo'] == "")
            {
                $user['profile_photo'] = "<img src='".site_url('public/uploads/user/profile.png')."' alt='avatar' width='80px' height='80px' style='border-radius: 50%;'>";   
            }
            $user['first_name'] = $data['first_name'];
            $user['last_name'] = $data['last_name'];
            $user['email_id'] = $data['email_id'];
            array_push($user_data_arr, $user);
        }
        $json_data = array(
            "draw" => intval($params['draw']),
            "recordsTotal" => count($user_data_arr),
            "recordsFiltered" => count($user_data_arr),
            "data" => $user_data_arr   // total data array
        );
        echo json_encode($json_data);
    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to('/');
    }

    
}
