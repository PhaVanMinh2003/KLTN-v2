<?php
namespace Modules\User\Repositories;
use App\Models\User;
interface IUserRepository
{
    public function create(array $data);
    public function findByEmail(string $email);
}
