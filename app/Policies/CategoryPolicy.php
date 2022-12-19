<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

# php artisan make:policy CategoryPolicy
# add policy in AuthServiceProvider.php
class CategoryPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Category $category)
    {
        return $user->id === $category->user_id
        ? Response::allow()
        : Response::deny();
    }
}
