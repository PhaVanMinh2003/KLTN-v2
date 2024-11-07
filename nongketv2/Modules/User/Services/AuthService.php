<?php

namespace Modules\User\Services;

use Modules\User\Repositories\IUserRepository;

class AuthService implements IAuthService
{
    protected $userRepository;

    public function __construct(IUserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function register(array $data)
    {
        $data['password'] = bcrypt($data['password']);
        return $this->userRepository->create($data);
    }
}
