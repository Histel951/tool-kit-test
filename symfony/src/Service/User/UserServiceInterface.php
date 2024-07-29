<?php

namespace App\Service\User;

use App\Entity\User;

interface UserServiceInterface {
    public function processRegistration(User $user): void;
}