@extends('layouts.app')
@section('content')

<style>
    /* The actual timeline (the vertical ruler) */
    .timeline {
        position: relative;
        max-width: 1200px;
        margin: 0 auto;
    }

    /* The actual timeline (the vertical ruler) */
    .timeline::after {
        content: '';
        position: absolute;
        width: 6px;
        background-color: gray;
        top: 0;
        bottom: 0;
        /*left: 50%;*/
        margin-left: -3px;
    }

    /* The actual timeline (the vertical ruler) */
    .timeline::before {
        background: white;
    }

    /* Container around content */
    .timeline .container {
        padding: 10px 40px;
        position: relative;
        background-color: inherit;
        /*width: 50%;*/
    }

    /* The circles on the timeline */
    .timeline .container::after {
        content: '';
        position: absolute;
        width: 25px;
        height: 25px;
        right: -17px;
        background-color: white;
        border: 4px solid #FF9F55;
        top: 15px;
        border-radius: 50%;
        z-index: 1;
    }


    /* Place the container to the right */
    .timeline .right {
        right: 1%;
    }

    /* Add arrows to the left container (pointing right) */
    .timeline .left::before {
        content: " ";
        height: 0;
        position: absolute;
        top: 22px;
        width: 0;
        z-index: 1;
        right: 30px;
        border: medium solid white;
        border-width: 10px 0 10px 10px;
        border-color: transparent transparent transparent white;
    }

    /* Add arrows to the right container (pointing left) */
    .timeline .right::before {
        content: " ";
        height: 0;
        position: absolute;
        top: 22px;
        width: 0;
        z-index: 1;
        left: 30px;
        border: medium solid #f0f0f0;
        border-width: 10px 10px 10px 0;
        border-color: transparent #f0f0f0 transparent transparent;
    }

    /* Fix the circle for containers on the right side */
    .timeline .right::after {
        left: -16px;
    }

    /* The actual content */
    .timeline .content {
        padding: 6px 22px;
        background-color: #f0f0f0;
        position: relative;
        border-radius: 6px;
    }

    .dt-button {
        background-color: #333333 !important;
        border: none !important;
    }

    /* Media queries - Responsive timeline on screens less than 600px wide */
    @media screen and (max-width: 600px) {

        /* Place the timelime to the left */
        .timeline::after {
            left: 31px;
        }

        /* Full-width containers */
        .timeline .container {
            width: 100%;
            padding-left: 70px;
            padding-right: 25px;
        }

        /* Make sure that all arrows are pointing leftwards */
        .timeline .container::before {
            left: 60px;
            border: medium solid #f0f0f0;
            border-width: 10px 10px 10px 0;
            border-color: transparent #f0f0f0 transparent transparent;
        }

        /* Make sure all circles are at the same spot */
        .timeline .right::after {
            left: 15px;
        }

        /* Make all right containers behave like the left ones */
        .timeline .right {
            left: 0%;
        }
    }

    .btn-primary .badge {
        color: #000000 !important;
        font-weight: bold !important;
        background-color: #fff;
    }

    .modal-content .modal-header .close {
        margin-top: -25px;
    }

    .dt-buttons {
        background: #333333 !important;
    }

    /* modal background color */
    .fade.in {
        background: black !important;
    }

    /* copy clip path  */
    .clipPath {
        display: block;

    }

    .clipPath #inviteCode.invite-page {
        box-sizing: border-box;
        display: flex;
        flex-direction: row;
        background-color: #fff;
        border: 1px solid #ccc;
        padding: 10px;
        margin-bottom: 10px;
        border-radius: 5px;
        justify-content: space-between;
        width: 100%;
        box-shadow: 0px 1px 2px rgba(0, 0, 0, .07);
    }

    .clipPath #inviteCode.invite-page #link {
        align-self: center;
        font-size: 1.2em;
        color: #333;
        font-weight: bold;
        flex-grow: 2;
        background-color: #fff;
        border: none;
    }

    .clipPath #inviteCode.invite-page #copy {
        width: 30px;
        height: 30px;
        margin-left: 20px;
        border: 1px solid black;
        border-radius: 5px;
        background-color: #f8f8f8;
    }

    .clipPath #inviteCode.invite-page #copy i {
        display: block;
        line-height: 30px;
        position: relative;
    }

    .clipPath #inviteCode.invite-page #copy i::before {
        display: block;
        width: 15px;
        margin: 0 auto;
    }

    .clipPath #inviteCode.invite-page #copy i.copied::after {
        position: absolute;
        top: 0px;
        right: 35px;
        height: 30px;
        line-height: 25px;
        display: block;
        content: "copied";
        font-size: 1.5em;
        padding: 2px 10px;
        color: #fff;
        background-color: #4099ff;
        border-radius: 3px;
        opacity: 1;
        will-change: opacity, transform;
        animation: showcopied 1.5s ease;
    }

    .clipPath #inviteCode.invite-page #copy:hover {
        cursor: pointer;
        background-color: #dfdfdf;
        transition: background-color 0.3s ease-in;
    }

    @keyframes showcopied {
        0% {
            opacity: 0;
            transform: translateX(100%);
        }

        70% {
            opacity: 1;
            transform: translateX(0);
        }

        100% {
            opacity: 0;
        }
    }
    .file-footer-buttons .btn-kv {
        color:white !important;
    }
