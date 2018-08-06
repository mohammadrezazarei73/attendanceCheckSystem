@extends('admin.admin-template')
@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست دانش آموزان {{$class->topic}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            جدول اطلاعات دانش آموزان
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>نام</th>
                                            <th> نام خانوادگی
                                            </th>
                                            <th>کارت سبز</th>
                                            <th>لیست کلاس های ثبت نامی</th>
                                            <th>ویرایش اطلاعات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($class->students as $student)
                                        <tr class="odd gradeX">
                                            <td>{{$student->first_name}}</td>
                                            <td>{{$student->last_name}}</td>
                                            <td>{{$student->green_cart_number}}</td>
                                            <td class="center"><a href='{{url('/admin/studentClassesList/'.$student->id)}}'><button type="button" class="btn btn-info">لیست کلاس ها</button></a></td>
                                            <td class="center"><a href='{{url('/admin/studentEdit/'.$student->id)}}'><button type="button" class="btn btn-warning">ویرایش</button></a></td>
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

    <!-- Page-Level Demo Scripts - Tables - Use for reference -->
@stop

@section('scripts')
    <script>
        $(document).ready(function() {
          $('#dataTables-example').dataTable();
        });
    </script>

@stop