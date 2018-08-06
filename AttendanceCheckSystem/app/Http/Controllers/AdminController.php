<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Admin;
use App\Teacher;
use App\ClassModel;
use App\Student;
use App\Session;
use App\Exports\SessionExport;
use App\Exports\StudentClassExport;
use Excel;

class AdminController extends Controller
{
    public function gregorian_to_jalali($gy,$gm,$gd,$mod=''){
        $g_d_m=array(0,31,59,90,120,151,181,212,243,273,304,334);
        $jy=($gy<=1600)?0:979;
        $gy-=($gy<=1600)?621:1600;
        $gy2=($gm>2)?($gy+1):$gy;
        $days=(365*$gy) +((int)(($gy2+3)/4)) -((int)(($gy2+99)/100))
       +((int)(($gy2+399)/400)) -80 +$gd +$g_d_m[$gm-1];
        $jy+=33*((int)($days/12053));
        $days%=12053;
        $jy+=4*((int)($days/1461));
        $days%=1461;
        $jy+=(int)(($days-1)/365);
        if($days > 365)$days=($days-1)%365;
        $jm=($days < 186)?1+(int)($days/31):7+(int)(($days-186)/30);
        $jd=1+(($days < 186)?($days%31):(($days-186)%30));
        return($mod=='')?array($jy,$jm,$jd):$jy.$mod.$jm.$mod.$jd;
   }
   function jalali_to_gregorian($jy,$jm,$jd,$mod=''){

        if($jy > 979){
        $gy=1600;
        $jy-=979;
        }else{
        $gy=621;
        }
        $days=(365*$jy) +(((int)($jy/33))*8) +((int)((($jy%33)+3)/4)) +78 +$jd +(($jm<7)?($jm-1)*31:(($jm-7)*30)+186);
        $gy+=400*((int)($days/146097));
        $days%=146097;
        if($days > 36524){
        $gy+=100*((int)(--$days/36524));
        $days%=36524;
        if($days >= 365)$days++;
        }
        $gy+=4*((int)(($days)/1461));
        $days%=1461;
        $gy+=(int)(($days-1)/365);
        if($days > 365)$days=($days-1)%365;
        $gd=$days+1;
        foreach(array(0,31,((($gy%4==0) and ($gy%100!=0)) or ($gy%400==0))?29:28 ,31,30,31,30,31,31,30,31,30,31) as $gm=>$v){
        if($gd <= $v)break;
        $gd-=$v;
        }
        return($mod==='')?array($gy,$gm,$gd):$gy .$mod .$gm .$mod .$gd;
    }
    public function showLoginForm(Request $request){
        if(Auth::guard('admin')->check()){
            return redirect('/admin/classActives');
        }
        return view('admin.admin-login');
    }
    public function login(Request $request){
        
        if(Auth::guard('admin')->attempt(['username' => $request->input('username'),
        'password' => $request->input('password')])){
                return redirect('/admin/classActives');
        }
        return redirect('/admin/login');
    }
    public function redirectToLogin(Request $request){
        return redirect('/admin/login');
    }
    public function logout(Request $request){
        if(Auth::guard('admin')->check()){
            Auth::guard('admin')->logout();
        }
        return redirect('/admin/login');
    }
    ////////////////////////////teacher
    public function showNewTeacherForm(Request $request){
        $menu = 5;
        return view('admin.teacher_new',compact('menu'));
    }
    public function newTeacher(Request $request){
        $messages = [
            'name.required' => 'نام وارد نشده است.',
            'family.required' => 'نام خانوادگی وارد نشده است.',
            'username.unique' => 'نام کاربری قبلا انتخاب شده است.',
            'username.required' => 'نام کاربری وارد نشده است.',
            'password.required' => 'رمز عبور وارد نشده است.',
            'password.min' => 'رمز عبور باید حداقل 6 کاراکتر باشد.',
            
            ];
          $this->validate($request, [
            'name' =>'required',
            'family' => 'required',
            'username'=>'required|unique:teachers,username',
            'password' => 'required|min:6',
          ],$messages);
        
        $teacher = new Teacher;
        $teacher->first_name = $request->name;
        $teacher->last_name = $request->family;
        $teacher->username = $request->username;
        $teacher->password = bcrypt($request->password);
        $teacher->save();
        return redirect('/admin/teacherList');
    }
    public function showEditTeacherForm(Request $request,$id){
        $teacher = Teacher::find($id);
        $menu = 7;
        return view('admin.teacher_edit',compact('teacher','menu'));
    }
    public function editTeacher(Request $request,$id){
        $messages = [
            'name.required' => 'نام وارد نشده است.',
            'family.required' => 'نام خانوادگی وارد نشده است.',
            ];
          $this->validate($request, [
            'name' =>'required',
            'family' => 'required',
          ],$messages);
        
        $teacher = Teacher::find($id);
        $teacher->first_name = $request->name;
        $teacher->last_name = $request->family;
        if($teacher->password){
            $teacher->password = bcrypt($request->password);
        }
        $teacher->save();
        return redirect('/admin/teacherList');
    }
    public function showTeachersList(Request $request){
        $teachers = Teacher::all();
        $menu = 2;
        return view('admin.teacher_list',compact('teachers','menu'));
    }
    public function showTeacherClassesList(Request $request,$id){
        $teacher = Teacher::with('classes')->find($id);
        $menu = 7;
        return view('admin.teacher_classes_list',compact('teacher','menu'));
    }
    public function deleteTeacher(Request $request,$id){
        $teacher = Teacher::with('classes','classes.students','classes.sessions','classes.sessions.attendances')->find($id);
        foreach($teacher->classes as $class){
            foreach($class->sessions as $session){
                foreach($session->attendances as $attendance){
                    $attendance->delete();
                }
                $session->delete();
            }
            
            foreach($class->students as $student){
                $student->classes()->detach($class->id);
            }
            $class->delete();
        }
        $teacher->delete();
        return redirect('/admin/teacherList');
    }

