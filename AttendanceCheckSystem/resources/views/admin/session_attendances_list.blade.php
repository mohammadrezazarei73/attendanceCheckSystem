@extends('admin.admin-template')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست حضور غیاب کلاس {{$session->class->topic}} </h1>
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <form role="form"  >
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
                                        @foreach($session->attendances as $attendance)
                                        <tr class="odd gradeX">
                                            <td>{{$attendance->student->first_name}}</td>
                                            <td>{{$attendance->student->last_name}}</td>
                                            <td>{{$attendance->student->green_cart_number}}</td>
                                            <td><div class="form-group">
                                                <div class="checkbox">
                                                    <label>
                                                        <input type="checkbox" disabled name='{{$attendance->student_id.'status'}}' value ='1' @if($attendance->presentation_status){{'checked'}}@endif>
                                                    </label>
                                                </div>
                                            </div></td>
                                            <td>
                                                <div class="form-group">
                                                    <input class="form-control" type="number" disabled  placeholder="0" name='{{$attendance->student_id.'delay'}}'  value='{{$attendance->delay_time}}'>
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

        