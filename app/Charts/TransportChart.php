<?php

namespace App\Charts;

use DB;
use App\Models\Lending;
use App\Models\Transportation;
use ArielMejiaDev\LarapexCharts\BarChart;
use ArielMejiaDev\LarapexCharts\LarapexChart;
use ArielMejiaDev\LarapexCharts\HorizontalBar;

class TransportChart
{
    protected $chart;

    public function __construct(LarapexChart $chart)
    {
        $this->chart = $chart;
    }


    public function build(): BarChart
    {
        $data = Lending::select('transport_id', \DB::raw('count(*) as total'))
            ->groupBy('transport_id')
            ->get();
    
        $transportIds = $data->pluck('transport_id')->toArray();
        $counts = $data->pluck('total')->toArray();
    
        $transportNames = Transportation::whereIn('id', $transportIds)
            ->pluck('name', 'id')
            ->toArray();
    
        $labels = [];
        foreach ($transportIds as $id) {
            $labels[] = $transportNames[$id];
        }
    
        return $this->chart->BarChart()
            ->setTitle('Jumlah Penggunaan Kendaraan')
            ->setSubtitle('Data Terbaru')
            ->setColors(['#008FFB'])
            ->addData('Peminjaman', $counts)
            ->setXAxis($labels);
    }


    public function fuel(): BarChart
    {
        $data = Transportation::select('name', 'fuel')
            ->get();

        $labels = $data->pluck('name')->toArray();
        $fuelUsages = $data->pluck('fuel')->toArray();

        return $this->chart->BarChart()
            ->setTitle('Pemakaian Bensin Setiap Kendaraan')
            ->setSubtitle('Data Terbaru')
            ->setColors(['#FFC107'])
            ->addData('Pemakaian Bensin (liter)', $fuelUsages)
            ->setXAxis($labels);
    }


}
