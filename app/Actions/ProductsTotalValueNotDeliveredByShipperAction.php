<?php

namespace App\Actions;

use App\Enums\ProductStatusEnum;

class ProductsTotalValueNotDeliveredByShipperAction
{
    public function execute($request): float
    {
        $total = 0;

        foreach ($request as $item) {
            if ($item['status'] == ProductStatusEnum::ABERTO->value) {
                $total += $item['valor'];
            } else {
                $total += 0;
            }
        }

        return number_format((float) $total, 2, '.', '');
    }
}
