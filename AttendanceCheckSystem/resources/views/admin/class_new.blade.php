@extends('admin.admin-template')
@section('content')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header">کلاس جدید</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فرم کلاس جدید
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
                                    <form role="form" method="post" action="{{ url('/admin/classNew') }}">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">	
                                        <div class="row" >
                                            <div class="col-lg-6">
                                                <div class="form-group" >
                                                    <label>عنوان کلاس:</label>
                                                    <input class="form-control" name="topic" value="{{ old('topic')}}">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row" >
                                            <p class="help-block">لطفا زمان شروع و پایانی که به عنوان ساعت اصلی کلاس در نظر گرفته اید را در این جا وارد کنید.</p>
                                            <div class="col-lg-3">
                                                <div class="form-group" >
                                                        <label>زمان پیش فرض شروع کلاس: </label>
                                                        <input class="form-control" placeholder="مثال: 12:30"  name="start_time" value="{{ old('start_time')}}">
                                                </div>
                                            </div>
                                            <div class="col-lg-3">
                                                <div class="form-group" >
                                                        <label>زمان پیش فرض پایان کلاس: </label>
                                                        <input class="form-control" placeholder="مثال: 14:00" name="end_time" value="{{ old('end_time')}}">
                                                        
                                                </div>
                                            </div>
                                           
                                        </div>
                                        
                                        <div class="row" >
                                            <div class="col-lg-12">
                                                    <div class="form-group">
                                                            <label>روز های پیش فرض برگزاری کلاس: </label>&nbsp;
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="saturday" value="1"  @if(old('saturday')){{'checked'}}@endif>شنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="sunday" value="1" @if(old('sunday')){{'checked'}}@endif>یکشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="monday" value="1" @if(old('monday')){{'checked'}}@endif>دوشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="tuesday" value="1" @if(old('tuesday')){{'checked'}}@endif>سه شنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="wednesday" value="1" @if(old('wednesday')){{'checked'}}@endif>چهارشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="thursday" value="1" @if(old('thursday')){{'checked'}}@endif>پنجشنبه
                                                            </label>
                                                            <label class="checkbox-inline">
                                                                <input type="checkbox" name="friday" value="1" @if(old('friday')){{'checked'}}@endif>جمعه
                                                            </label>
                                                    </div>
                                            </div>
                                        </div>
                                        <div class="row" >
                                                <div class="col-lg-12">
                                                        <div class="form-group">
                                                                <label>فصل برگزاری کلاس</label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline1" value="بهار" @if(old('semester')=='بهار'){{'checked'}}@endif>بهار
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline2" value="تابستان" @if(old('semester')=='تابستان'){{'checked'}}@endif>تابستان
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline3" value="پاییز" @if(old('semester')=='پاییز'){{'checked'}}@endif>پاییز
                                                                </label>
                                                                <label class="radio-inline">
                                                                    <input type="radio" name="semester" id="optionsRadiosInline3" value="زمستان" @if(old('semester')=='زمستان'){{'checked'}}@endif>زمستان
                                                                </label>
                                                            </div>
                                                </div>
                                            </div>
                                            <div class="row" >
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                                <label>سال برگزاری کلاس:</label>
                                                                <input class="form-control" name="year" placeholder="مثال: 1397" valuie="{{old('year')}}">
                                                            </div>
                                                </div>
                                            </div>
                                        <div class="row" >
                                                <div class="col-lg-6">
                                                        <div class="form-group">
                                                                <label>استاد درس: </label>
                                                                <select class="form-control" name="teacher">
                                                                @foreach($teachers as $teacher)
                                                                    <option value='{{$teacher->username}}' @if(old('teacher')==($teacher->username)){{'selected'}}@endif>{{$teacher->first_name}} {{$teacher->last_name}}</option>
                                                                @endforeach
                                                                </select>
                                                        </div>
                                                </div>
                                        </div>
                                        
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
                                        <script>
                                                function myFunction(clicked_id) {
                                                    var new_id = Number(clicked_id)+1;
                                                //    alert(clicked_id);
                                                    document.getElementById("btn"+clicked_id).className = "hidden";
                                                    document.getElementById("adding"+clicked_id).innerHTML=('<div class="row"><div class="form-group col-lg-6">  <select name="select'+new_id+'" class="form-control">'+@foreach($students as $student)'<option value='+'{{$student->id}}'+'>'+'{{$student->first_name}}'+ ' {{$student->last_name}}'+'</option>'+@endforeach'</select>&nbsp;&nbsp;&nbsp;</div><div class="col-lg-6"><div id="btn'+new_id+'" class="">          <button onclick="myFunction(this.id)" id="'+new_id+'" name="'+new_id+'" type="button" data-toggle="tooltip" title="Add Content" class="btn btn-warning"><i class="fa fa-plus-circle"></i>افزودن </button></div></div></div><div id="adding'+new_id+'"></div>');
                                                }
                                        </script> 
                                          
                                        
                                        <button type="submit" class="btn btn-default">ایجاد کلاس</button>
                                    </form>
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

@stop
