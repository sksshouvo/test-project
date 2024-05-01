<?php

namespace App\Interface\User;
use App\Models\User;

class UserService implements UserInterface {

    public function __construct(private readonly User $user) {
        
    }

    public function getAll() : mixed {
        return $this->user->get();
    }
}