@extends('admin.admin-template')
@section('content')
    
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">لیست اساتید</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            جدول اطلاعات اساتید
                        </div>
                        <!-- /.panel-heading -->
                        <div class="panel-body">
                            <div class="table-responsive">
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <thead>
                                        <tr>
                                            <th>نام استاد</th>
                                            <th>نام خانوادگی استاد</th>
                                            <th>ویرایش اطلاعات استاد</th>
                                            <th>لیست کلاس های استاد</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($teachers as $teacher)
                                            <tr class="odd gradeX">
                                                <td>{{$teacher->first_name}}</td>
                                                <td>{{$teacher->last_name}}</td>
                                                <td><a href='{{url('/admin/teacherEdit/'.$teacher->username)}}'><button type="button" class="btn btn-warning"><i class="fa fa-edit"></i> ویرایش</button></a></td>
                                                <td><a href='{{url('/admin/teacherClassesList/'.$teacher->username)}}'><button type="button" class="btn btn-info">لیست کلاس ها</button></a></td>
                        
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