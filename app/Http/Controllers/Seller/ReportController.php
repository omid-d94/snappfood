<?php

namespace App\Http\Controllers\Seller;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\FilterChartRequest;
use App\Models\Order;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;


class ReportController extends Controller
{
    /**
     * display all orders on chart group by month
     * @return Application|Factory|View
     */
    public function index()
    {
        $orders = $this->getAllOrders();
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $countChart = $this->countAllOrders();
        $countLabel = $countChart->keys();
        $countData = $countChart->values();
        return view("reports.index",
            compact("count", "totalIncome", "orders", "countLabel", "countData"));
    }


    /**
     * Get count of orders group by month
     * @return mixed
     */
    public function countAllOrders()
    {
        return Order::select([DB::raw("COUNT(*) as count"), DB::raw("MONTHNAME(created_at) as month_name")])
            ->where('status', Order::DELIVERED)
            ->where('restaurant_id', auth('seller')->user()->restaurants->first()->id)
            ->whereYear('created_at', now()->year)->withTrashed()
            ->groupBy(DB::raw("MONTHNAME(created_at)"))
            ->pluck('count', 'month_name');
    }

    /**
     * Get orders by filtering between two dates
     *
     * @param FilterChartRequest $request
     * @return Application|Factory|View
     */
    public function filterDates(FilterChartRequest $request)
    {
        $validated = $request->validated();
        $orders = (new OrderController())
            ->getDeliveredOrders()
            ->whereBetween("created_at", [$request->from, $request->to])
            ->get();
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $countOrders = $this->countFilterOrders($request->from, $request->to);
        $countLabel = $countOrders->keys();
        $countData = $countOrders->values();
        return view("reports.index", compact("count", "totalIncome", "countLabel", "countData", "orders"));
    }

    /**
     * filter orders between two dates
     * @param $from
     * @param $to
     * @return mixed
     */
    public function countFilterOrders($from, $to)
    {
        return (new OrderController())
            ->getDeliveredOrders()
            ->select([DB::raw("SUM(total) as total"), DB::raw("Date(created_at) as date")])
            ->whereBetween('created_at', [$from, $to])->withTrashed()
            ->groupBy(DB::raw("Date(created_at)"))
            ->pluck('total', 'date');
    }

    /**
     * Get all orders of restaurant
     * @return mixed
     */
    public function getAllOrders()
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


    /**
     * export a report as excel file
     * @return BinaryFileResponse
     */
    public function exportExcel()
    {
        return Excel::download(
            export: new ReportExport(),
            fileName: date("Ymd_His", time()) . "_report.xlsx"
        );
    }

    /**
     * export a report as csv file
     * @return BinaryFileResponse
     */
    public function exportCSV()
    {
        return Excel::download(
            export: new ReportExport(),
            fileName: date("Ymd_His", time()) . "_report.csv"
        );
    }

    /**
     * export a report as pdf file
     * @return BinaryFileResponse
     */
    public function exportPDF()
    {
        return Excel::download(
            export: new ReportExport(),
            fileName: date("Ymd_His", time()) . "_report.pdf"
        );
    }


}

