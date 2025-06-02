@extends('layouts.app')
@section('content')

<style type="text/css">
    body {
        color: black !important;
    }

    tfoot input {
        width: 100%;
        padding: 3px;
        box-sizing: border-box;
    }

    .dataTables_processing {
        color: black !important;
        height: 60px !important;
    }

    .buttons-excel {
        margin-left: 40px !important;
        background: gray;
    }

    td.details-control {
        background: url('{{ asset('img/details_open.png') }}') no-repeat center center !important;
        cursor: pointer;
    }

    tr.shown td.details-control {
        background: url('{{ asset('img/details_close.png') }}') no-repeat center center !important;
    }

    .badge-adi {
        background-color: #0090bf;
        font-weight: 400;
        padding: 5px 10px;
        color: #ffffff;
    }

    .dataTables_filter {
        display: none;
    }

</style>

<!-- Main Content -->
<div class="page-wrapper">
    <div class="container-fluid pt-25">
        <!-- Row -->
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="panel panel-default card-view">
                    <div class="panel-heading">
                        <div class="pull-left">
                            <h6>Questions</h6>
                        </div>
                        <div class="pull-right">
                            <a href="{{URL::to('Questions/create')}}">
                                <button class="pull-right btn btn-success" style="background:#a80008">Create
                                    questions</button>
                            </a>
                        </div>
                        <div class="clearfix"></div>
                    </div>

                    <div class="panel-wrapper collapse in">
                        <div class="panel-body row pa-0">
                            <div class="table-wrap">
                                <div class="table-responsive">
                                    <table id="questionsTable" class="table display product-overview border-none">
                                        <thead>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Questions</th>
                                                <th>Question type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($data as $key => $value)

                                            <tr>
                                                <th scope="row">{{ $key+1 }}</th>
                                                <td> {{ $value->question_text }}</td>
                                                 <td> {{ $value->question_type }} </td>
                                                <td> @if($value->status == 'active')
                                                    <button type="button" class="btn btn-success btn-sm" disabled>
                                                        Active </button>
                                                    @else
                                                    <button type="button" class="btn btn-danger btn-sm" disabled>
                                                        Inactive </button>
                                                    @endif
                                                </td>
                                                <td>
                                                    <a href="{{ route('questions.edit', $value->id) }}"> <i class="fa fa-pencil" aria-hidden="true" style="font-size: 18px; margin-right: 10px;"></i></a>
                                                    {{-- <a href="javascript::void(0)" onclick="ConfirmDelete({{ $value->id }})"> <i class="fa fa-trash" aria-hidden="true" style="font-size: 18px;"></i> </a> --}}

                                                </td>
                                            </tr>

                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th>Sno</th>
                                                <th>Questions</th>
                                                <th>Question type</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- /Row -->
    </div>
    <script>
        const base_url = {
            !!json_encode(url('/')) !!
        };

    </script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <!-- Data table JavaScript -->
    <script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

    <script>
        function ConfirmDelete(id) {
            var result = confirm("Are you sure you want to delete?");
            if (result) {
                $.ajax({
                    dataType: 'json'
                    , type: 'Get'
                    , url: 'Questions/delete/' + id
                , }).done(function(data) {
                    alert("Data deleted successfully");
                    location.reload(true);

                });
            } else {
                alert("Not deleted");
            }
        }

        // Question datatable
    $('#questionsTable').DataTable({
        dom: 'Blfrtip',
        buttons: [
            {
                extend: 'excel',
                title: 'Export',
                exportOptions: {
                    modifier: { search: 'applied' }
                }
            },
        ],
    });

    </script>
    @endsection
