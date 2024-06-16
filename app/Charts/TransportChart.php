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
        // Mengambil jumlah peminjaman kendaraan
        $data = Lending::select('transport_id', \DB::raw('count(*) as total'))
            ->groupBy('transport_id')
            ->get();
    
        $transportIds = $data->pluck('transport_id')->toArray();
        $counts = $data->pluck('total')->toArray();
        
        // Mengambil nama kendaraan berdasarkan id kendaraan
        $transportNames = Transportation::whereIn('id', $transportIds)
            ->pluck('name', 'id')
            ->toArray();
        
        // Membuat label untuk sumbu X
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
        // Mengambil data kendaraan & pemakaian bensin
        $data = Transportation::select('name', 'fuel')
            ->get();

        // Nama kendaraan
        $labels = $data->pluck('name')->toArray();
        // Pemakaian bensin
        $fuelUsages = $data->pluck('fuel')->toArray();

        return $this->chart->BarChart()
            ->setTitle('Pemakaian Bensin Setiap Kendaraan')
            ->setSubtitle('Data Terbaru')
            ->setColors(['#FFC107'])
            ->addData('Pemakaian Bensin (liter)', $fuelUsages)
            ->setXAxis($labels);
    }


}
