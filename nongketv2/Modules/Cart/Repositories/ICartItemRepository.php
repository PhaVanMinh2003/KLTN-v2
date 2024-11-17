<?php

namespace Modules\Cart\Repositories;

interface ICartItemRepository
{
    public function addItem($cartId, array $data);
    public function updateItem($itemId, array $data);
    public function deleteItem($itemId);
}
