<?php

namespace App\Livewire\Admin;

use App\Models\ReservationList;
use App\Models\CancelledList;
use App\Models\Totalincome;
use App\Models\Reservation;
use Livewire\Component;

class Dashboard extends Component
{
    public $sub;
    public $monthlySub;
    public $yearlySub;

    public function render()
    {
        $totalcancelledList = CancelledList::count();
        $totalbookingList = Reservation::count();
        $totalReservationList = ReservationList::count();
        $totalIncome = $totalIncome = Totalincome::sum('income');
        $this->loadData();
        $this->loadMonthlyData();
        $this->loadYearlyData();
        return view('livewire.admin.dashboard', [
            'totalReservationList' => $totalReservationList,
            'totalcancelledList' => $totalcancelledList,
            'totalbookingList' => $totalbookingList,
            'totalIncome' =>$totalIncome,
        ]);
    }

    public function loadData()
    {
        $dailyIncomeData = Totalincome::selectRaw('DATE(created_at) as date, sum(income) as income')
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        $dates = $dailyIncomeData->pluck('date')->toArray();
        $totalIncome = $dailyIncomeData->pluck('income')->toArray();

        $this->sub = array_map(function ($date, $income) {
            return ['Day' => $date, 'Value' => $income];
        }, $dates, $totalIncome);
    }

    public function loadMonthlyData()
    {
        $monthlyIncomeData = Totalincome::selectRaw('YEAR(created_at) as year, MONTH(created_at) as month, sum(income) as income')
        ->groupBy('year', 'month')
        ->orderBy('year')
        ->orderBy('month')
        ->get();

    $months = $monthlyIncomeData->map(function ($item) {
        return $item->year . '-' . str_pad($item->month, 2, '0', STR_PAD_LEFT);
    });

    $totalMonthlyIncome = $monthlyIncomeData->pluck('income');

    $this->monthlySub = array_map(function ($month, $income) {
        return ['Month' => $month, 'Value' => $income];
    }, $months->toArray(), $totalMonthlyIncome->toArray());
    }

    public function loadYearlyData()
    {
        $yearlyIncomeData = Totalincome::selectRaw('YEAR(created_at) as year, sum(income) as income')
            ->groupBy('year')
            ->orderBy('year')
            ->get();

        $years = $yearlyIncomeData->pluck('year')->toArray();
        $totalYearlyIncome = $yearlyIncomeData->pluck('income')->toArray();

        $this->yearlySub = array_map(function ($year, $income) {
            return ['Year' => $year, 'Value' => $income];
        }, $years, $totalYearlyIncome);
    }
    protected $listeners = ['loadData'];
}