</style>

 @if(Session::has('AlreadySent'))
      <script>
          alert('All feedback has been recieved');
      </script>
 @endif
<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        @php
        $id = $details->id;
        @endphp

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">PLAN COMPLETION </h5>
            </div>

            <!-- /Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                <a href="{{URL::to('/login')}}" class="pull-right btn btn-primary">BACK</a>
                <button type="button" class="pull-right btn btn-primary" data-toggle="modal" data-target="#attendanceQrModal" id="attendencelink" name="attendencelink"
                @if($checkStatus != null)
                    disabled
                @endif
                >
                    Attendence link
                </button>

                <!-- qr code modal  -->
                <!-- Modal -->
                <div class="modal fade" id="attendanceQrModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div class="">
                                    <h5 class="modal-title" id="exampleModalLabel">Scan here
                                        <span style="font-size: 10px !important; margin-left: 350px !important;"> plan id - {{ $details->activity_id }}</span>
                                    </h5>

                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>

                            </div>
                            <div class="modal-body">
                                <!-- qr code -->
                                <div class="text-center">
                                    {!! QrCode::size(250)->generate($generatedUrl); !!}
                                </div>
                            </div>
                            <div class="modal-footer">
                                <!-- clip path -->
                                <div class="clipPath">
                                    <div id="inviteCode" class="invite-page">

                                        <input id="link" value="{{ $generatedUrl }}" readonly>
                                        <div id="copy">
                                            <i class="fa fa-clipboard" aria-hidden="true" data-copytarget="#link"></i>
                                        </div>
                                    </div>
                                </div>

                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- /Breadcrumb -->

        </div>
        <!-- /Title -->


        <!-- Row -->
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-wrap">
                                        <div class="form-horizontal">
                                            <div class="form-body">
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>General</h6>
                                                <hr class="light-grey-hr" />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Activity date:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->activity_date}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Region:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->region}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Dealer Code:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->dealer_code}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Trainer:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->trainer_name}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Activity Type:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->activity_type}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Module</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->module}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Remarks:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->remarks}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Training Type:</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">{{ $details->training_type}}</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($closed)
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Status</label>
                                                            <div class="col-md-9">
                                                                <p class="form-control-static">Closed</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Uploads</h6>
                                                <hr class="light-grey-hr" />
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Attendance</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="attendance" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->attendance))-1}}</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Site Readiness Documents</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="site_readliness" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->site_readiness))-1}}</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Speed Test</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="speed_test" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->speed_test))-1}}</span></button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Sign Off Documents</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="sign_off_docs" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->sign_off_doc))-1}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Training Photo</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="training_photos" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->training_pics))-1}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Other Documents</label>
                                                            <div class="col-md-9">
                                                                <button class="btn btn-primary fileUploadBtn" id="other_docs" data-toggle="modal" data-target=".bd-example-modal-lg">UPLOAD <span class="badge badge-light">{{count(explode('|||', $details->other_doc))-1}}</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Info</h6>
                                        <hr class="light-grey-hr" />
                                        <form id="work_on_activity_form" class="form-horizontal">
                                            {{csrf_field()}}
                                            <div class="form-body">
                                                <div class="row">
                                                    @if(!$closed)
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Status</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="Open">Open</option>
                                                                    <option value="Cancelled">Cancelled</option>
                                                                    <option value="Closed">Closed</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @endif
                                                    {{-- @php
                                                        @dd($countAttendie);
                                                    @endphp --}}
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Number Of Participants </label>
                                                            <div class="col-md-9">
                                                                <input type="number" name="no_of_participant" id="no_of_participant" class="form-control"
                                                                <?php
                                                                    $date1 = '01-08-2022';
                                                                    if($date1 > $details->activity_date){
                                                                          echo 'readonly';
                                                                    }
                                                                    else{
                                                                       echo '';
                                                                    }
                                                                ?>
                                                                value="{{ $countAttendie }}">
                                                                <input type="hidden" name="activity_id" id="activity_id" value="{{$details->id}}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @if(!$closed)
                                            <div class="form-actions mt-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" id="update_btn" class="btn btn-success  mr-10">Update</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6"> </div>
                                                </div>
                                            </div>
                                            @endif
                                        </form>
                                        <div class="mt-20">
                                            <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Logs</h6>
                                            <hr class="light-grey-hr" />
                                            <div class="timeline">
                                                @foreach($logs as $log)
                                                <div class="container right">
                                                    <div class="content">
                                                        <p style="font-weight:bold;color:black;">{{date('d M Y h:i A',strtotime($log->event_time))}}</p>
                                                        <p>{{$log->description}}</p>
                                                    </div>
                                                </div>
                                                @endforeach
                                            </div>

                                        </div>

                                        <!-- feedback -->
                                        <div class="container-fluid">
                                            <div class="row">
                                                <div class="col-12">
                                                    <hr>

                                                    <form id="sendFeedback-1" style="margin-bottom: 10px !important;" method="POST" action="{{ url('EndTraining') }}">
                                                        {{csrf_field()}}
                                                        <input type="hidden" value="{{ $encodedActivityId }}" name="activity_id" id="activity_id">
                                                         
                                                        <input type="hidden" value="1" name="status" id="status">
                                                         
                                                        <input type="submit" class="btn btn-primary my-2" value="Feedback" id="endTraining">
                                                    </form>

                                                    <p style="margin-bottom: 10px !important;" class="">
                                                        {{-- <a href="{{ route('sendFeedback', $encodedActivityId) }}" class="btn btn-primary my-2">
                                                        End-training
                                                        </a> --}}
                                                        <button class="btn btn-primary my-2" type="button" data-toggle="collapse" data-target="#attendanceSubmissions" aria-expanded="false" aria-controls="attendanceSubmissions">
                                                            Attendence
                                                        </button>
                                                    </p>



                                                    <div class="collapse" id="attendanceSubmissions">
                                                        <div class="card card-body">
                                                            <table class="table" id="datatableAttendence" style="width:100% !important;">
                                                                <thead class="thead-dark">
                                                                    <tr>
                                                                        <th scope="col">Sno</th>
                                                                        <th scope="col">Activity Id</th>
                                                                        <th scope="col">Dealer code</th>
                                                                        <th scope="col">Dms employee id</th>
                                                                        <th scope="col">Name</th>
                                                                        <th scope="col">Designation</th>
                                                                        <th scope="col">location</th>
                                                                        <th scope="col">Mobile number</th>
                                                                        <th scope="col">Feedback received </th>
                                                                        <th scope="col">Average feedback</th>
                                                                        <th scope="col">Feedback remark</th>
                                                                        <th scope="col">Feedback Submit Time</th>
                                                                    </tr>
                                                                </thead>
                                                               
                                                                <tbody>
                                                                    @php
                                                                    $count = 1;
                                                                    $sum = 0;
                                                                    @endphp

                                                                    @foreach($attendies as $attendy)


                                                                    <tr>
                                                                        <th scope="row"> {{ $count++ }}</th>
                                                                        <th scope="row"> {{ $details->activity_id }} </th>
                                                                        <td>{{ $attendy->dealer_code }}</td>
                                                                        <td>{{ $attendy->dms_employee_id }}</td>
                                                                        <td>{{ $attendy->name }}</td>
                                                                        <td>{{ $attendy->designation }} </td>
                                                                        <td>{{ $attendy->location }}</td>
                                                                        <td>{{ $attendy->mobile_no }}</td>

                                                                        <td scope="col">
                                                                            @foreach ($attendy->feedback as $item)
                                                                            @if($item->question_id == '7')
                                                                            @if($item->answer != null)
                                                                            yes
                                                                            @else
                                                                             No
                                                                            @endif
                                                                            @endif
                                                                            @endforeach
                                                                        </td>

                                                                        <td scope="col">
                                                                            @php
                                                                            $i = 0;
                                                                            @endphp
                                                                            @foreach ($attendy->feedback as $item)
                                                                            @if($item->question_id != '7')

                                                                            @php
                                                                            $i = $i+$item->answer;
                                                                            // echo $i;
                                                                            @endphp
                                                                            @endif
                                                                            @endforeach
                                                                            @php
                                                                            echo $i/5;
                                                                            @endphp </td>

                                                                        <td scope="col">
                                                                            @foreach ($attendy->feedback as $item)
                                                                            @if($item->question_id == '7')
                                                                            {{ $item->answer }}
                                                                            @endif
                                                                            @endforeach
                                                                        </td>
                                                                        <td>{{ date('d-M-Y h:i A',strtotime($attendy->created_at)) }}</td>
                                                                    </tr>
                                                                    @endforeach

                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->

    </div>
    <div class="modal fade bd-example-modal-lg" id="myModal" style="margin:0;" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog" style="width:100%;margin:0;padding:0;height:100%;overflow-y:scroll;">
            <div class="modal-content" style="height: auto;min-height:100%;">
                <div class="modal-header">
                    <h5 class="modal-title" id="modal_Title_File" style="float:left;">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close" style="font-size: 40px;color: red;opacity:1;">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data">
                        <div class="form-group">
                            <div class="file-loading">
                                <label>Preview File Icon</label>
                                <input id="file-3" name="file-3" type="file" multiple>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- copy clippath code-->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"> </script>
