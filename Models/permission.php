<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class permission extends Model
{
    use HasFactory;

    static function getpermission(){
        $permission  = permission::groupBy('groupby')->get();
        $result = array();
        foreach($permission as $key){
            $getAllpermission = permission::getAllpermission($key->groupby);
            $data = array();
            $data['id'] = $key->id;
            $data['name'] = $key->name;
            $group = array();
            foreach($getAllpermission as $groupkey){
                $permissiondata = array();
                $permissiondata['id'] = $groupkey->id;
                $permissiondata['name'] = $groupkey->name;
                $group[] = $permissiondata;
            }
            $data['group'] = $group;
            $result[] = $data;
        }
        return $result;
    }


    static function getAllpermission($id){
        return permission::where('groupby',$id)->get();
    }
}
