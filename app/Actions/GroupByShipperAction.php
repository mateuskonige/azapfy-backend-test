<?php

namespace App\Actions;

class GroupByShipperAction
{
    public function execute($request): array
    {
        $grouped = [];

        foreach ($request as $item) {
            $grouped[$item['cnpj_remete']]['products'][] = $item;
        }

        return $grouped;
    }
}
