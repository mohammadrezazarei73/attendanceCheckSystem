@extends('admin.admin-template')
@section('content')

        <div id="page-wrapper">
                <div class="row">
                    <div class="col-lg-12">
                        <h1 class="page-header"> دانش آموز جدید</h1>
                    </div>
                    <!-- /.col-lg-12 -->
                </div>
                <!-- /.row -->
                <div class="row">
                    <div class="col-lg-12">
                        <div class="panel panel-default">
                            <div class="panel-heading">
                                فرم دانش آموز جدید
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
                                <form role="form" method="post" action="{{ url('/admin/studentNew') }}">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>نام: </label>
                                                <input class="form-control" name="name" value="{{ old('name')}}">
                                            </div>
                                        </div>
                                    </div>
    
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>نام خانوادگی: </label>
                                                <input class="form-control" name="family" value="{{ old('family')}}">
                                            </div>
                                        </div>
                                    </div>   
                                    <div class="row" >
                                        <div class="col-lg-6">
                                            <div class="form-group" >
                                                <label>شماره کارت سبز:  </label>
                                                <input class="form-control" name="green_cart_number" value="{{ old('green_cart_number')}}">
                                            </div>
                                         </div>
                                    </div>          
<div>
              
                       
                                
                                            
                                 
                                           
                
                                    <button type="submit" class="btn btn-default">ایجاد دانش آموز </button>
                                </form>    
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
@stop 
