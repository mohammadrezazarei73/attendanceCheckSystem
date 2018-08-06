@extends('admin.admin-template')
@section('content')
        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">ویرایش کلاس {{$class->topic}}</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فرم ویرایش کلاس 
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
                                    <form role="form" method="post" action='{{ url('/admin/classEdit/'.$class->id) }}' >
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                        <div class="row" >
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label>عنوان کلاس:</label>
                                                    <input class="form-control" name="topic" value='{{$class->topic}}'> 
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" >
                                            <p class="help-block">لطفا زمان شروع و پایانی که به عنوان ساعت اصلی کلاس در نظر گرفته اید را در این جا وارد کنید.</p>
                                            <div class="col-lg-3">
                                                <div class="form-group" >
                                                        <label>زمان پیش فرض شروع کلاس: </label>
                                                        <input class="form-control"  name="start_time" value="{{$class->start_time}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group" >
                                                        <label>زمان پیش فرض پایان کلاس: </label>
                                                        <input class="form-control"  name="end_time" value="{{$class->end_time}}">
                                                        
                                                </div>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="row" >
                                            <div class="col-lg-12">
                                                    <div class="form-group">
                                                            <label>روز های پیش فرض برگزاری کلاس: </label>&nbsp;
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="saturday" value="1"  @if($class->saturday){{'checked'}}@endif>شنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="sunday" value="1" @if($class->sunday){{'checked'}}@endif>یکشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="monday" value="1" @if($class->monday){{'checked'}}@endif>دوشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="tuesday" value="1" @if($class->tuesday){{'checked'}}@endif>سه شنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="wednesday" value="1" @if($class->wednesday){{'checked'}}@endif>چهارشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="thursday" value="1" @if($class->thursday){{'checked'}}@endif>پنجشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="friday" value="1" @if($class->friday){{'checked'}}@endif>جمعه
                                                            </label>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-lg-12">
                                                        <div class="form-group">
                                                                <label>فصل برگزاری کلاس</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline1" value="بهار" @if($class->semester=='بهار'){{'checked'}}@endif>بهار
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline2" value="تابستان" @if($class->semester=='تابستان'){{'checked'}}@endif>تابستان
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline3" value="پاییز" @if($class->semester=='پاییز'){{'checked'}}@endif>پاییز
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline3" value="زمستان" @if($class->semester=='زمستان'){{'checked'}}@endif>زمستان
                                                                </label>
                                                            </div>
                                                </div>
                                            </div>
                                        <div class="row" >
                                            <div class="col-lg-6">
                                                    <div class="form-group">
                                                            <label>سال برگزاری کلاس:</label>
                                                            <input class="form-control" name="year" value="{{$class->year}}">
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                                <label>استاد درس: </label>
                                                                <select class="form-control" name="teacher">
                                                                @foreach($teachers as $teacher)
                                                                    <option value='{{$teacher->username}}' @if($class->teacher->username==($teacher->username)){{'selected'}}@endif>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                                                                @endforeach
                                                                </select>
                                                        </div>
                                                </div>
                                        </div>
                                        
                                        <div class="row">
                                            <label class="col-lg-4">دانش آموزان: </label>
                                        </div>
                                        @foreach($class->students as $student)
                                            <div class="row">
                                            
                                                <div class="form-group col-lg-6">
                                                    <label>{{$student->first_name}} {{$student->last_name}}</label>
                                                </div>
                                                <div class="col-lg-2">
                                                    <a href='{{url('/admin/classRemoveStudent/'.$class->id.'/'.$student->id)}}'><button  type="button"  title="Add Content" class="btn btn-danger"><i class="fa fa-minus-circle"></i> حذف  </button></a>
                                                </div>
                                            </div>
                                        @endforeach
                                       
                                        <div id="n">
                                        <div class="row">
                                                <label class="col-lg-4"> دانش آموزان کلاس: </label>
                                                    </div>
                                                <div id="adding">
                                                <div class="row">
                                                    <div class="form-group col-lg-6">
                                                    <select name="select1" class="form-control">
                                                        @foreach($students as $student)
                                                            <option value='{{$student->id}}'>{{$student->first_name}} {{$student->last_name}}</option>
                                                        @endforeach
                                                    </select>
                                                        &nbsp;&nbsp;&nbsp;
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div id="btn1" class="">
                                                        <button onclick="myFunction(this.id)" id="1" name="1" type="button" data-toggle="tooltip" title="Add Content" class="btn btn-warning"><i class="fa fa-plus-circle"></i>افزودن </button></div></div>
                                                    
                                                </div>
                                                
                                                <div id="adding1"></div>    
                                                </div>
                                        </div>
                                        </div>
                                        <script>
                                                function myFunction(clicked_id) {
                                                    var new_id = Number(clicked_id)+1;
                                                //    alert(clicked_id);
                                                    document.getElementById("btn"+clicked_id).className = "hidden";
                                                    document.getElementById("adding"+clicked_id).innerHTML=('<div class="row"><div class="form-group col-lg-6">  <select name="select'+new_id+'" class="form-control">'+@foreach($students as $student)'<option value='+'{{$student->id}}'+'>'+'{{$student->first_name}}'+ ' {{$student->last_name}}'+'</option>'+@endforeach'</select>&nbsp;&nbsp;&nbsp;</div><div class="col-lg-6"><div id="btn'+new_id+'" class="">          <button onclick="myFunction(this.id)" id="'+new_id+'" name="'+new_id+'" type="button" data-toggle="tooltip" title="Add Content" class="btn btn-warning"><i class="fa fa-plus-circle"></i>افزودن </button></div></div></div><div id="adding'+new_id+'"></div>');
                                                }
                                        </script> 
                                          
                                        
                                        <button type="submit" class="btn btn-default">ویرایش کلاس</button>
                                    </form>
                                    <a class="nav-link" data-toggle="modal" data-target="#delete"><button type="button" class="btn btn-danger">حذف کلاس</button></a>
                                </div>
                                <!-- /.col-lg-6 (nested) -->
                              
                              
                            </div>
                            <!-- /.row (nested) -->
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
    <div class="modal fade" id="delete" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="deleteModalLabel">حذف کلاس</h4>
                </div>
                <div class="modal-body">
                     در صورت حذف، تمام رکودهای حضور و غیاب کلاس حذف میگردد. آیا از حذف کلاس از سیستم اطمینان دارید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href='{{url('/admin/classDelete/'.$class->id)}}'><button type="button" class="btn btn-danger">بله</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
</div> 
@stop