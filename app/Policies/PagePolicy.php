<?php


namespace App\Policies;

use App\Models\Page;
use App\Models\User;

class PagePolicy
{
    public function viewAny(User $user): bool
    {
        return $user->can('view pages');
    }

    public function create(User $user): bool
    {
        return $user->can('create pages');
    }

    public function update(User $user, Page $page): bool
    {
        return $user->can('edit pages');
    }

    public function delete(User $user, Page $page): bool
    {
        return $user->can('delete pages');
    }
}

// namespace App\Policies;

// use App\Models\Page;
// use App\Models\User;
// use Illuminate\Auth\Access\Response;

// class PagePolicy
// {
//     /**
//      * Determine whether the user can view any models.
//      */
//     public function viewAny(User $user): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can view the model.
//      */
//     public function view(User $user, Page $page): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can create models.
//      */
//     public function create(User $user): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can update the model.
//      */
//     public function update(User $user, Page $page): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can delete the model.
//      */
//     public function delete(User $user, Page $page): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can restore the model.
//      */
//     public function restore(User $user, Page $page): bool
//     {
//         return false;
//     }

//     /**
//      * Determine whether the user can permanently delete the model.
//      */
//     public function forceDelete(User $user, Page $page): bool
//     {
//         return false;
//     }
// }
