<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Hash;
use App\Teacher;
use App\ClassModel;
use App\Student;
use App\Attendance;
use App\Session;

class TeacherController extends Controller
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

    public function redirectToLogin(Request $request){
        return redirect('/teacher/login');
    }
    public function showLoginForm(Request $request){
        if(Auth::check()){
            return redirect('/teacher/classesListActive');
        }
        return view('teacher-login');
    }
    public function login(Request $request){
       
        Auth::attempt(['username' => $request->input('username'), 'password' => $request->input('password')]);
        return redirect('/teacher/classesListActive');
    }
    public function logout(Request $request){
        Auth::logout();
        return redirect('/teacher/login');
    }

    // -------------classes-list-active--------------OKok
    public function classesListActive(Request $request){
        $classes = ClassModel::where('teacher_id',Auth::user()->username)->where('is_finished',0)->get();
        $menu = 0;
        return view('teacher.classes_list_active',compact('classes','menu'));
    }

    // -------------classes-list-finished--------------OKok
    public function classesListFinished(Request $request){
        $classes = ClassModel::where('teacher_id',Auth::user()->username)->where('is_finished',1)->get();
        $menu = 1;
        return view('teacher.classes_list_finished',compact('classes','menu'));
    }

    public function activateClass(Request $request,$id){
        $class = ClassModel::find($id);
        if($class->teacher_id == Auth::user()->username){
            $class->is_finished = 0;
            $class->save();
            return redirect()->back();
        }
        
    }
    public function deactivateClass(Request $request,$id){
        $class = ClassModel::find($id);
        if($class->teacher_id == Auth::user()->username){
            $class->is_finished = 1;
            $class->save();
            return redirect()->back();
        }
    }

    // -------------attnedense_session_list--------------OK
    public function classSessionList(Request $request,$id){ //classid
        $class = ClassModel::find($id); 
        $menu = -1;
        if($class->teacher_id == Auth::user()->username){
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
            return view('teacher.class_sessions_list',compact('class','sessions','session_count','menu'));
        }
    }
    // -------------attendense_edit_session--------------
    public function showEditSessionForm(Request $request,$id){
        $menu = -1;
        $session = Session::with('class')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            $miladi_date = $session->date;
            $miladi_date_array = explode('-', $miladi_date);
            $month = $miladi_date_array[1];
            $day   = $miladi_date_array[2];
            $year  = $miladi_date_array[0];
            $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'/');
            $session->date = $shamsi_date;
            return view('teacher.session_edit',compact('menu','session'));
        }
        
    }
    public function editSession(Request $request,$id){
        $messages = [
            'date.required' => 'تاریخ جلسه وارد نشده است.',
            ];
          $this->validate($request, [
            'date' => 'required',
          ],$messages);
        $menu = -1;
        $session= Session::with('class')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            $shamsi_date = $request->date;
            $shamsi_date_array = explode('/', $shamsi_date);
            $day   = $shamsi_date_array[2];
            $month = $shamsi_date_array[1];
            $year  = $shamsi_date_array[0];
            $miladi_date = $this->jalali_to_gregorian($year,$month,$day,'-');
            $session->date = $miladi_date;
            $session->save();
            return redirect('/teacher/classSessionList/'.$session->class_id);
        }
        
    }

    // -------------attendense_new_session--------------
    public function showNewSessionForm(Request $request,$classId){
        $menu = -1;
        $class = ClassModel::find($classId);
        if($class->teacher_id == Auth::user()->username){
            return view('teacher.session_new',compact('menu','class'));
        }
        
    }
    public function newSession(Request $request,$classId){
        $messages = [
            'date.required' => 'تاریخ جلسه وارد نشده است.',
            ];
          $this->validate($request, [
            'date' => 'required',
          ],$messages);
        $menu = -1;
        $class = ClassModel::find($classId);
        if($class->teacher_id == Auth::user()->username){
            $session = new Session;
            $shamsi_date = $request->date;
            $shamsi_date_array = explode('/', $shamsi_date);
            $day   = $shamsi_date_array[2];
            $month = $shamsi_date_array[1];
            $year  = $shamsi_date_array[0];
            $miladi_date = $this->jalali_to_gregorian($year,$month,$day,'-');
            $session->date = $miladi_date;
            $session->class_id = $class->id;
            $session->save();
            return redirect('/teacher/classSessionList/'.$classId);
        }
        
    }
    public function deleteSession(Request $request,$id){
        $session = Session::with('attendances','class')->find($id);
        $classId = $session->class_id;
        if($session->class->teacher_id == Auth::user()->username){
            foreach($session->attendances as $attendance){
                $attendance->delete();
            }
            $session->delete();
            return redirect('/teacher/classSessionList/'.$classId);
        }
    }
    

    // -------------attnedense_one_session--------------
    public function showAttendanceSessionForm(Request $request,$id){
        $session = Session::with('class','class.students','attendances')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            if($session->attendances->count()>0){
                return redirect('/teacher/attendanceSessionEdit/'.$session->id);
            }
            $miladi_date = $session->date;
            $miladi_date_array = explode('-', $miladi_date);
            $month = $miladi_date_array[1];
            $day   = $miladi_date_array[2];
            $year  = $miladi_date_array[0];
            $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'-');
            $session->date = $shamsi_date;
            $menu = -1;
            return view('teacher.attendance_one_session',compact('session','menu'));
        }
       
    }
    public function attendanceSession(Request $request,$id){
        $session = Session::with('class','class.students')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            foreach($session->class->students as $student){
                $attendance = new Attendance;
                $attendance->session_id = $session->id;
                $attendance->student_id = $student->id;
                $status_id = $student->id.'status';
               
                if($request->$status_id==1){
                    error_log($request->$status_id);
                    $attendance->presentation_status = 1;
                }
                $delay_id = $student->id.'delay';
                if(!empty($request->$delay_id)){
                    $attendance->presentation_status = 1;
                    $attendance->delay_time = $request->$delay_id;
                }
                $attendance->save();
            } 
            return redirect('/teacher/classSessionList/'.$session->class_id);
        }
        
    }
    public function showAttendanceSessionEditForm(Request $request,$id){
        $session = Session::with('class','attendances','attendances.student')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            if($session->attendances->count()==0){
                return redirect('/teacher/attendanceSession/'.$session->id);
            }
            $miladi_date = $session->date;
            $miladi_date_array = explode('-', $miladi_date);
            $month = $miladi_date_array[1];
            $day   = $miladi_date_array[2];
            $year  = $miladi_date_array[0];
            $shamsi_date = $this->gregorian_to_jalali($year,$month,$day,'-');
            $session->date = $shamsi_date;
            $menu = -1;
            return view('teacher.attendance_one_session_edit',compact('session','menu'));
        }
        
    }
    public function attendanceSessionEdit(Request $request,$id){
        $session = Session::with('class','attendances')->find($id);
        if($session->class->teacher_id == Auth::user()->username){
            foreach($session->attendances as $attendance){
                $status_id = $attendance->student_id."status";
                $delay_id = $attendance->student_id."delay";
                if($request->$status_id == 1 || !empty($request->$delay_id)){
                    $attendance->presentation_status = 1;
                }
                else{
                    $attendance->presentation_status = 0;
                }
                $attendance->delay_time = $request->$delay_id;
                $attendance->save();
    
            } 
            return redirect('/teacher/classSessionList/'.$session->class_id);
        }
        
    }
  

    public function signup(Request $request){
        $teacher = new Teacher([
            'username' => 'teacher',
            'password' => bcrypt('teacher'),
            'first_name' => 'first',
            'last_name' => 'last',
        ]);
        
    
        if ($teacher->save()) {    
            return view('welcome');
        }
        else{
            
        }
    }
}
