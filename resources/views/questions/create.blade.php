@extends('layouts.app')
@section('content')

<style type="text/css">
    .select2-search__field {
        color: black;
    }
</style>


<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid">

        <!-- Title -->
        <div class="row heading-bg">
            <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                <h5 class="txt-dark">CREATE QUESTIONS</h5>
            </div>

            <!-- Breadcrumb -->
            <div class="col-lg-9 col-sm-8 col-md-8 col-xs-12">
                {{-- <ol class="breadcrumb">
								<li><a href="index.html">Dashboard</a></li>
								<li><a href="#"><span>form</span></a></li>
								<li class="active"><span>form-layout</span></li>
							</ol> --}}
                <a href="{{URL::to('/Questions')}}"><button class="btn btn-primary" style="float: right;">BACK</button></a>
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
                                        <form id="create_question_form" class="form-horizontal">
                                            {{csrf_field()}}
                                            <div class="form-body">
                                                 <h6 class="txt-dark capitalize-font"><i class="zmdi zmdi-account mr-10"></i>Submit questions</h6>
                                                <hr class="light-grey-hr" />

                                            </div>
                                            <div class="form-actions mt-10">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Question</label>
                                                            <div class="col-md-9">
                                                                <textarea class="form-control" id="question_text" name="question_text" rows="1"></textarea>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Question type</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="question_type" id="question_type">
                                                                    <option value="" selected>----- select a question type -----</option>
                                                                    <option value="rating">Rating</option>
                                                                    {{-- <option value="textinput"> TextInput</option> --}}
                                                                    <option value="textarea"> TextArea </option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Status</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="status" id="status">
                                                                    <option value="" selected>----- select status -----</option>
                                                                    <option value="active">Active</option>
                                                                    <option value="inactive">Inactive</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    {{-- <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="control-label col-md-3">Required</label>
                                                            <div class="col-md-9">
                                                                <select class="form-control" name="required" id="required">
                                                                    <option value="" selected>----- select required -----</option>
                                                                    <option value="0">Not required</option>
                                                                    <option value="1">Required</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div> --}}


                                                    <div class="col-md-12">
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <button type="submit" class="btn btn-success  mr-10">Submit</button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                </div>
                                            </div>
                                        </form>
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

</div>
<!-- /Main Content -->

<script>
    const base_url = { !!json_encode(url('/')) !! };
</script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
<script>
    $('#create_question_form').submit(function(event) {

        event.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $('.error').remove();
        let currentSelect = $(this);
        $.ajax({
            url: base_url + "/Questions/store",
            method: "POST",
            data: new FormData(this),
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            beforeSend: function() {
                $('#preloader').show();
            },
            success: function(data) {
                $('#message').html("");
                $('#preloader').hide();
                if (data.status == 0) {
                    $.each(data.message, function(i, v) {
                        $(currentSelect).find('textarea[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
                        $(currentSelect).find('select[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
                        $(currentSelect).find('input[name=' + i + ']').after('<p style="color:red" class="error">' + v[0] + '</p>');
                    });
                } else if (data.status == 1) {
                    $(currentSelect).find('input[name=submit]').after('<p style="color:green" class="error">' + data.message + '</p>');
                    Swal.fire({
                        icon: 'success',
                        title: 'Your question has been submitted successfully',
                        showConfirmButton: false,
                        timer: 1500
                    })
                    location.reload(true);
                }
            }
        });


    });
</script>

@endsection