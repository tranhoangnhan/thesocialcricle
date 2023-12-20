<?php

namespace App\Livewire\Admin\Bill;

use App\Models\CoursesModel;
use App\Models\PaymentModel;
use App\Models\PostsModel;
use App\Models\ReportModel;
use App\Models\User;
use App\Models\UsersModel;
use Livewire\Component;

class Index extends Component
{
    public function delete($id){
        $bill=PaymentModel::find($id);
        $bill->delete();
    }
    public function render()
    {
        $bills=PaymentModel::join('users','users.user_id','=','payment.user_id')
        ->join('course','course.course_id','=','payment.course_id')
        ->select('payment.*','users.user_fullname as user_name','course.course_name as course_name')
        ->get();
        foreach($bills as $bill){
            $bill->created_at=date('d-m-Y',strtotime($bill->created_at));
            $bills->vnp_Amount=number_format($bill->vnp_Amount,0,',','.');
        }

        return view('livewire.admin.bill.index',['bills'=>$bills]);   
    }
}
