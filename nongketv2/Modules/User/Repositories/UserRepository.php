<?php
namespace Modules\User\Repositories;
use App\Models\User;
class UserRepository implements IUserRepository
{
    public function create(array $data){
        return User::create($data);
    }
    public function findByEmail(string $email)
    {
        return User::where('email', $email)->first();
    }
}
