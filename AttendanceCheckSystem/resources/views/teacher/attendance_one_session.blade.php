@extends('teacher.teacher-template')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست حضور غیاب کلاس {{$session->class->topic}} </h1>
                    <div class="alert alert-info">
                        <b>توجه:</b>
                         لطفا پس از حضور و غیاب دکمه ثبت را بزنید. 
                    </div>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <form role="form" method="post" action='{{ url('/teacher/attendanceSession/'.$session->id) }}' >
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <div class="panel-heading">
                        تاریخ جلسه: <div>{{$session->date}}</div>
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th>نام خانوادگی</th>
                                            <th>شماره کارت سبز</th>
                                            <th>حضور</th>
                                            <th>تأخیر (به دقیقه)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($session->class->students as $student)
                                        <tr class="odd gradeX">
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->last_name}}</td>
                                            <td>{{$student->green_cart_number}}</td>
                                            <td><div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" name='{{$student->id.'status'}}' value ='1'>
                                                    </label>
                                                </div>
                                            </div></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" type="number" placeholder="10" name='{{$student->id.'delay'}}'>
                                                </div>
                                            </td>
                                        </tr>
                                        @endforeach
                                       
                                        
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.table-responsive -->
                            
                        </div>
                        <!-- /.panel-body -->
                        <div class="panel-footer">
                            <button type="submit" class="btn btn-success">ثبت</button>
                        </div>
                        </form>
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

        