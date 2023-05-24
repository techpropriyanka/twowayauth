<?php 
namespace App\Models;
use CodeIgniter\Model;

class UserModel extends Model
{
    protected $table = "user";
    protected $allowedFields = [
        'first_name', 
        'last_name',
        'email_id',
        'profile_photo',
        'auth_token',
        'is_active',
        'created_at',
        'modified_at'
                                
    ];
}
