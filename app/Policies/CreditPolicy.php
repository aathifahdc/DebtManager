<?php

namespace App\Policies;

use App\Models\Credit;
use App\Models\User;

class CreditPolicy
{
    public function update(User $user, Credit $credit): bool
    {
        return $user->id === $credit->user_id;
    }

    public function delete(User $user, Credit $credit): bool
    {
        return $user->id === $credit->user_id;
    }
}
