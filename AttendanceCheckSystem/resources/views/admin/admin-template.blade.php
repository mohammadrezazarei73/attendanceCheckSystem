<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>سیستم مدیریت</title>

    <!-- Bootstrap Core CSS -->
    <link href="{{asset('/res/css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="{{asset('/res/css/plugins/metisMenu/metisMenu.min.css')}}" rel="stylesheet">

    <!-- DataTables CSS -->
    <link href="{{asset('/res/css/plugins/dataTables.bootstrap.css')}}" rel="stylesheet">
    
    <!-- Custom CSS -->
    <link href="{{asset('/res/css/sb-admin-2.css')}}" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="{{asset('/res/css/font-awesome/font-awesome.min.css')}}" rel="stylesheet" type="text/css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->


</head>

<body>
    <div id="wrapper">
    <!-- Navigation -->
    <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href='{{url('/admin/classActives')}}'>سیستم حضور و غیاب</a>
        </div>
        <!-- /.navbar-header -->

        <ul class="nav navbar-top-links navbar-right">
            
          
          
            <!-- /.dropdown -->
            <li class="dropdown">
                <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                    <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                </a>
                <ul class="dropdown-menu dropdown-user">
                    <!--<li><a href="profile_edit.html"><i class="fa fa-user fa-fw"></i> ویرایش اطلاعات کاربری</a>
                    </li>
                   
                    
                    <li class="divider"></li>  -->
                    <li><a class="nav-link" data-toggle="modal" data-target="#myModal"><i class="fa fa-sign-out fa-fw" ></i> خروج</a>
                    </li>

                    <!-- <div class="panel-body"> -->
                        <!-- Button trigger modal -->
                        <!-- <button class="btn btn-primary btn-lg" data-toggle="modal" data-target="#myModal">
                            Launch Demo Modal
                        </button> -->
                        
                        <!-- /.modal -->
                    <!-- </div> -->




                </ul>
                <!-- /.dropdown-user -->
            </li>
            <!-- /.dropdown -->
        </ul>
        <!-- /.navbar-top-links -->

        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse">
                <ul class="nav" id="side-menu">
                    <!-- lists -->
                    <li>
                        
                        <a @if($menu==0 || $menu == 1){{'class=active'}}@endif href="list_classes.html"><i class="fa fa-list fa-fw"></i> لیست کلاس ها<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a @if($menu == 0 ){{'class=active'}}@endif href='{{url('/admin/classFinished')}}'>کلاس های خاتمه یافته</a>
                                </li>
                                <li>
                                    <a @if($menu == 1){{'class=active'}}@endif href='{{url('/admin/classActives')}}'>کلاس های فعال</a>
                                </li>
                            </ul>
                            <!-- /.nav-second-level -->
                        </li>
                    <li>
                        <a  @if($menu == 2){{'class=active'}}@endif href='{{url('/admin/teacherList')}}'><i class="fa fa-list fa-fw"></i> لیست اساتید</a>
                    </li>
                    <li>
                        <a  @if($menu == 3){{'class=active'}}@endif href='{{url('/admin/studentList')}}'><i class="fa fa-list fa-fw"></i> لیست  دانش آموزان</a>
                    </li>
                    <!-- news -->
                    <li>
                        <a  @if($menu == 4){{'class=active'}}@endif href='{{url('/admin/classNew')}}'><i class="fa fa-plus fa-fw"></i> کلاس جدید </a>
                    </li>
                    <li>
                        <a  @if($menu == 5){{'class=active'}}@endif href='{{url('/admin/teacherNew')}}'><i class="fa fa-plus fa-fw"></i> استاد جدید </a>
                    </li>
                    <li>
                        <a  @if($menu == 6){{'class=active'}}@endif href='{{url('/admin/studentNew')}}'><i class="fa fa-plus  fa-fw"></i> دانش آموز جدید </a>
                    </li>
                </ul>
            </div>
            <!-- /.sidebar-collapse -->
        </div>
        <!-- /.navbar-static-side -->
    </nav>
    @yield('content')
    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                    <h4 class="modal-title" id="myModalLabel">خروج از سیستم</h4>
                </div>
                <div class="modal-body">
                    آیا میخواهید خارج شوید؟
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">بستن</button>
                    <a href='{{url('/admin/logout')}}'><button type="button" class="btn btn-primary">بله</button></a>
                </div>
            </div>
            <!-- /.modal-content -->
        </div>
        <!-- /.modal-dialog -->
    </div>
            
    <!-- jQuery Version 1.11.0 -->
    <script src="{{asset('/res/js/jquery-1.11.0.js')}}"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="{{asset('/res/js/bootstrap.min.js')}}"></script>

    <!-- Metis Menu Plugin JavaScript -->
    <script src="{{asset('/res/js/metisMenu/metisMenu.min.js')}}"></script>

    <!-- DataTables JavaScript -->
    <script src="{{asset('/res/js/jquery/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('/res/js/bootstrap/dataTables.bootstrap.min.js')}}"></script>

    <!-- Custom Theme JavaScript -->
    <script src="{{asset('/res/js/sb-admin-2.js')}}"></script>
    

</body>
    @yield('scripts')
</html>
