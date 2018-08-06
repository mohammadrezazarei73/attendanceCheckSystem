@extends('admin.admin-template')
@section('content')

        <div id="page-wrapper">
            <div class="row">
                <div class="col-lg-12">
                    <h1 class="page-header"> استاد جدید</h1>
                </div>
                <!-- /.col-lg-12 -->
            </div>
            <!-- /.row -->
            <div class="row">
                <div class="col-lg-12">
                    <div class="panel panel-default">
                        <div class="panel-heading">
                            فرم استاد جدید
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
                            
                            <form role="form" method="post" action="{{ url('/admin/teacherNew') }}">
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
                                            <label>نام کاربری: </label>
                                            <input class="form-control" name="username" value="{{ old('username')}}">
                                        </div>
                                     </div>
                                </div>          
                                <div class="row" >
                                    <div class="col-lg-6">
                                        <div class="form-group" >
                                            <label>کلمه عبور: </label>
                                            <input class="form-control" name="password" type="password">
                                        </div>
                                    </div>
                                </div>
          
                   
                            
                                        
                             
                                       
            
                                <button type="submit" class="btn btn-default">ایجاد استاد</button>
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
@section('scripts')
<script>
    $(document).ready(function(){
    $("#btn1").click(function(){
        $("#pic2").removeClass("hidden");
    });
    $("#btn2").click(function(){
        $("#pic3").removeClass("hidden");
    });
    $("#btn3").click(function(){
        $("#pic4").removeClass("hidden");
    });
    $("#btn4").click(function(){
        $("#pic5").removeClass("hidden");
    });
    $("#btn5").click(function(){
        $("#pic6").removeClass("hidden");
    });
    $("#btn6").click(function(){
        $("#pic7").removeClass("hidden");
    });
    $("#btn7").click(function(){
        $("#pic8").removeClass("hidden");
    });
    $("#btn8").click(function(){
        $("#pic9").removeClass("hidden");
    });
        });
    </script>
<script>
    $(function()
{
	$('.scroll-pane').jScrollPane();
});
</script>

<script>
    $(document).ready(function(){
        $("#moshaver").click(function(){
        $("#m").removeClass("hidden");
    });
        $("#nazer").click(function(){
        $("#na").removeClass("hidden");
    });
});
    </script>
        <script>
            $(document).ready(function() {
                $('#dataTables-example').DataTable({
                        responsive: true
                });
            });
            </script>
            <script type="text/javascript">
          $(document).ready(function() {
            $('#code_preview0').summernote({height: 300});
            });
        </script>
    <script src='https://cdnjs.cloudflare.com/ajax/libs/summernote/0.6.6/summernote.min.js'></script>
@stop     
</html>
