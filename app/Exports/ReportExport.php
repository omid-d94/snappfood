<?php

namespace App\Exports;

use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ReportController;
use App\Models\Order;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\HeadingRowImport;

class ReportExport implements FromView, WithCustomStartCell, WithProperties
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return (new ReportController())->getAllOrders();
    }

    /**
     * starting table at B2 cell
     * @return string
     */
    public function startCell(): string
    {
        return 'B2';
    }

    public function view(): View
    {
        return view("reports.export", ["orders" => $this->collection()]);
        //(new OrderController())->getArchivedOrders();
    }

    public function properties(): array
    {
        return [
            'creator' => auth("seller")->user()->name,
            'lastModifiedBy' => auth("seller")->user()->name,
            'title' => 'Income Export',
            'description' => 'Latest Report',
            'subject' => 'Income',
            'keywords' => 'invoices,export,spreadsheet',
            'category' => 'Invoices',
            'manager' => auth("seller")->user()->name,
            'company' => auth("seller")->user()->restaurants->first()->title,
        ];
    }
}
