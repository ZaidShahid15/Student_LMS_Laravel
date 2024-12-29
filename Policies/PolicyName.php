<?php

namespace App\Policies;

use App\Models\User;
use App\Models\permission;
use App\Models\roles_permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PolicyName
{
    /**
     * Determine whether the user can view any models.
     */

    public function category()
    {
        $data =  roles_permission::getPermission('categori', Auth::user()->role_id);
        return $data;
    }

    /**
     * Determine whether the user can view the model.
     */

    public function add()
    {
        $data =  roles_permission::getPermission('Add categori', Auth::user()->role_id);
        return $data;
    }

    public function edit()
    {
        $data =  roles_permission::getPermission('Edit categori', Auth::user()->role_id);
        return $data;
    }

    public function delete()
    {
        $data =  roles_permission::getPermission('Delete categori', Auth::user()->role_id);
        return $data;
    }

    // Auth

    public function AuthView()
    {
        $data =  roles_permission::getPermission('Author', Auth::user()->role_id);
        return $data;
    }

    public function AuthAdd()
    {
        $data =  roles_permission::getPermission('add Author', Auth::user()->role_id);
        return $data;
    }

    public function AuthEdit()
    {
        $data =  roles_permission::getPermission('edit Author', Auth::user()->role_id);
        return $data;
    }

    public function AuthDelete()
    {
        $data =  roles_permission::getPermission('delete Author', Auth::user()->role_id);
        return $data;
    }

    // Book

    public function BookView()
    {
        $data =  roles_permission::getPermission('book', Auth::user()->role_id);
        return $data;
    }

    public function BookAdd()
    {
        $data =  roles_permission::getPermission('Add book', Auth::user()->role_id);
        return $data;
    }

    public function BookEdit()
    {
        $data =  roles_permission::getPermission('edit book', Auth::user()->role_id);
        return $data;
    }

    public function BookDelete()
    {
        $data =  roles_permission::getPermission('delete book', Auth::user()->role_id);
        return $data;
    }

    // book issued

    public function IssuedBookview()
    {
        $data =  roles_permission::getPermission('bookIssue', Auth::user()->role_id);
        return $data;
    }


    public function IssuedBookAdd()
    {
        $data =  roles_permission::getPermission('add bookIssue', Auth::user()->role_id);
        return $data;
    }

    public function IssuedBookEdit()
    {
        $data =  roles_permission::getPermission('edit bookIssue', Auth::user()->role_id);
        return $data;
    }

    public function IssuedBookDelete()
    {
        $data =  roles_permission::getPermission('delete bookIssue', Auth::user()->role_id);
        return $data;
    }

    // Roles permission

    public function Rolesview()
    {
        $data =  roles_permission::getPermission('role', Auth::user()->role_id);
        return $data;
    }

    public function RolesAdd()
    {
        $data =  roles_permission::getPermission('add role', Auth::user()->role_id);
        return $data;
    }

    public function RolesEdit()
    {
        $data =  roles_permission::getPermission('edit role', Auth::user()->role_id);
        return $data;
    }

    public function RolesDelete()
    {
        $data =  roles_permission::getPermission('delete role', Auth::user()->role_id);
        return $data;
    }

    // student


    public function StudentView()
    {
        $data =  roles_permission::getPermission('Student', Auth::user()->role_id);
        return $data;
    }

    public function StudentAdd()
    {
        $data =  roles_permission::getPermission('add Student', Auth::user()->role_id);
        return $data;
    }

    public function StudentEdit()
    {
        $data =  roles_permission::getPermission('edit Student', Auth::user()->role_id);
        return $data;
    }

    public function StudentDelete()
    {
        $data =  roles_permission::getPermission('delete Student', Auth::user()->role_id);
        return $data;
    }


    public function RequestView()
    {
        $data =  roles_permission::getPermission('request', Auth::user()->role_id);
        return $data;
    }

    public function dashboardView()
    {
        $data =  roles_permission::getPermission('dashboard', Auth::user()->role_id);
        return $data;
    }




   }
