<?php

namespace App\Livewire\Admin\Course;

use App\Models\PaymentModel;
use Livewire\Component;
use Livewire\Attributes\On;

class Mount extends Component
{
    public $updateChart;
    public $selectedYear;
    public $mount;
    public function updatedSelect($select)
    {
        $this->updateChart = $select;
        $this->dispatch('updateChart');
    }
    #[On('updateChart')]
    public function updateChart()
    {
        if ($this->updateChart) {
            $this->mount = PaymentModel::selectRaw('MONTH(created_at) as month, sum(vnp_Amount) as total')
                ->whereYear('created_at', $this->updateChart)
                ->groupBy('month')
                ->get();
        } else {
            $this->mount = PaymentModel::selectRaw('MONTH(created_at) as month, sum(vnp_Amount) as total')
                ->groupBy('month')
                ->get();    
        }
    }

    public function render()
    {
        $year = PaymentModel::selectRaw('YEAR(created_at) as year')->groupBy('year')->get();
        $this->selectedYear = date('Y');
        $this->updateChart();
        return view('livewire.admin.course.mount', ['mount' => $this->mount, 'year' => $year,   'selectedYear' => $this->selectedYear]);
    }
}
