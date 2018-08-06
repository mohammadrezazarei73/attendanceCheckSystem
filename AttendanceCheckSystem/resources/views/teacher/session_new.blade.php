@extends('teacher.teacher-template')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">تعریف جلسه برای کلاس {{$class->topic}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ایجاد جلسه جدید
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
                                <div class="row">
                                        <div class="col-lg-12">
                                            <form role="form" method="post" action='{{ url('/teacher/sessionNew/'.$class->id) }}'>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                
                                                        <div class="row">
                                                        <label class="col-lg-4"> تاریخ این جلسه:  </label>
                                                        </div>
                                                        <div id="add">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <input name="date" id="date_input" class="form-control" placeholder="1397/02/17">
                                                                
                                                            </div>
                                                            
                                                            
                                                        </div>
                                                        <script>
                                                                Calendar.setup({
                                                                    inputField: 'date_input',
                                                                    button: 'date_btn',
                                                                    ifFormat: '%Y/%m/%d',
                                                                    dateType: 'jalali'
                                                                });
                                                        </script>
                                                        
                                                        
                                                  
                                                
                                                
                                        </div>
                                        <!-- /.col-lg-6 (nested) -->
                                      
                                      
                                    </div>
                            <!-- /.row (nested) -->
                            
                        </div>
                        <!-- /.panel-body -->
                        
                    </div>
                    <!-- /.panel -->
                    <div class="panel-footer">
                            <div class="row">
                                <div class="col-lg-12"> 
                                        <button type="submit" class="btn btn-primary">تعریف جلسه</button>
                                    
                                </div>
                            </div>                        
                        </div>
                    </form>
                        
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->
@stop
 

