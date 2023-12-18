<?php

namespace App\Livewire\Admin;

use App\Models\CoursesModel;
use App\Models\UsersModel;
use Livewire\Component;

class Home extends Component
{
    public $year;
    public $selectedYear;
    public $user;
    public $course;
    public function updateChart()
    {
        if ($this->year) {
            $this->user = UsersModel::selectRaw('MONTH(user_registered) as month, COUNT(*) as count')
                ->whereYear('user_registered', $this->year)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
        } else {
            $this->user = UsersModel::selectRaw('MONTH(user_registered) as month, COUNT(*) as count')
                ->whereYear('user_registered', $this->selectedYear)
                ->groupBy('month')
                ->pluck('count', 'month')
                ->toArray();
        }
        $this->dispatch('userUpdated', ['user' => $this->user]);
    }
    public function render()
    {
        $getYear = UsersModel::selectRaw('YEAR(user_registered) as year')->groupBy('year')->get();
        $this->selectedYear = date('Y');
        $this->updateChart();
        $this->course = CoursesModel::join('course_category', 'course.category_id', '=', 'course_category.category_id')
            ->selectRaw('course_category.category_name as month, COUNT(course.course_id) as count')
            ->groupBy('course_category.category_name')
            ->pluck('count', 'month')
            ->toArray();

        return view('livewire.admin.home', ['user' => $this->user, 'getYear' => $getYear,   'selectedYear' => $this->selectedYear, 'course' => $this->course]);
    }
}
