@extends('admin.admin-template')
@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> ویرایش مشخصات {{$teacher->first_name}} {{$teacher->last_name}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فرم ویرایش استاد
                        </div>
                        <div class="panel-body">
                            @if (count($errors) > 0)
                                <div class="alert alert-danger">
                                    <ul>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </ul>
                                </div>
                            @endif
                            <form role="form" method="post" action='{{ url('/admin/teacherEdit/'.$teacher->username) }}'>
                                <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                <div class="row" >
                                    <div class="col-lg-6">
                                        <div class="form-group" >
                                            <label>نام: </label>
                                            <input class="form-control" name="name" value="{{$teacher->first_name}}">
                                        </div>
                                    </div>
                                </div>

                                <div class="row" >
                                    <div class="col-lg-6">
                                        <div class="form-group" >
                                            <label>نام خانوادگی: </label>
                                            <input class="form-control" name="family" value="{{$teacher->last_name}}">
                                        </div>
                                    </div>
                                </div>   
                                 
                                <div class="row" >
                                    <div class="col-lg-6">
                                        <div class="form-group" >
                                            <label>کلمه عبور: </label>
                                            <input class="form-control" type="password" placeholder="حداقل 6 کاراکتر" name="password">
                                        </div>
                                    </div>
                                </div>
                                     
<div>            
                                <button type="submit" class="btn btn-default">ویرایش استاد</button>
                            </form>    
                            <a class="nav-link" data-toggle="modal" data-target="#delete"><button type="button" class="btn btn-danger">حذف استاد</button></a>
                        </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- /.panel -->
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->


    <!-- /#wrapper -->
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">حذف استاد</h4>
                </div>
                <div class="modal-body">
                     در صورت حدف، تمام رکودهای کلاس و حضور و غیاب های مربوط به استاد حذف میگردد. آیا از حذف استاد از سیستم اطمینان دارید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href='{{url('/admin/teacherDelete/'.$teacher->username)}}'><button type="button" class="btn btn-info">بله</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div> 
@stop