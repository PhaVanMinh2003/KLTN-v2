<?php

namespace Modules\Cart\Services;

use Modules\Cart\Repositories\ICartRepository;

class CartService implements ICartService
{
    protected $cartRepository;

    public function __construct(ICartRepository $cartRepository)
    {
        $this->cartRepository = $cartRepository;
    }

    public function getCart($consumer_id)
    {
        return $this->cartRepository->getCartByUserId($consumer_id);
    }


    public function createCart()
    {
        return $this->cartRepository->createCart();
    }

    public function updateCart($cartId, array $data)
    {
        return $this->cartRepository->updateCart($cartId, $data);
    }

    public function deleteCart($cartId)
    {
        return $this->cartRepository->deleteCart($cartId);
    }
}
