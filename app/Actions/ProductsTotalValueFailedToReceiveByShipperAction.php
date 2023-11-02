<?php

namespace App\Actions;

use App\Enums\ProductStatusEnum;
use Carbon\Carbon;

class ProductsTotalValueFailedToReceiveByShipperAction
{
    public function execute($request): float
    {
        $total = 0;

        foreach ($request as $item) {
            if ($item['status'] == ProductStatusEnum::COMPROVADO->value) {
                $data_emissao = Carbon::createFromFormat('d/m/Y H:i:s', $item['dt_emis']);
                $data_entrega = Carbon::createFromFormat('d/m/Y H:i:s', $item['dt_entrega']);
                $diferenca = $data_emissao->diffInDays($data_entrega);

                if ($diferenca > 2) {
                    $total += $item['valor'];
                } else {
                    $total += 0;
                }
            }
        }

        return number_format((float) $total, 2, '.', '');
    }
}
