<?php

namespace App\Policies;

use App\Models\Category;
use App\Models\Task;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

# php artisan make:policy TaskPolicy
# add policy in AuthServiceProvider.php
class TaskPolicy
{
    use HandlesAuthorization;

    public function manage(User $user, Task $task)
    {
        return $user->id === $task->category->user_id
        ? Response::allow()
        : Response::deny();
    }
}

# How use TaskPolicy
#
# In controller method use
#   if (Gate::inspect('manage', $task)->allowed() === false) {
#       return $this->unauthorized();
#   }
#
# More in docs