    //////////////////////////////student//////////////////
    public function showNewStudentForm(Request $request){
        $menu = 6;
        return view('admin.student_new',compact('menu'));
    }
    public function newStudent(Request $request){
        $messages = [
            'name.required' => 'نام وارد نشده است.',
            'family.required' => 'نام خانوادگی وارد نشده است.',
            
            ];
          $this->validate($request, [
            'name' =>'required',
            'family' => 'required',
          ],$messages);
        
        $student = new Student;
        $student->first_name = $request->name;
        $student->last_name = $request->family;
        $student->green_cart_number = $request->green_cart_number;
        $student->save();
        return redirect('/admin/studentList');
    }
    public function showEditStudentForm(Request $request,$id){
        $student = Student::find($id);
        $menu = 7;
        return view('admin.student_edit',compact('student','menu'));
    }
    public function editStudent(Request $request,$id){
        $messages = [
            'name.required' => 'نام وارد نشده است.',
            'family.required' => 'نام خانوادگی وارد نشده است.',
            
            ];
          $this->validate($request, [
            'name' =>'required',
            'family' => 'required',
          ],$messages);
        
        $student = Student::find($id);
        $student->first_name = $request->name;
        $student->last_name = $request->family;
        $student->green_cart_number = $request->green_cart_number;
        $student->save();
        return redirect('/admin/studentList');
    }
    public function showStudentsList(Request $request){
        $students = Student::all();
        $menu = 3;
        return view('admin.student_list',compact('students','menu'));
    }
    public function showStudentClassesList(Request $request,$id){
        $student = Student::with('classes','classes.teacher')->find($id);
        $menu = 3;
        return view('admin.student_classes_list',compact('student','menu'));
    }
    public function deleteStudent(Request $request,$id){
        $student = Student::with('classes','attendances')->find($id);
        foreach($student->classes as $class){
            $student->classes()->detach($class->id);
        }
        foreach($student->attendances as $attendance){
            $attendance->delete();
        }
        $student->delete();
        return redirect('/admin/studentList');
    }
    ///////////////////////class/////////////////////////////////
    public function showNewClassForm(Request $request){
        $teachers = Teacher::all();
        $students = Student::all();
        $menu = 4;
        return view('admin.class_new',compact('students','teachers','menu'));
    }
    public function newClass(Request $request){
        $messages = [
            'topic.required' => 'عنوان کلاس وارد نشده است.',
            'start_time.required' => 'زمان شروع کلاس وارد نشده است.',
            'end_time.required' => 'زمان پایان کلاس وارد نشده است.',
            'start_time.date_format' => 'ساعت شروع به فرمت صحیح وارد نشده است. مثال: 17:00',
            'end_time.date_format' => 'ساعت پایان به فرمت صحیح وارد نشده است. مثال: 17:00',
            'semester.required' => 'فصل کلاس انتخاب نشده است.',
            'year.required' => 'سال کلاس وارد نشده است.',
            'teacher.required' => 'استاد کلاس انتخاب نشده است.',
            
            
            ];
          $this->validate($request, [
            'topic' =>'required',
            'start_time' => 'required|date_format:"H:i"',
            'end_time' => 'required|date_format:"H:i"',
            'semester' => 'required',
            'year' => 'required',
            'teacher' => 'required',
          ],$messages);
        
        $class = new ClassModel;
        $class->topic = $request->topic;
        $class->year = $request->year;
        $class->semester = $request->semester;
        $class->start_time = $request->start_time.':00';
        $class->end_time = $request->end_time.':00';
        
        if($request->saturday)
            $class->saturday = 1;
        if($request->sunday)
            $class->sunday = 1;
        if($request->monday)
            $class->monday = 1;
        if($request->tuesday)
            $class->tuesday = 1;
        if($request->wednesday)
            $class->wednesday = 1;
        if($request->thursday)
            $class->thursday = 1;
        if($request->friday)
            $class->friday = 1;

        $class->teacher_id = $request->teacher;
        $class->save();
        $i = 1;
        $j = 'select'.$i;
        $students = array();
        while($request->$j){
            if(!in_array($request->$j,$students)){
                $class->students()->attach($request->$j);
                array_push($students,$request->$j);
            }
            $i = $i+1;
            $j =  'select'.$i;
        }
        return redirect('/admin/classActives');
    }
    public function showEditClassForm(Request $request,$id){
        $class = ClassModel::with('teacher','students')->find($id);
        $start_time_arr = explode(":",$class->start_time);
        $class->start_time = $start_time_arr[0].":".$start_time_arr[1]; 
        $end_time_arr = explode(":",$class->end_time);
        $class->end_time = $end_time_arr[0].":".$end_time_arr[1]; 
        $teachers = Teacher::all();
        $students = Student::all();
        $menu = 7;
        return view('admin.class_edit',compact('class','students','teachers','menu'));
    }
    public function editClass(Request $request,$id){
        $messages = [
            'topic.required' => 'عنوان کلاس وارد نشده است.',
            'start_time.required' => 'زمان شروع کلاس وارد نشده است.',
            'end_time.required' => 'زمان پایان کلاس وارد نشده است.',
            'start_time.date_format' => 'ساعت شروع به فرمت صحیح وارد نشده است. مثال: 17:00',
            'end_time.date_format' => 'ساعت پایان به فرمت صحیح وارد نشده است. مثال: 17:00',
            'semester.required' => 'فصل کلاس انتخاب نشده است.',
            'year.required' => 'سال کلاس وارد نشده است.',
            'teacher.required' => 'استاد کلاس انتخاب نشده است.',
            
            
            ];
          $this->validate($request, [
            'topic' =>'required',
            'start_time' => 'required|date_format:"H:i"',
            'end_time' => 'required|date_format:"H:i"',
            'semester' => 'required',
            'year' => 'required',
            'teacher' => 'required',
          ],$messages);
        $class = ClassModel::with('students')->find($id);
        $class->topic = $request->topic;
        $class->year = $request->year;
        $class->semester = $request->semester;
        $class->start_time = $request->start_time.':00';
        $class->end_time = $request->end_time.':00';
        
        if($request->saturday==1)
            $class->saturday = 1;
        else{
            $class->saturday = 0;
        }
        if($request->sunday==1)
            $class->sunday = 1;
        else 
            $class->sunday = 0;
        if($request->monday==1)
            $class->monday = 1;
        else
            $class->monday = 0;
        if($request->tuesday==1)
            $class->tuesday = 1;
        else
            $class->tuesday = 0;
        if($request->wednesda==1)
            $class->wednesday = 1;
        else
            $class->wednesday = 0;
        if($request->thursday==1)
            $class->thursday = 1;
        else
            $class->thursday = 0;
        if($request->friday==1)
            $class->friday = 1;
        else
            $class->friday = 0;
        $class->teacher_id = $request->teacher;
        $class->save();
        $i = 1;
        $j = 'select'.$i;
        $students = array();
        $prev_students = $class->students;
        foreach($prev_students as $prev_student){
            array_push($students,$prev_student->id);
        }
        while($request->$j){
            if(!in_array($request->$j,$students)){
                $class->students()->attach($request->$j);
                array_push($students,$request->$j);
            }
            $i = $i+1;
            $j =  'select'.$i;
        }
        return redirect('/admin/classActives');
    }

