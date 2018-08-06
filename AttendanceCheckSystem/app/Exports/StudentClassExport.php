<?php
namespace app\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\ClassModel;
class StudentClassExport implements FromView
{
    public function __construct(ClassModel $class)
    {
        $this->class = $class;
    }
    public function view(): View
    {
        return view('excel.student_class', [
            'class' =>$this->class
        ]);
    }
}