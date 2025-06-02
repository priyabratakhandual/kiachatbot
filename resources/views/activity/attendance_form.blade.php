<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kia Training Portal</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

    <div aria-hidden="true" aria-labelledby="exampleModalLabel" class="modal fade" id="exampleModal" role="dialog" tabindex="-1">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">
                        Notification alert
                    </h5>
                    <button aria-label="Close" class="close" data-dismiss="modal" type="button">
                        <span aria-hidden="true">
                            ×
                        </span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-12 text-center">
                            <h6 class="font-weight-bold text-danger pl-5 ml-5 my-3">
                                OPPS! seems your location has been blocked
                            </h6>
                            <p style="font-size: 13px;">
                                1. Kindly click on the blocked location icon
                            </p>
                            <img alt="not found" class="img-fluid w-25 h-25" src="{{ asset('img/crosslocation.jpeg') }}">
                            <br>
                            <p style="font-size: 13px;">
                                2. change the settings.
                            </p>
                            <p style="font-size: 13px;">
                                3. Select first option and continue with done.
                            </p>
                            <p style="font-size: 13px;">
                                4. Kindly refresh the browser.
                            </p>
                            <img alt="not found" class="img-fluid w-25 h-25" src="{{ asset('img/modalPopupLocation.jpeg') }}">

                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" data-dismiss="modal" type="button">
                        Close
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="container">
        <h2>
            Attendance Form
            @php $id = $activity->id; @endphp
        </h2>
        <div class="form-body">
            <form id="formAttendies">
                <input id="activity_id" name="activity_id" type="hidden" value="{{ $id }}">
                <input type="hidden" name="errorLocation" id="errorLocation">
                <div class="form-body">
                    <div class="row">
                        <div class="col-md-6 mx-3 px-3">
                            <div class="form-group">
                                <label for="dealer_code">Dealer code</label>
                                <input class="form-control" id="dealer_code" name="dealer_code" placeholder="Enter dealer code" type="text">
                            </div>
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input class="form-control" id="name" name="name" placeholder="Enter name" type="text">
                            </div>

                            <div class="form-group">
                                <label for="mobile_no">Mobile Number</label>
                                <input class="form-control" type="number" id="mobile_no" name="mobile_no" placeholder="Enter mobile number">
                            </div>

                            <div class="form-group">
                                <label for="location">Location</label>
                                <input class="location form-control" id="location" name="location" placeholder="location" readonly type="text">

                            </div>
                        </div>
                        <div class="col-md-6 mx-3 px-3">
                            <div class="form-group">
                                <div class="form-group">
                                    <label for="dms_employee_id">DMS Employee Id</label>
                                    <input class="form-control" id="dms_employee_id" name="dms_employee_id" placeholder="Enter DMS Employee ID" type="text">
                                </div>
                                <div class="form-group">
                                    <label for="designation">Designation</label>
                                    <select class="form-control" id="designation" name="designation">
                                        <option value="">
                                            ----------select designation ---------
                                        </option>
                                        <option value="Accessories Fitter">
                                            Accessories Fitter
                                        </option>
                                        <option value="Accessories In-Charge">
                                            Accessories In-Charge
                                        </option>
                                        <option value="Accounts Executive">
                                            Accounts Executive
                                        </option>
                                        <option value="Accounts Manager">
                                            Accounts Manager
                                        </option>
                                        <option value="Admin Manager">
                                            Admin Manager
                                        </option>
                                        <option value="Area Sales Manager">
                                            Area Sales Manager
                                        </option>
                                        <option value="Area Service Field Manager">
                                            Area Service Field Manager
                                        </option>
                                        <option value="Body Shop Manager">
                                            Body Shop Managers
                                        </option>
                                        <option value="Body Technician (Dentor) ">
                                            Body Technician (Dentor)
                                        </option>
                                        <option value="BodyShop Advisor">
                                            BodyShop Advisor
                                        </option>
                                        <option value="Car Washers">
                                            Car Washers
                                        </option>
                                        <option value="Cashier">
                                            Cashier
                                        </option>
                                        <option value="CCE Post Service Followup">
                                            CCE Post Service Followup
                                        </option>
                                        <option value="CCE Service Marketing">
                                            CCE Service Marketing
                                        </option>
                                        <option value="Corporate Sales Manager">
                                            Corporate Sales Manager
                                        </option>
                                        <option value="Customer Care Executive">
                                            Customer Care Executive
                                        </option>
                                        <option value="Customer Care Manager">
                                            Customer Care Manager
                                        </option>
                                        <option value="Dealer Principal">
                                            Dealer Principal
                                        </option>
                                        <option value="Delivery Coordinator">
                                            Delivery Coordinator
                                        </option>
                                        <option value="DGSR VIEWER">
                                            DGSR VIEWER
                                        </option>
                                        <option value="Driver">
                                            Driver
                                        </option>
                                        <option value="Drivers">
                                            Drivers
                                        </option>
                                        <option value="Drivers(Workshop)">
                                            Drivers(Workshop)
                                        </option>
                                        <option value="EDP Incharge">
                                            EDP Incharge
                                        </option>
                                        <option value="Final Inspector">
                                            Final Inspector
                                        </option>
                                        <option value="Finance Executive">
                                            Finance Executive
                                        </option>
                                        <option value="Finance Manager Retail">
                                            Finance Manager Retail
                                        </option>
                                        <option value="Finance Runner">
                                            Finance Runner
                                        </option>
                                        <option value="Front Office Manager">
                                            Front Office Manager
                                        </option>
                                        <option value="General Manager - (After Sales)">
                                            General Manager - (After Sales)
                                        </option>
                                        <option value="General Manager - Sales">
                                            General Manager - Sales
                                        </option>
                                        <option value="Head- Field Support">
                                            Head- Field Support
                                        </option>
                                        <option value="House Keeping">
                                            House Keeping
                                        </option>
                                        <option value="Housekeeping">
                                            Housekeeping
                                        </option>
                                        <option value="HR & Admin Manager">
                                            HR & Admin Manager
                                        </option>
                                        <option value="HR Executive">
                                            HR Executive
                                        </option>
                                        <option value="HR Manager">
                                            HR Manager
                                        </option>
                                        <option value="I.T / MIS executive">
                                            I.T / MIS executive
                                        </option>
                                        <option value="In House Trainer">
                                            In House Trainer
                                        </option>
                                        <option value="Incentive Claim Processor">
                                            Incentive Claim Processor
                                        </option>
                                        <option value="Incentive CLAIM Processor Admin">
                                            Incentive CLAIM Processor Admin
                                        </option>
                                        <option value="In-Dealership Trainer">
                                            In-Dealership Trainer
                                        </option>
                                        <option value="Insurance Executive">
                                            Insurance Executive
                                        </option>
                                        <option value="Job Controller- Mechanical">
                                            Job Controller- Mechanical
                                        </option>
                                        <option value="Job Controller-Bodyshop">
                                            Job Controller-Bodyshop
                                        </option>
                                        <option value="Kia BI User">
                                            Kia BI User
                                        </option>
                                        <option value="KIA Experience Consultant">
                                            KIA Experience Consultant
                                        </option>
                                        <option value="KIA Experience Consultant Corporate">
                                            KIA Experience Consultant Corporate
                                        </option>
                                        <option value="KIA Experience Consultant Digital">
                                            KIA Experience Consultant Digital
                                        </option>
                                        <option value="KIA Experience Consultant DSA">
                                            KIA Experience Consultant DSA
                                        </option>
                                        <option value="KIA Experience Consultant Field">
                                            KIA Experience Consultant Field
                                        </option>
                                        <option value="KIA Experience Consultant Premium">
                                            KIA Experience Consultant Premium
                                        </option>
                                        <option value="KIA Experience Consultant Procurement">
                                            KIA Experience Consultant Procurement
                                        </option>
                                        <option value="KIA Experience Consultant Showroom">
                                            KIA Experience Consultant Showroom
                                        </option>
                                        <option value="KIA Head Office">
                                            KIA Head Office
                                        </option>
                                        <option value="KMI REPORT VIEW">
                                            KMI REPORT VIEW
                                        </option>
                                        <option value="KMI User Admin">
                                            KMI User Admin
                                        </option>
                                        <option value="Marketing Finance">
                                            Marketing Finance
                                        </option>
                                        <option value="Master Key">
                                            Master Key
                                        </option>
                                        <option value="Mobility Receptionist">
                                            Mobility Receptionist
                                        </option>
                                        <option value="National Sales Training Head">
                                            National Sales Training Head
                                        </option>
                                        <option value="NVI Incharge">
                                            NVI Incharge
                                        </option>
                                        <option value="NVI Technician">
                                            NVI Technician
                                        </option>
                                        <option value="Office Boy">
                                            Office Boy
                                        </option>
                                        <option value="Others">
                                            Others
                                        </option>
                                        <option value="Paint Technician (Painter) ">
                                            Paint Technician (Painter)
                                        </option>
                                        <option value="Pantry">
                                            Pantry
                                        </option>
                                        <option value="Pantry Boy">
                                            Pantry Boy
                                        </option>
                                        <option value="Part Assistant">
                                            Part Assistant
                                        </option>
                                        <option value="Part Manager">
                                            Part Manager
                                        </option>
                                        <option value="Part Picker">
                                            Part Picker
                                        </option>
                                        <option value="Parts Assistant">
                                            Parts Assistant
                                        </option>
                                        <option value="Parts Manager">
                                            Parts Manager
                                        </option>
                                        <option value="Parts Picker">
                                            Parts Picker
                                        </option>
                                        <option value="Peon">
                                            Peon
                                        </option>
                                        <option value="Plant Accounts">
                                            Plant Accounts
                                        </option>
                                        <option value="Premium Service Advisor">
                                            Premium Service Advisor
                                        </option>
                                        <option value="Pre-owner cars Manager">
                                            Pre-owner cars Manager
                                        </option>
                                        <option value="Receptionist/Front Desk">
                                            Receptionist/Front Desk
                                        </option>
                                        <option value="Regional Manager">
                                            Regional Manager
                                        </option>
                                        <option value="Regional Marketing Manager">
                                            Regional Marketing Manager
                                        </option>
                                        <option value="Regional Sales Manager">
                                            Regional Sales Manager
                                        </option>
                                        <option value="Regional Sales Planning">
                                            Regional Sales Planning
                                        </option>
                                        <option value="Regional Service Field Manager">
                                            Regional Service Field Manager
                                        </option>
                                        <option value="Regional Training and SSI Manager">
                                            Regional Training and SSI Manager
                                        </option>
                                        <option value="RTO Coordinator">
                                            RTO Coordinator
                                        </option>
                                        <option value="Sales Finance Dealer Claim">
                                            Sales Finance Dealer Claim
                                        </option>
                                        <option value="Sales Manager">
                                            Sales Manager
                                        </option>
                                        <option value="Sales Training Content">
                                            Sales Training Content
                                        </option>
                                        <option value="Section Head Dealer Marketing">
                                            Section Head Dealer Marketing
                                        </option>
                                        <option value="Security">
                                            Security
                                        </option>
                                        <option value="Security Guard">
                                            Security Guard
                                        </option>
                                        <option value="Service Advisor">
                                            Service Advisor
                                        </option>
                                        <option value="Service Advisor (Mech)">
                                            Service Advisor (Mech)
                                        </option>
                                        <option value="Service Manager">
                                            Service Manager
                                        </option>
                                        <option value="Service Planning">
                                            Service Planning
                                        </option>
                                        <option value="Showroom Hostess">
                                            Showroom Hostess
                                        </option>
                                        <option value="Team Leader - Sales">
                                            Team Leader - Sales
                                        </option>
                                        <option value="Technical">
                                            Technical
                                        </option>
                                        <option value="Technican Electrical">
                                            Technican Electrical
                                        </option>
                                        <option value="Technican Mechanical">
                                            Technican Mechanical
                                        </option>
                                        <option value="Tele-caller Sales">
                                            Tele-caller Sales
                                        </option>
                                        <option value="Test Drive Coordinator">
                                            Test Drive Coordinator
                                        </option>
                                        <option value="Trainee Technician">
                                            Trainee Technician
                                        </option>
                                        <option value="Training">
                                            Training
                                        </option>
                                        <option value="Training Operations">
                                            Training Operations
                                        </option>
                                        <option value="UsedCar Data Entry">
                                            UsedCar Data Entry
                                        </option>
                                        <option value="UsedCar Evaluator">
                                            UsedCar Evaluator
                                        </option>
                                        <option value="UsedCar Manager">
                                            UsedCar Manager
                                        </option>
                                        <option value="UsedCar Other">
                                            UsedCar Other
                                        </option>
                                        <option value="UsedCar RF Supervisor">
                                            UsedCar RF Supervisor
                                        </option>
                                        <option value="UsedCar Sales Consultant">
                                            UsedCar Sales Consultant
                                        </option>
                                        <option value="Warranty">
                                            Warranty
                                        </option>
                                        <option value="Warranty Assistant">
                                            Warranty Assistant
                                        </option>
                                        <option value="Warranty in Charge">
                                            Warranty in Charge
                                        </option>
                                        <option value="Warranty Manager">
                                            Warranty Manager
                                        </option>
                                        <option value="Washing Staff">
                                            Washing Staff
                                        </option>
                                        <option value="Washing Supervisor">
                                            Washing Supervisor
                                        </option>
                                        <option value="Workshop Manager">
                                            Workshop Manager
                                        </option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input class="btn btn-success mr-10" type="submit" value="submit">
            </form>
        </div>
    </div>

    <!-- /Main Content -->
    <!-- location -->
    <!-- jQuery -->


    <script>
        //    const base_url = { !!json_encode(url('/')) !! };
        //    console.log(base_url);
    </script>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    <script>
        $('#formAttendies').submit(function(event) {

            event.preventDefault();
          
            if ($('#errorLocation').val() != 'permission denied') {

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $('.error').remove();
                let currentSelect = $(this);
                
                $.ajax({
                    url: "https://kia.chatbot.inhelpdesk.com/public/attendance_submit"
                    , method: "POST"
                    , data: new FormData(this)
                    , dataType: 'JSON'
                    , contentType: false
                    , cache: false
                    , processData: false
                    , beforeSend: function() {
                        $('#preloader').show();
                    }
                    , success: function(data) {
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
                            location.href = "https://kia.chatbot.inhelpdesk.com/public/recievedStatus"
                        } else if (data.status == 2) {
                            location.href = "https://kia.chatbot.inhelpdesk.com/public/markedStatus"
                        }
                    }
                });

            } else {
                $('#exampleModal').modal('show');
            }
        });

    </script>
    <script>
        var $locationText = $(".location");

        // Check for geolocation browser support and execute success method
        if (navigator.geolocation) {
            navigator.geolocation.getCurrentPosition(
                geoLocationSuccess
                , geoLocationError, {
                    timeout: 10000
                }
            );
        } else {
            alert("your browser doesn't support geolocation");
        }

        function geoLocationSuccess(pos) {
            // get user lat,long
            var myLat = pos.coords.latitude
                , myLng = pos.coords.longitude
                , loadingTimeout;

            var loading = function() {
                $locationText.val("fetching...");
            };

            loadingTimeout = setTimeout(loading, 600);

            var request = $.get(
                    "https://nominatim.openstreetmap.org/reverse?format=json&lat=" +
                    myLat +
                    "&lon=" +
                    myLng
                )
                .done(function(data) {
                    if (loadingTimeout) {
                        clearTimeout(loadingTimeout);
                        loadingTimeout = null;
                        $locationText.val(data.display_name);
                    }
                })
                .fail(function() {
                    // handle error
                });
        }

        function geoLocationError(error) {
            $('#errorLocation').val('permission denied');
        }

    </script>

</body>
</html>
