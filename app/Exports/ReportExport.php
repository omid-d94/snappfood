<?php

namespace App\Exports;

use App\Http\Controllers\Seller\OrderController;
use App\Http\Controllers\Seller\ReportController;
use App\Models\Order;
use App\Traits\Seller\FilteringReports;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithCustomStartCell;
use Maatwebsite\Excel\Concerns\WithProperties;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\HeadingRowImport;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ReportExport implements FromView, WithCustomStartCell, WithProperties, ShouldAutoSize, WithStyles
{
    use FilteringReports;

    private Collection $data;
    private string $from;
    private string $to;

    public function __construct(Collection $data = null, string $from = null, string $to = null)
    {
        $this->data = $data;
        $this->from = $from;
        $this->to = $to;
    }

    /**
     * @return Collection
     */
    public function collection(): Collection
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
        return view("reports.export",
            [
                "orders" => $this->data,
                "total" => $this->getTotalIncome($this->data)["total"],
                "from" => $this->from,
                "to" => $this->to,
            ]);
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

    public function styles(Worksheet $sheet)
    {

        return [
            1 => ["font" => ["bold" => true], "background" => ["gray"], "color" => ["white"]],
        ];
    }
}
