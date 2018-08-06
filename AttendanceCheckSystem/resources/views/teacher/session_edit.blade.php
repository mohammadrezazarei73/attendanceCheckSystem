@extends('teacher.teacher-template')
@section('content')
<div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ویرایش تاریخ جلسه</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            ویرایش تاریخ جلسه 
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
                                        <form role="form" method="post" action='{{ url('/teacher/sessionEdit/'.$session->id) }}'>
                                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                                
                                                        <div class="row">
                                                        <label class="col-lg-4"> تاریخ این جلسه:  </label>
                                                        </div>
                                                        <div id="add">
                                                        <div class="row">
                                                            <div class="form-group col-lg-6">
                                                                <input name="date" id="date_input" class="form-control" placeholder="1397/02/17" value={{$session->date}}>
                                                                
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
                                        <button type="submit" class="btn btn-primary">ویرایش این تاریخ</button>
                                        </form>  
                                        <a class="nav-link" data-toggle="modal" data-target="#delete"><button type="button" class="btn btn-danger">حذف</button></a>                                                       
                                </div>
                                
                                
                            </div>   
                                
                            
                        </div>
                    
                    
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->

    </div>
    <!-- /#wrapper -->

    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">حذف دانش آموز</h4>
                </div>
                <div class="modal-body">
                     در صورت حدف، تمام رکودهای حذور و غیاب جلسه حذف میگردد. آیا از حدف جلسه از سیستم اطمینان دارید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href='{{url('/teacher/sessionDelete/'.$session->id)}}'><button type="button" class="btn btn-danger">بله</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div> 
@stop
