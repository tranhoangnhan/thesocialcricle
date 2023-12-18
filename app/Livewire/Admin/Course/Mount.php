<?php

namespace App\Livewire\Admin\Course;

use App\Models\PaymentModel;
use Livewire\Component;
use Livewire\Attributes\On;

class Mount extends Component
{
    public $year;
    public $selectedYear;
    public $mount;
    public function updateChart()
    {
        if ($this->year) {
            $this->mount = PaymentModel::selectRaw('MONTH(created_at) as month, sum(vnp_Amount) as total')
                ->whereYear('created_at', $this->year)
                ->groupBy('month')
                ->get();
        } else {
            $this->mount = PaymentModel::selectRaw('MONTH(created_at) as month, sum(vnp_Amount) as total')
                ->whereYear('created_at', $this->selectedYear)
                ->groupBy('month')
                ->get();
        }
        $this->dispatch('mountUpdated', ['mount'=>$this->mount]);
    }

    public function render()
    {
        $getYear = PaymentModel::selectRaw('YEAR(created_at) as year')->groupBy('year')->get();
        $this->selectedYear = date('Y');
        $this->updateChart();
        return view('livewire.admin.course.mount', ['mount' => $this->mount, 'getYear' => $getYear,   'selectedYear' => $this->selectedYear]);
    }
}
