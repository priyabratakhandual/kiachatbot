<?php
preg_match("/[^\/]+$/", url()->current(), $matches);
$last_word = $matches[0];
?>

</div>
<!-- /Main Content -->

</div>
<!-- /#wrapper -->

<!-- JavaScript -->
<script>
    const base_url = {!! json_encode(url('/')) !!};
</script>

<!-- jQuery -->
<script src="{{ asset('vendors/bower_components/jquery/dist/jquery.min.js') }}"></script>

<!-- Bootstrap Core JavaScript -->
<script src="{{ asset('vendors/bower_components/bootstrap/dist/js/bootstrap.min.js') }}"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"> </script>

<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
{{-- <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script> --}}
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>

<!-- Data table JavaScript -->
<script src="{{ asset('vendors/bower_components/datatables/media/js/jquery.dataTables.min.js') }}"></script>

<script src="{{ asset('vendors/bower_components/select2/dist/js/select2.full.min.js') }}"></script>


<script src="https://cdn.jsdelivr.net/npm/sweetalert2@9.10.13/dist/sweetalert2.all.min.js"></script>

<!-- Treeview JavaScript -->
<script src="{{ asset('vendors/bower_components/bootstrap-treeview/dist/bootstrap-treeview.min.js') }}"></script>

<!-- Slimscroll JavaScript -->
<script src="{{ asset('full-width-dark/dist/js/jquery.slimscroll.js') }}"></script>

<!-- simpleWeather JavaScript -->
<script src="{{ asset('vendors/bower_components/moment/min/moment.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/simpleWeather/jquery.simpleWeather.min.js') }}"></script>
<script src="{{ asset('full-width-dark/dist/js/simpleweather-data.js') }}"></script>

<!-- Progressbar Animation JavaScript -->
<script src="{{ asset('vendors/bower_components/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('vendors/bower_components/jquery.counterup/jquery.counterup.min.js') }}"></script>


<script src="{{ asset('custom/js/timepicker.js') }}"></script>

<!-- Fancy Dropdown JS -->
<script src="{{ asset('full-width-dark/dist/js/dropdown-bootstrap-extended.js') }}"></script>

<!-- Sparkline JavaScript -->
<script src="{{ asset('vendors/jquery.sparkline/dist/jquery.sparkline.min.js') }}"></script>

<!-- Owl JavaScript -->
<script src="{{ asset('vendors/bower_components/owl.carousel/dist/owl.carousel.min.js') }}"></script>

<!-- Toast JavaScript -->
<script src="{{ asset('vendors/bower_components/jquery-toast-plugin/dist/jquery.toast.min.js') }}"></script>

<script src="{{ asset('vendors/bower_components/fullcalendar/dist/fullcalendar.min.js') }}"></script>
<script src="{{ asset('full-width-dark/dist/js/fullcalendar-data.js') }}"></script>

<!-- EChartJS JavaScript -->
<script src="{{ asset('vendors/bower_components/echarts/dist/echarts-en.min.js') }}"></script>
<script src="{{ asset('vendors/echarts-liquidfill.min.js') }}"></script>

<!-- Switchery JavaScript -->
<script src="{{ asset('vendors/bower_components/switchery/dist/switchery.min.js') }}"></script>

<!-- Init JavaScript -->
<script src="{{ asset('full-width-dark/dist/js/init.js') }}"></script>
<script src="{{ asset('full-width-dark/dist/js/dashboard-data.js') }}"></script>
{{--
	<script type="text/javascript">
		$(function() {

		    var start = moment().subtract(29, 'days');
		    var end = moment();

		    function cb(start, end) {
		        $('#reportrange span').html(start.format('MMMM D, YYYY') + ' - ' + end.format('MMMM D, YYYY'));
		    }

		    $('#reportrange').daterangepicker({
		        startDate: start,
		        endDate: end,
		       }, cb);

		    cb(start, end);

		});
	</script> --}}

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.0/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/select/1.3.1/js/dataTables.select.min.js"></script>


<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/js/fileinput.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-fileinput/4.4.7/themes/fa/theme.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>

<script src="{{ asset('custom/js/datatable.js') }}"></script>
<script src="{{ asset('custom/js/main.js') }}"></script>
<script type="text/javascript">
    $('.select2').select2();
    $('.select2add').select2({
        tags: true
    });
    $(document).ready(function() {
        $('#toggle_nav_btn')[0].click();
    });

    $('#activity_type').select2({
        placeholder: "Select Activity Type",
    });
    $('#region').select2({
        placeholder: "Select Region",
    });
    $('#trainer').select2({
        placeholder: "Select Trainer",
    });
    $('#module').select2({
        placeholder: "Select Module",
    });
    $('#training_type').select2({
        placeholder: "Select Training Type",
    });
    $('#dealer_code').select2({
        placeholder: "Select Dealer Code",
        language: {
            noResults: function() {
                return `<button data-toggle="modal" data-target="#exampleModal" style="width: 100%" type="button"
	            class="btn btn-primary" 
	            onClick='task()'>+ Add New Dealer</button>
	            </li>`;
            }
        },

        escapeMarkup: function(markup) {
            return markup;
        }
    });

    $('#plan_date').datepicker({
        startDate: new Date('01 dec 2020'),
        multidate: true,
        format: 'dd-mm-yyyy'
    });
</script>
@switch(Request::url())
@case(url('/').'/trainers/create')
<script src="{{ asset('custom/js/trainer.js') }}"></script>
@break
@case(url('/').'/dealers/create')
<script src="{{ asset('custom/js/dealer.js') }}"></script>
@break
@endswitch
<script src="{{ asset('custom/js/activity.js') }}"></script>
</body>

</html>