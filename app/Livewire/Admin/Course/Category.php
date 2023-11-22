<?php

namespace App\Livewire\Admin\Course;

use App\Models\CourseCategoryModel;
use App\Models\CoursesModel;
use Livewire\Component;
use Illuminate\Support\Str;

class Category extends Component
{
    public $category_name;
    public $category_new;
    public $check_update = false;
    public $check_create ='';
    protected $rules = [
        'check_create' => 'required|unique:course_category,category_new',
    ];
    protected $messages = [
        'check_create.required' => 'Vui lòng nhập tên danh mục.',
        'check_create.unique'=> 'Tên đã tồn tại',
    ];
    public function Create()
    {
        $this->validate();
        CourseCategoryModel::create([
            'category_name' =>  $this->category_new,
            'slug' => Str::slug($this->category_new)
        ]);
    }

    public function Update($id)
    {
        $cate = CourseCategoryModel::find($id);
        $cate->update([
            'category_name' =>  $this->category_name,
            'slug' => Str::slug($this->category_name)
        ]);
    }
    public function delete($id)
    {
        $category = CourseCategoryModel::find($id);
        $category->delete();
    }
    public function render()
    {
        $category = CourseCategoryModel::all();
        foreach ($category as $cat) {
            $count = CoursesModel::where('category_id', $cat->category_id)->count();
            $cat->count = $count;
        }
        return view('livewire.admin.course.category', ['category' => $category]);
    }
}
