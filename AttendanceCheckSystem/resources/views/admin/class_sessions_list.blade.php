@extends('admin.admin-template')
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
                                            <th>مشاهده ی حضور غیاب</th>
                                            <th>دریافت گزارش حضور و غیاب</th>
                                            
            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($sessions as $session)
                                        <tr>
                                            <td>{{$session_count}}</td><?php $session_count-=1  ?>
                                            <td>{{$session->date}}</td>
                                           
                                            <td class="center"><a href='{{url('/admin/sessionAttendanceList/'.$session->id)}}'><button type="button" class="btn btn-info">مشاهده</button></a></td>
                                            <td class="center"><a href='{{url('/admin/sessionCreateExcel/'.$session->id)}}'><button type="button" class="btn btn-success">دریافت</button></a></td>
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

