<?php

namespace App\Http\Controllers\Seller;

use App\Exports\ReportExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\Seller\FilterChartRequest;
use App\Models\Order;
use App\Traits\Seller\FilteringReports;
use App\Traits\Seller\Reports;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\NotFoundExceptionInterface;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Symfony\Component\HttpFoundation\Response;


class ReportController extends Controller
{
    use FilteringReports, Reports;

    /**
     * display all orders on chart group by month
     * @return Application|Factory|View
     */
    public function index(): View|Factory|Application
    {
        $orders = $this->getAllOrders();
        session()->put(
            [
                "orders" => $orders,
                "from" => $orders->first()?->created_at,
                "to" => now()->format("Y-m-d")
            ]);
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $countChart = $this->countAllOrders();
        $incomeChart = $this->incomeAllOrders();
        $incomeLabel = $incomeChart->keys();
        $incomeData = $incomeChart->values();
        $countLabel = $countChart->keys();
        $countData = $countChart->values();
        return view("reports.index",
            compact("count", "totalIncome", "orders", "countLabel", "countData", "incomeLabel", "incomeData"));
    }

    /**
     * Get orders by filtering between two dates
     *
     * @param FilterChartRequest $request
     * @return Application|Factory|View
     */
    public function filterDates(FilterChartRequest $request): View|Factory|Application
    {
        $request->validated();
        $orders = (new OrderController())
            ->getDeliveredOrders()
            ->betweenTwoDates($request->from, $request->to)
            ->get();
        session()->put(
            [
                "orders" => $orders,
                "from" => $request->from,
                "to" => $request->to
            ]);
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $incomeOrders = $this->incomeFilterBetweenDates($request->from, $request->to);
        $countOrders = $this->countFilterOrders($request->from, $request->to);
        $countData = $countOrders->values();
        $countLabel = $countOrders->keys();
        $incomeData = $incomeOrders->values();
        $incomeLabel = $incomeOrders->keys();
        return view("reports.index",
            compact("count", "totalIncome", "orders",
                "countLabel", "countData", "incomeLabel", "incomeData"));
    }

    /**
     * get chart information when filtered by week
     *
     * @return Application|Factory|View
     */
    public function filterWeek(): View|Factory|Application
    {
        $orders = (new OrderController())->getDeliveredOrders()->filterByWeek()->get();
        session()->put(
            [
                "orders" => $orders,
                "from" => now()->subWeek()->format("Y-m-d"),
                "to" => now()->format("Y-m-d")
            ]);
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $countOrders = $this->countFilterByWeek();
        $incomeOrders = $this->incomeFilterByWeek();
        $countLabel = $countOrders->keys();
        $countData = $countOrders->values();
        $incomeLabel = $incomeOrders->keys();
        $incomeData = $incomeOrders->values();
        return view("reports.index",
            compact("count", "totalIncome", "countLabel", "countData", "incomeLabel", "incomeData", "orders"));
    }

    /**
     * get chart information when filtered by month
     *
     * @return Application|Factory|View
     */
    public function filterMonth(): View|Factory|Application
    {
        $orders = (new OrderController())->getDeliveredOrders()->filterByMonth()->get();
        session()->put([
            "orders" => $orders,
            "from" => now()->subMonth()->format("Y-m-d"),
            "to" => now()->format("Y-m-d")
        ]);
        $count = $orders->count();
        $totalIncome = $this->getTotalIncome($orders)["total"];
        $countOrders = $this->countFilterByMonth();
        $incomeOrders = $this->incomeFilterByMonth();
        $countLabel = $countOrders->keys();
        $countData = $countOrders->values();
        $incomeLabel = $incomeOrders->keys();
        $incomeData = $incomeOrders->values();
        return view("reports.index",
            compact("count", "totalIncome", "countLabel", "countData", "incomeLabel", "incomeData", "orders"));
    }


    /**
     * export a report as excel file
     * @return BinaryFileResponse
     */
    public function exportExcel(): BinaryFileResponse
    {
        $orders = session()->get("orders");
        $from = session()->get("from");
        $to = session()->get("to");
        return Excel::download(
            export: new ReportExport($orders, $from, $to),
            fileName: date("Ymd_His", time()) . "_report.xlsx"
        );
    }

    /**
     * export a report as csv file
     * @return BinaryFileResponse
     */
    public function exportCSV(): BinaryFileResponse
    {
        $orders = session()->get("orders");
        $from = session()->get("from");
        $to = session()->get("to");
        return Excel::download(
            export: new ReportExport($orders, $from, $to),
            fileName: date("Ymd_His", time()) . "_report.csv"
        );
    }

    /**
     * export a report as pdf file
     * @return BinaryFileResponse
     */
    public function exportPDF(): BinaryFileResponse
    {
        $orders = session()->get("orders");
        $from = session()->get("from");
        $to = session()->get("to");
        return Excel::download(
            export: new ReportExport($orders, $from, $to),
            fileName: date("Ymd_His", time()) . "_report.pdf"
        );
    }

    /**
     * @param Collection $data
     */
    public function setData(Collection $data): void
    {
        $this->data = $data;
    }


}

