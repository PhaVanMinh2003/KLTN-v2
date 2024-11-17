<?php

namespace Modules\User\Services;
use Illuminate\Http\Request;
interface IAuthService
{
    public function register(array $data);
    public function login(array $credentials);
    public function logout();
    public function sendResetPasswordEmail(string $email);
}
