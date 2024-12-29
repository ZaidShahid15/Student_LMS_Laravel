<?php

namespace App\Policies;

use App\Models\User;
use App\Models\auther;
use App\Models\roles_permission;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class PolicyAuther
{
    /**
     * Determine whether the user can view any models.
     */
    // public function AuthView()
    // {
    //     $data =  roles_permission::getPermission('Author', Auth::user()->role_id);
    //     return $data;
    // }

    /**
     * Determine whether the user can view the model.
     */
    public function view()
    {
        //
    }

    /**
     * Determine whether the user can create models.
     */
    public function create()
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update()
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete()
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore()
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete()
    {
        //
    }
}
