@extends('layouts.default')

{{-- Page title --}}
@section('title')
    Josh Admin Template
    @parent
@stop

{{-- page level styles --}}
@section('header_styles')


    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/fullcalendar/css/fullcalendar.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/calendar_custom.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jvectormap/css/jquery-jvectormap-1.2.2.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/animate/animate.min.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/css/pages/only_dashboard.css?t=' . time()) }}"/>
    <link rel="stylesheet" href="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/smalotDatepicker/css/bootstrap-datetimepicker.min.css?t=' . time()) }}"/>
    <meta name="_token" content="{{ csrf_token() }}">

@stop

{{-- Page content --}}
@section('content')

    <section class="content-header">
        <h1>Welcome to Dashboard</h1>
        <ol class="breadcrumb">
            <li class="active">
                <a href="{{ route('backend.homepage') }}">
                    <i class="livicon" data-name="home" data-size="16" data-color="#333" data-hovercolor="#333"></i>
                    Dashboard
                </a>
            </li>
        </ol>
    </section>
    <section class="content">
        <div class="row">
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInLeftBig">
                <!-- Trans label pie charts strats here-->
                <div class="lightbluebg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 text-right">
                                    <span>Views Today</span>

                                    <div class="number" id="myTargetElement1"></div>
                                </div>
                                <i class="livicon  pull-right" data-name="eye-open" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement1.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement1.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInUpBig">
                <!-- Trans label pie charts strats here-->
                <div class="redbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Today's Sales</span>

                                    <div class="number" id="myTargetElement2"></div>
                                </div>
                                <i class="livicon pull-right" data-name="piggybank" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement2.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement2.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-sm-6 col-md-6 margin_10 animated fadeInDownBig">
                <!-- Trans label pie charts strats here-->
                <div class="goldbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Subscribers</span>

                                    <div class="number" id="myTargetElement3"></div>
                                </div>
                                <i class="livicon pull-right" data-name="archive-add" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement3.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement3.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 col-sm-6 margin_10 animated fadeInRightBig">
                <!-- Trans label pie charts strats here-->
                <div class="palebluecolorbg no-radius">
                    <div class="panel-body squarebox square_boxs">
                        <div class="col-xs-12 pull-left nopadmar">
                            <div class="row">
                                <div class="square_box col-xs-7 pull-left">
                                    <span>Registered Users</span>

                                    <div class="number" id="myTargetElement4"></div>
                                </div>
                                <i class="livicon pull-right" data-name="users" data-l="true" data-c="#fff"
                                   data-hc="#fff" data-s="70"></i>
                            </div>
                            <div class="row">
                                <div class="col-xs-6">
                                    <small class="stat-label">Last Week</small>
                                    <h4 id="myTargetElement4.1"></h4>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <small class="stat-label">Last Month</small>
                                    <h4 id="myTargetElement4.2"></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--/row-->
        <div class="row ">
            <div class="col-md-8 col-sm-6">
                <div class="panel panel-border">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="dashboard" data-size="20" data-loop="true" data-c="#F89A14"
                               data-hc="#F89A14"></i>
                            Realtime Server Load
                            <small>- Load on the Server</small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div id="realtimechart" style="height:350px;"></div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-sm-6">
                <div class="panel blue_gradiant_bg">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="linechart" data-size="16" data-loop="true" data-c="#fff"
                               data-hc="white"></i>
                            Server Stats
                            <small class="white-text">- Monthly Report</small>
                        </h3>
                    </div>
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_bar"></div>
                                    <h3 class="title">Network</h3>
                                </div>
                            </div>
                            <div class="margin-bottom-10 visible-sm"></div>
                            <div class="margin-bottom-10 visible-sm"></div>
                            <div class="col-sm-6">
                                <div class="sparkline-chart">
                                    <div class="number" id="sparkline_line"></div>
                                    <h3 class="title">Load Rate</h3>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- BEGIN Percentage monitor -->
                <div class="panel green_gradiante_bg ">
                    <div class="panel-heading">
                        <h3 class="panel-title">
                            <i class="livicon" data-name="spinner-six" data-size="16" data-loop="false" data-c="#fff"
                               data-hc="white"></i>
                            Result vs Target
                        </h3>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="row">
                            <div class="col-sm-6 text-center">
                                <h4 class="small-heading">Sales</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-1" data-percent="45"><span
                                        class="percent">45</span>
                            </span>
                            </div>
                            <!-- /.col-sm-4 -->
                            <div class="col-sm-6 text-center">
                                <h4 class="small-heading">Reach</h4>
                            <span class="chart cir chart-widget-pie widget-easy-pie-3" data-percent="25">
                                <span class="percent">25</span>
                            </span>
                            </div>
                            <!-- /.col-sm-4 -->
                        </div>

                        <!-- /.row -->
                    </div>
                    <!-- /.panel-body -->
                </div>
                <!-- END BEGIN Percentage monitor-->
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel panel-success panel-border">
                    <div class="panel-heading  border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="calendar" data-size="16" data-loop="true" data-c="#fff" data-hc="#fff"></i> Calendar
                        </h4>
                    </div>
                    <div class="panel-body">
                        <div id='external-events'></div>
                        <div id="calendar"></div>
                        <div id="fullCalModal" class="modal fade">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">×</span> <span class="sr-only">close</span></button>
                                        <h4 id="modalTitle" class="modal-title"></h4>
                                    </div>
                                    <div id="modalBody" class="modal-body">
                                        <i class="mdi-action-alarm-on"></i>&nbsp;&nbsp;Start: <span id="startTime"></span>&nbsp;&nbsp;- End: <span id="endTime"></span>
                                        <h4 id="eventInfo"></h4>
                                        <br>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-raised btn-danger" data-dismiss="modal">Close</button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="box-footer pad-5">
                            <a href="#" class="btn btn-success btn-block createevent_btn" data-toggle="modal" data-target="#myModal">Create event
                            </a>
                        </div>
                        <!-- Modal -->
                        <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close reset" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title" id="myModalLabel">
                                            <i class="fa fa-plus"></i> Create Event
                                        </h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <input type="text" id="new-event" class="form-control" placeholder="Event">
                                            <div class="input-group-btn">
                                                <button type="button" id="color-chooser-btn" class="color-chooser btn btn-info dropdown-toggle" data-toggle="dropdown">
                                                    Type
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" id="color-chooser">
                                                    <li>
                                                        <a class="palette-primary" href="#">Primary</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-success" href="#">Success</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-info" href="#">Info</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-warning" href="#">warning</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-danger" href="#">Danger</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-default" href="#">Default</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                        <!-- /input-group -->
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger pull-right reset" data-dismiss="modal">
                                            Close
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-success pull-left" id="add-new-event" data-dismiss="modal">
                                            <i class="fa fa-plus"></i> Add
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal fade" id="evt_modal" tabindex="-1" role="dialog" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close reset" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h6 class="modal-title" id="myModalLabel">
                                            <i class="fa fa-plus"></i>
                                            Edit Event
                                        </h6>

                                    </div>
                                    <div class="modal-body">
                                        <div class="input-group">
                                            <input type="text" id="event_title" class="form-control" placeholder="Event">
                                            <div class="input-group-btn">
                                                <button type="button" id="color-chooser-btn_edit" class="color-chooser btn btn-info dropdown-toggle " data-toggle="dropdown">
                                                    Type
                                                    <span class="caret"></span>
                                                </button>
                                                <ul class="dropdown-menu pull-right" id="color-chooser">
                                                    <li>
                                                        <a class="palette-primary" href="#">Primary</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-success" href="#">Success</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-info" href="#">Info</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-warning" href="#">warning</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-danger" href="#">Danger</a>
                                                    </li>
                                                    <li>
                                                        <a class="palette-default" href="#">Default</a>
                                                    </li>
                                                </ul>
                                            </div>
                                            <!-- /btn-group -->
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger float-right" data-dismiss="modal">
                                            Close
                                            <i class="fa fa-times"></i>
                                        </button>
                                        <button type="button" class="btn btn-success pull-left text_save" data-dismiss="modal">
                                            Update
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- To do list -->
            <div class="col-lg-6 col-md-6 col-sm-6">
                <div class="panel panel-primary todolist">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="medal" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Tasks
                        </h4>
                    </div>
                    <div class="panel-body nopadmar">
                        <div class="panel-body">
                            <div class="row list_of_items ">
                            </div>
                        </div>
                        <div class="add_list adds">
                            {{--{!! Form::open(['class'=>'form', 'id'=>'main_input_box']) !!}--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('task_description', 'Task description: ') !!}--}}
                                {{--{!! Form::text('task_description', null, ['class' => 'form-control','id'=>'task_description', 'required' => 'required']) !!}--}}
                            {{--</div>--}}
                            {{--<div class="form-group">--}}
                                {{--{!! Form::label('task_deadline', 'Deadline: ') !!}--}}
                                {{--{!! Form::text('task_deadline', null, ['class' => 'form-control datepicker', 'id'=>'task_deadline', 'data-date-format'=> 'YYYY/MM/DD', 'required' => 'required','autocomplete' => 'off']) !!}--}}
                            {{--</div>--}}
                            {{--<button type="submit" class="btn btn-primary add_button">--}}
                                {{--Add Task--}}
                            {{--</button>--}}
                            {{--{!! Form::close() !!}--}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row ">
            <div class="col-md-4 col-sm-12">
                <div class="panel panel-danger">
                    <div class="panel-heading border-light">
                        <h4 class="panel-title">
                            <i class="livicon" data-name="mail" data-size="18" data-color="white" data-hc="white"
                               data-l="true"></i>
                            Quick Mail
                        </h4>
                    </div>
                    <div class="panel-body no-padding">
                        <div class="compose row">
                            <label class="col-sm-1 col-md-3 hidden-xs" style="padding: 0">To:</label>
                            <input type="text" class="col-sm-11 col-md-9 col-xs-12" placeholder="name@email.com "
                                   tabindex="1"/>

                            <div class="clear"></div>
                            <label class="col-sm-1 col-md-3 hidden-xs" style="padding: 0">Subject:</label>
                            <input type="text" class="col-sm-11 col-md-9 col-xs-12" tabindex="1" placeholder="Subject"/>

                            <div class="clear"></div>
                            <div class='box-body'>
                                <form>
                                    <textarea class="textarea textarea_home resize_vertical"
                                              placeholder="Write mail content here"></textarea>
                                </form>
                            </div>
                            <br/>

                            <div class="pull-right">
                                <a href="#" class="btn btn-danger">Send</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8 col-md-8 col-sm-12">
                <div class="panel panel-border">

                    <div class="panel-heading">
                        <h4 class="panel-title pull-left margin-top-10">
                            <i class="livicon" data-name="map" data-size="16" data-loop="true" data-c="#515763"
                               data-hc="#515763"></i>
                            Visitors Map
                        </h4>

                        <div class="btn-group pull-right">
                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                <i class="livicon" data-name="settings" data-size="16" data-loop="true" data-c="#515763"
                                   data-hc="#515763"></i>
                            </button>
                            <ul class="dropdown-menu" role="menu">
                                <li>
                                    <a class="panel-collapse collapses" href="#">
                                        <i class="fa fa-angle-up"></i>
                                        <span>Collapse</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-refresh" href="#">
                                        <i class="fa fa-refresh"></i>
                                        <span>Refresh</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-config" href="#panel-config" data-toggle="modal">
                                        <i class="fa fa-wrench"></i>
                                        <span>Configurations</span>
                                    </a>
                                </li>
                                <li>
                                    <a class="panel-expand" href="#">
                                        <i class="fa fa-expand"></i>
                                        <span>Fullscreen</span>
                                    </a>
                                </li>
                            </ul>
                        </div>

                    </div>
                    <div class="panel-body nopadmar">
                        <div id="world-map-markers" style="width:100%; height:300px;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="editConfirmModal" tabindex="-1" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <h4 class="modal-title">Alert</h4>
                </div>
                <div class="modal-body">
                    <p>You are already editing a row, you must save or cancel that row before edit/delete a new row</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div>
@stop

{{-- page level scripts --}}
@section('footer_scripts')

    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/moment/js/moment.min.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/smalotDatepicker/js/bootstrap-datetimepicker.min.js?t=').time() }}"></script>

    <!-- EASY PIE CHART JS -->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jquery-easyPieChart/js/easypiechart.min.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jquery-easyPieChart/js/jquery.easypiechart.min.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jquery-easyPieChart/js/jquery.easingpie.js?t=').time() }}"></script>

    <!--for calendar-->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/moment/js/moment.min.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/fullcalendar/js/fullcalendar.min.js?t=').time() }}"></script>
    <!--   Realtime Server Load  -->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/flotchart/js/jquery.flot.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/flotchart/js/jquery.flot.resize.js?t=').time() }}"></script>
    <!--Sparkline Chart-->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/sparklinecharts/jquery.sparkline.js?t=').time() }}"></script>
    <!-- Back to Top-->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/countUp_js/js/countUp.js?t=').time() }}"></script>
    <!--   maps -->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jvectormap/js/jquery-jvectormap-1.2.2.min.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/vendors/bower-jvectormap/js/jquery-jvectormap-world-mill-en.js?t=').time() }}"></script>
    <!--  todolist-->
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/pages/todolist.js?t=').time() }}"></script>
    <script src="{{ asset('/vendor/' . $group_name . '/' . $skin . '/js/pages/dashboard.js?t=').time() }}"></script>

@stop