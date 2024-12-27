<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Orders;
use Illuminate\Auth\Access\HandlesAuthorization;

class OrdersPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return $user->can('view_any_orders');
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Orders $orders): bool
    {
        return $user->can('view_orders');
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return $user->can('create_orders');
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Orders $orders): bool
    {
        return $user->can('update_orders');
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Orders $orders): bool
    {
        return $user->can('delete_orders');
    }

    /**
     * Determine whether the user can bulk delete.
     */
    public function deleteAny(User $user): bool
    {
        return $user->can('delete_any_orders');
    }

    /**
     * Determine whether the user can permanently delete.
     */
    public function forceDelete(User $user, Orders $orders): bool
    {
        return $user->can('force_delete_orders');
    }

    /**
     * Determine whether the user can permanently bulk delete.
     */
    public function forceDeleteAny(User $user): bool
    {
        return $user->can('force_delete_any_orders');
    }

    /**
     * Determine whether the user can restore.
     */
    public function restore(User $user, Orders $orders): bool
    {
        return $user->can('restore_orders');
    }

    /**
     * Determine whether the user can bulk restore.
     */
    public function restoreAny(User $user): bool
    {
        return $user->can('restore_any_orders');
    }

    /**
     * Determine whether the user can replicate.
     */
    public function replicate(User $user, Orders $orders): bool
    {
        return $user->can('replicate_orders');
    }

    /**
     * Determine whether the user can reorder.
     */
    public function reorder(User $user): bool
    {
        return $user->can('reorder_orders');
    }
}
