<?php

namespace App\Actions;

class ProductsTotalValueByShipperAction
{
    public function execute($request): float
    {
        $total = 0;

        foreach ($request as $item) {
            $total += $item['valor'];
        }

        return number_format((float) $total, 2, '.', '');
    }
}
