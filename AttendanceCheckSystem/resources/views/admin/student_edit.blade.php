@extends('admin.admin-template')
@section('content')

        <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> ویرایش مشخصات {{$student->first_name}} {{$student->last_name}}</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                               فرم ویرایش دانش آموز
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
                                <form role="form" method="post" action='{{ url('/admin/studentEdit/'.$student->id) }}'>
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>نام: </label>
                                                <input class="form-control" name="name" value='{{$student->first_name}}'>
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>نام خانوادگی: </label>
                                                <input class="form-control" name="family" value='{{$student->last_name}}'>
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>شماره کارت سبز:  </label>
                                                <input class="form-control" name="green_cart_number" value='{{$student->green_cart_number}}'>
                                            </div>
                                         </div>
                                    </div>          
<div>
                                    <button type="submit" class="btn btn-default">ویرایش دانش آموز </button>
                                </form>    
                                <a class="nav-link" data-toggle="modal" data-target="#delete"><button type="button" class="btn btn-danger">حذف</button></a>
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

    </div>
    <!-- /#wrapper -->
<!-- Modal -->
<div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">حذف دانش آموز</h4>
                </div>
                <div class="modal-body">
                     در صورت حدف، تمام رکودهای کلاس مربوط به دانش آموز حذف میگردد. آیا از حدف دانش آموز از سیستم اطمینان دارید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href='{{url('/admin/studentDelete/'.$student->id)}}'><button type="button" class="btn btn-danger">بله</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div> 
@stop 