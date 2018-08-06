@extends('admin.admin-template')
@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست کلاس های فعال</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            جدول اطلاعات کلاس ها
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>اسم کلاس</th>
                                            <th>روز برگزاری کلاس</th>
                                            <th>اسم استاد</th>
                                            <th>فصل برگزاری کلاس</th>
                                            <th>ساعت برگزاری کلاس</th>
                                            <th>مشاهده ی جلسات کلاس</th>
                                            <th> ویرایش</th>
                                            <th>غیر فعال کردن کلاس</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($classes as $class)
                                            <tr>
                                                <td>{{$class->topic}}</td>
                                                <td>@if($class->saturday == 1)شنبه@endif
                                                @if($class->sunday == 1)یکشنبه@endif
                                                @if($class->monday == 1)دوشنبه@endif
                                                @if($class->tuesday == 1)سه شنبه@endif
                                                @if($class->wednesday == 1)چهارشنبه@endif
                                                @if($class->thursday == 1)پنج شنبه@endif
                                                @if($class->friday == 1)جمعه@endif</td>
                                                <td>{{$class->teacher->first_name}} {{$class->teacher->last_name}}</td>
                                                <td>{{$class->semester}}</td>
                                                <td class="center">{{$class->start_time}}-{{$class->end_time}}</td>
                                                <td class="center"><a href='{{url('/admin/classSessionList/'.$class->id)}}'><button type="button" class="btn btn-info">مشاهده ی جلسات</button></a></td>
                                                <td class="center"><a href='{{url('/admin/classEdit/'.$class->id)}}'><button type="button" class="btn btn-warning">ویرایش</button></a></td>
                                                <td class="center"><a href='{{url('/admin/classDeactivate/'.$class->id)}}'><button type="button" class="btn btn-danger">غیر فعال کردن این کلاس</button></a></td>
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
@section('scripts')
    <script>
        $(document).ready(function() {
          $('#dataTables-example').dataTable();
        });
    </script>

@stop