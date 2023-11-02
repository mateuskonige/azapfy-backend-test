<?php

namespace App\Actions;

use App\Enums\ProductStatusEnum;
use Carbon\Carbon;

class ProductsTotalValueDeliveredByShipperAction
{
    public function execute($request): float
    {
        // Para o remetente receber por um produto, é necessário que o documento esteja
        // entregue (status comprovado) e que a entrega tenha sido feita em no máximo
        // dois dias após a sua data de emissão.

        $total = 0;

        foreach ($request as $item) {
            if ($item['status'] == ProductStatusEnum::COMPROVADO->value) {
                $data_emissao = Carbon::createFromFormat('d/m/Y H:i:s', $item['dt_emis']);
                $data_entrega = Carbon::createFromFormat('d/m/Y H:i:s', $item['dt_entrega']);
                $diferenca = $data_emissao->diffInDays($data_entrega);

                if ($diferenca <= 2) {
                    $total += $item['valor'];
                }
            } else {
                $total += 0;
            }
        }

        return number_format((float) $total, 2, '.', '');
    }
}
