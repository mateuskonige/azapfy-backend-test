<?php

namespace App\Services;

use App\Actions\GroupByShipperAction;
use App\Actions\ProductsTotalValueByShipperAction;
use App\Actions\ProductsTotalValueDeliveredByShipperAction;
use App\Actions\ProductsTotalValueFailedToReceiveByShipperAction;
use App\Actions\ProductsTotalValueNotDeliveredByShipperAction;

class PaymentControlService
{
    public function process($request)
    {
        $groupByShipperAction = new GroupByShipperAction();
        $productsTotalValueByShipperAction = new ProductsTotalValueByShipperAction();
        $productsTotalValueDeliveredByShipperAction = new ProductsTotalValueDeliveredByShipperAction();
        $productsTotalValueFailedToReceiveByShipperAction = new ProductsTotalValueFailedToReceiveByShipperAction();
        $productsTotalValueNotDeliveredByShipperAction = new ProductsTotalValueNotDeliveredByShipperAction();

        $data = $groupByShipperAction->execute($request);

        foreach ($data as $key => $value) {
            $data[$key]['total_value'] = $productsTotalValueByShipperAction->execute($value['products']);
        }

        foreach ($data as $key => $value) {
            $data[$key]['value_delivered'] = $productsTotalValueDeliveredByShipperAction->execute($value['products']);
        }

        foreach ($data as $key => $value) {
            $data[$key]['value_not_delivered'] = $productsTotalValueFailedToReceiveByShipperAction->execute($value['products']);
        }

        foreach ($data as $key => $value) {
            $data[$key]['failed_to_receive'] = $productsTotalValueNotDeliveredByShipperAction->execute($value['products']);
        }

        return $data;
    }
}