    public function showActiveClasses(Request $request){
        $classes = ClassModel::where('is_finished',0)->with('teacher')->get();
        $menu = 1;
        return view('admin.class_list_actives',compact('classes','menu'));
    }
    public function showFinishedClasses(Request $request){
        $classes = ClassModel::where('is_finished',1)->with('teacher')->get();
        $menu = 0;
        return view('admin.class_list_finished',compact('classes','menu'));
    }
    public function showClassStudentsList(Request $request,$id){
        $class = ClassModel::with('students','teacher')->find($id);
        $menu = 7;
        return view('admin.class_students_list',compact('class','menu'));
    }
    public function showClassSessionList(Request $request,$id){ //classid
        $class = ClassModel::find($id); 
        $menu = -1;
        $sessions = Session::with('attendances')->where('class_id',$id)->orderBy('date', 'desc')->get();
        foreach($sessions as $session){
            if($session->attendances->count()>0){
                $session->has_attendance = 1;
            }
            else{
                $session->has_attendance = 0;
            }
            $miladi_date = $session->date;
            $miladi_date_array = explode('-', $miladi_date);
            $month = $miladi_date_array[1];
            $day   = $miladi_date_array[2];
            $year  = $miladi_date_array[0];
            $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'-');
            $session->date = $shamsi_date;
        }
        $session_count = Session::where('class_id',$id)->orderBy('date', 'desc')->count();
        return view('admin.class_sessions_list',compact('class','sessions','session_count','menu'));
        
    }
    public function showSessionAttendancesList(Request $request,$id){
        $menu = -1;
        $session = Session::with('attendances','attendances.student','class')->find($id);
        return view('admin.session_attendances_list',compact('session','menu'));
    }
    public function activateClass(Request $request,$id){
        $class = ClassModel::find($id);
        $class->is_finished = 0;
        $class->save();
        return redirect()->back();
    }
    public function deactivateClass(Request $request,$id){
        $class = ClassModel::find($id);
        $class->is_finished = 1;
        $class->save();
        return redirect()->back();
    }
    public function removeStudentFromClass(Request $request,$classId,$studentId){
        $class = ClassModel::find($classId);
        $class->students()->detach($studentId);
        return redirect()->back();
    }
    public function deleteClass(Request $request,$id){
        $class = ClassModel::with('students','sessions','sessions.attendances')->find($id);
        foreach($class->students as $student){
            $class->students()->detach($student->id);
        }
        foreach($class->sessions as $session){
            foreach($session->attendances as $attendance){
                $attendance->delete();
            }
            $session->delete();
        }
        $class->delete();
        return redirect('/admin/classActives');
    }

    public function createSessionExcel(Request $request,$id){
        $session = Session::with('class','class.teacher','attendances','attendances.student','class')->find($id);
        $miladi_date = $session->date;
        $miladi_date_array = explode('-', $miladi_date);
        $month = $miladi_date_array[1];
        $day   = $miladi_date_array[2];
        $year  = $miladi_date_array[0];
        $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'-');
        $session->date = $shamsi_date;

        return Excel::download(new SessionExport($session), 'session '.$session->date.'.xlsx');
    }
    public function createStudentClassExcel(Request $request,$classId,$studentId){
        $class = ClassModel::where('id',$classId)->with(['sessions','teacher','sessions.attendances' => function ($query) use($studentId){
            $query->where('student_id', $studentId);   
        },'sessions.attendances.student'])->get()->first();
        foreach($class->sessions as $session){
            $miladi_date = $session->date;
            $miladi_date_array = explode('-', $miladi_date);
            $month = $miladi_date_array[1];
            $day   = $miladi_date_array[2];
            $year  = $miladi_date_array[0];
            $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'-');
            $session->date = $shamsi_date;
        }
        $student = Student::find($studentId);

        return Excel::download(new StudentClassExport($class), $class->topic.'-'.$student->first_name.'-'.$student->last_name.'.xlsx');
    }



    public function signup(Request $request){
        $admin = new Admin([
            'username' => 'admin',
            'password' => bcrypt('adminglfwnex'),
        ]);
        if ($admin->save()) {    
            return redirect('admin/login');
        }
        else{
            
        }
    }
}
