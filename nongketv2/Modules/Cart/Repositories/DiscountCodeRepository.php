<?php

namespace Modules\Cart\Repositories;

use App\Models\DiscountCode;

class DiscountCodeRepository implements IDiscountCodeRepository
{
    public function findByCode($code)
    {
        return DiscountCode::where('code', $code)
            ->where('status', 'active')
            ->where('start_date', '<=', now())
            ->where('end_date', '>=', now())
            ->first();
    }
}