<script>
    $('#copy').on('click', function(event) {
        console.log(event);
        copyToClipboard(event);
    });

    // event handler
    function copyToClipboard(e) {
        // alert('this function was triggered');
        // find target element
        var
            t = e.target
            , c = t.dataset.copytarget
            , inp = (c ? document.querySelector(c) : null);
        console.log(inp);
        // check if input element exist and if it's selectable
        if (inp && inp.select) {
            // select text
            inp.select();
            try {
                // copy text
                document.execCommand('copy');
                inp.blur();

                // copied animation
                t.classList.add('copied');
                setTimeout(function() {
                    t.classList.remove('copied');
                }, 1500);
            } catch (err) {
                //fallback in case exexCommand doesnt work
                alert('please press Ctrl/Cmd+C to copy');
            }

        }

    }

</script>

<!-- /Main Content -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/qrcodejs/1.0.0/qrcode.min.js" integrity="sha512-CNgIRecGo7nphbeZ04Sc13ka07paqdeTu0WR1IM4kNcpmBAUSHSQX0FslNhTDadL4O5SAGapGt4FodqL8My0mA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script type="text/javascript">
    var qrcode = new QRCode(document.getElementById("qrcode"), {
        text: "http://jindo.dev.naver.com/collie"
        , width: 128
        , height: 128
        , colorDark: "#000000"
        , colorLight: "#ffffff"
        , correctLevel: QRCode.CorrectLevel.H
    });

</script>
@endsection
