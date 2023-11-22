<?php

namespace App\Livewire\Course;

use Livewire\Component;
use App\Models\PaymentModel;
class Revenue extends Component
{
    public $course;
    public $startdate;
    public $enddate;
    public function mount($course)
    {
        $this->course = $course;
    }
    public function caculator()
    {
        $this->startdate = date('Y-m-d', strtotime($this->startdate));
        $this->enddate = date('Y-m-d', strtotime($this->enddate));
    }
    public function render()
    {
        if($this->startdate && $this->enddate)
        {
            $revenue = PaymentModel::select(\DB::raw('SUM(vnp_Amount) as total_revenue'))
            ->where('course_id', $this->course->course_id)
            ->whereBetween(\DB::raw('DATE(created_at)'), [$this->startdate, $this->enddate])
            ->first()
            ->total_revenue;
                    return view('livewire.course.revenue')->with('revenue', $revenue);
        }
        $revenue = PaymentModel::where('course_id', $this->course->course_id)->sum('vnp_Amount');
        return view('livewire.course.revenue')->with('revenue', $revenue);
    }
}
