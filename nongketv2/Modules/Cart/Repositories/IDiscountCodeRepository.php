<?php

namespace Modules\Cart\Repositories;

interface IDiscountCodeRepository
{
    public function findByCode($code);
}
