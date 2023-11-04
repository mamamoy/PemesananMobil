<?php

namespace App\Policies;

use App\Models\Drivers;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class DriversPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Drivers $drivers)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Drivers $drivers)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Drivers $drivers)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Drivers $drivers)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Drivers  $drivers
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Drivers $drivers)
    {
        //
    }
}
