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
</style>

<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">
        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">Feedback</h5>
            </div>
            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">

            </div>
            <!-- /Breadcrumb -->
        </div>
        <!-- /Title -->

        <!-- Row -->
        <div class="row">
            <div class="col-sm-12">
                <div class="panel panel-default card-view">
                    <div class="panel-wrapper collapse in">
                        <div class="panel-body">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection