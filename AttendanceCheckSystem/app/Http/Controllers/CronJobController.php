<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Carbon\Carbon;
use App\ClassModel;
use App\Session;
class CronJobController extends Controller
{
    public function createSessions(Request $request){
        $date_saturday = new Carbon('next Saturday');
        $date_saturday2 = $date_saturday->format("Y-m-d");

        $date_sunday = new Carbon('next Sunday');
        $date_sunday2 = $date_sunday->format("Y-m-d");

        $date_monday = new Carbon('next Monday');
        $date_monday2 = $date_monday->format("Y-m-d");

        $date_tuesday = new Carbon('next Tuesday');
        $date_tuesday2 = $date_tuesday->format("Y-m-d");

        $date_wednesday= new Carbon('next Wednesday');
        $date_wednesday2 = $date_wednesday->format("Y-m-d");

        $date_thursday = new Carbon('next Thursday');
        $date_thursday2 = $date_thursday->format("Y-m-d");

        $date_friday = new Carbon('next Friday');
        $date_friday2 = $date_friday->format("Y-m-d");


        $classes = ClassModel::where('is_finished',0)->get();

        foreach($classes as $class){
            if($class->saturday == 1){
                $session = new Session;
                $session->date = $date_saturday2;
                $session->class_id = $class->id;
                $session->save();
            }
            if($class->sunday == 1){
                $session = new Session;
                $session->date = $date_sunday2;
                $session->class_id = $class->id;
                $session->save();
            }
            if($class->monday == 1){
                $session = new Session;
                $session->date = $date_monday2;
                $session->class_id = $class->id;
                $session->save();
            }
            if($class->tuesday == 1){
                $session = new Session;
                $session->date = $date_tuesday2;
                $session->class_id = $class->id;
                $session->save(); 
            }
                
            if($class->wednesday == 1){
                $session = new Session;
                $session->date = $date_wednesday2;
                $session->class_id = $class->id;
                $session->save();
            }
                
            if($class->thursday == 1){
                $session = new Session;
                $session->date = $date_thursday2;
                $session->class_id = $class->id;
                $session->save();
            }
               
            if($class->friday == 1){
                $session = new Session;
                $session->date = $date_friday2;
                $session->class_id = $class->id;
                $session->save();
            }
                
        }

    }
}
