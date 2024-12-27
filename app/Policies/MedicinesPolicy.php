<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Medicines;
use Illuminate\Auth\Access\HandlesAuthorization;

class MedicinesPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_medicines');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Medicines $medicines): bool
    {
        return $user->can('view_medicines');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_medicines');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Medicines $medicines): bool
    {
        return $user->can('update_medicines');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Medicines $medicines): bool
    {
        return $user->can('delete_medicines');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_medicines');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Medicines $medicines): bool
    {
        return $user->can('force_delete_medicines');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_medicines');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Medicines $medicines): bool
    {
        return $user->can('restore_medicines');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_medicines');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Medicines $medicines): bool
    {
        return $user->can('replicate_medicines');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_medicines');
    }
}
