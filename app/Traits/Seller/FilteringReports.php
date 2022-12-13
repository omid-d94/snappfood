<?php

namespace App\Traits\Seller;

use App\Http\Controllers\Seller\OrderController;
use Illuminate\Database\Eloquent\Collection;

trait FilteringReports
{
    /**
     * get total and date related to income-chart
     * when filtered by week
     * @return mixed
     */
    public function incomeFilterByWeek(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectTotalAndDate()
            ->filterByWeek()
            ->groupByCreateAtDate()
            ->pluck('total', 'date');
    }

    /**
     * get total and date related to income-chart
     * when filtered by month
     *
     * @return mixed
     */
    public function incomeFilterByMonth(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectTotalAndDate()
            ->filterByMonth()
            ->groupByCreateAtDate()
            ->pluck('total', 'date');
    }

    /**
     * get count and date related to count-chart
     * when filtered by week
     * @return mixed
     */
    public function countFilterByWeek(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectCountAndDate()
            ->filterByWeek()
            ->groupByCreateAtDate()
            ->pluck('count', 'date');
    }

    /**
     * get count and date related to count-chart
     * when filtered by month
     * @return mixed
     */
    public function countFilterByMonth(): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectCountAndDate()
            ->filterByMonth()
            ->groupByCreateAtDate()
            ->pluck('count', 'date');
    }

    /**
     * filter orders between two dates
     * get total income
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function incomeFilterBetweenDates($from, $to): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectTotalAndDate()
            ->betweenTwoDates($from, $to)->withTrashed()
            ->groupByCreateAtDate()
            ->pluck('total', 'date');
    }

    /**
     * filter orders between two dates
     * get count orders
     *
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countFilterOrders($from, $to): mixed
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->selectCountAndDate()
            ->betweenTwoDates($from, $to)->withTrashed()
            ->groupByCreateAtDate()
            ->pluck('count', 'date');
    }

    /**
     * Get all orders of restaurant
     * @return mixed
     */
    public function getAllOrders(): mixed
    {
        return (new OrderController())->getDeliveredOrders()->get();
    }

    /**
     * Get Total Income of restaurant
     * @param Collection $orders
     * @return array
     */
    private function getTotalIncome(Collection $orders)
    {
        $total = 0;
        collect($orders)->map(function ($order) use (&$total) {
            $total += $order->getAttributes()['total'];
        });
        return ["total" => number_format($total)];
    }
}
