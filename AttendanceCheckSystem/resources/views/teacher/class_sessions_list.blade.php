@extends('teacher.teacher-template')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست جلسات کلاس {{$class->topic}} - @if($class->saturday == 1)شنبه@endif
                                                @if($class->sunday == 1)یکشنبه@endif
                                                @if($class->monday == 1)دوشنبه@endif
                                                @if($class->tuesday == 1)سه شنبه@endif
                                                @if($class->wednesday == 1)چهارشنبه@endif
                                                @if($class->thursday == 1)پنج شنبه@endif
                                                @if($class->friday == 1)جمعه@endif</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            <div class="row">
                            <div class="col-lg-10">
                                لیست جلسات کلاس {{$class->topic}}
                            </div>
                            <div class="col-lg-2">
                                <a href='{{url('/teacher/sessionNew/'.$class->id)}}'><button type="button" class="btn btn-success">تعریف جلسه جدید</button></a>
                            </div>
                            </div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>تاریخ برگزاری جلسه</th>
                                            <th>حضور غیاب</th>
                                            <th>ویرایش جلسه</th>
                                            
            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sessions as $session)
                                        <tr>
                                            <td>{{$session_count}}</td><?php $session_count-=1  ?>
                                            <td>{{$session->date}}</td>
                                            <td>
                                            @if($session->has_attendance==0)<a href='{{url('/teacher/attendanceSession/'.$session->id)}}'><button type="button" class="btn btn-primary">حضور و غیاب  </button>
                                            @else <a href='{{url('/teacher/attendanceSessionEdit/'.$session->id)}}'><button type="button" class="btn btn-primary">ویرایش حضور و غیاب</button>
                                            @endif
                                            </td>
                                            <td class="center"><a href='{{url('/teacher/sessionEdit/'.$session->id)}}'><button type="button" class="btn btn-warning">ویرایش این جلسه</button></a></td>
                                            
                                           
                                        </tr>
                                        @endforeach    


                                       
                                        
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@stop

