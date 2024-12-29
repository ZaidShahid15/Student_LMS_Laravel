<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class roles_permission extends Model
{
    use HasFactory;
    protected $fillable = ['role_id','permission_id'];
    static public function InsertUpdateRecored($permission_ids,$role_id){
        roles_permission::where('role_id',$role_id)->delete();
        foreach($permission_ids as $permission_id){
            $save =  new roles_permission();
            $save->permission_id = $permission_id;
            $save->role_id = $role_id;
            $save->save();
        }
    }



    static  function getPermission($slug, $role_id) {
        return roles_permission::select('roles_permissions.id')
            ->join('permissions', 'permissions.id', '=', 'roles_permissions.permission_id')
            ->where('roles_permissions.role_id', '=', $role_id)
            ->where('permissions.slug', $slug)
            ->count();
    }

}
