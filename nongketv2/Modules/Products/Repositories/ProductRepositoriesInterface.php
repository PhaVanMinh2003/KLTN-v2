<?php
namespace Modules\Products\Repositories;

interface ProductRepositoriesInterface
{
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);

}
