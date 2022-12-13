<?php

namespace App\Traits\Seller;

use App\Http\Controllers\Seller\OrderController;

trait Reports
{
    /**
     * Get count of orders group by month name
     * @return mixed
     */
    public function countAllOrders(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectCountAndMonthName()
            ->whereYear('created_at', now()->year)->withTrashed()
            ->groupByMonthName()
            ->pluck('count', 'month_name');
    }

    /**
     * Get income of orders group by month name
     * @return mixed
     */
    public function incomeAllOrders(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectTotalAndMonthName()
            ->whereYear('created_at', now()->year)->withTrashed()
            ->groupByMonthName()
            ->pluck("income", "month_name");
    }

}
