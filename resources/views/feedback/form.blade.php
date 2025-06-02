<!DOCTYPE html>
<html lang="en">
<head>
    <title>Kia Training Portal</title>
    <meta content="width=device-width, initial-scale=1" name="viewport">
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" rel="stylesheet">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <style>

        @media all and (max-width: 500px) {
            .container {
                margin-right: 20px !important;
                margin-left: 20px !important;
            }
        }

    </style>
</head>
<body>

    @if(Session::has('success'))
          <script> 
             alert('data has been saved successfully');
          </script>
    @endif

    @php
    //    @dd($attendie_id);
    @endphp
    <div class="container">
        <div class="row">
            <h1 class="font-weight-bold"> Please Share Feedback </h1>
            <p> Please let us know about your experience related to your recent training(Rating 1 to 5)</p>
            <hr>
            <div class="col-12" style="margin-top: 40px !important;">
                <form id="formFeedback1" action="{{ route('feedback_submit') }}" method="post">
                          
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    
                    <input type="hidden" value="{{ $activity_id }}" name="activity_id">
                    <input type="hidden" value="{{ $attendie_id }}" name="attendie_id">
                     
                    @foreach($questions as $key => $question)
                       
                         <h4 style="margin-top: 40px !important;">
                            {{-- <input type="text" name="question_id[]" value="{{ $question->id }}"> --}}
                            {{ $question->question_text }}
                        </h4>

                        @switch($question->question_type)

                            @case($question->question_type = 'textarea')
                             <textarea class="form-control" id="answer" rows="3" name="ques[{{$question->id}}]" required></textarea>
                            @break

                            @case($question->question_type = 'textinput')
                             <input type="text" class="form-control" id="answer" name="ques[{{$question->id}}]" placeholder="" required>
                            @break

                            @case($question->question_type = 'rating')

                             <input type="radio" id="Very_dissatisfied{{ $key }}" name="ques[{{$question->id}}]" value="1" required>
                             <label for="Very_dissatisfied{{ $key }}">1</label>

                             <input type="radio" id="Dissatisfied{{ $key }}" name="ques[{{$question->id}}]" value="2" required>
                             <label for="Dissatisfied{{ $key }}"> 2 </label>

                             <input type="radio" id="Neutral{{ $key }}" name="ques[{{$question->id}}]" value="3" required>
                             <label for="Neutral{{ $key }}"> 3 </label>

                             <input type="radio" id="Satisfied{{ $key }}" name="ques[{{$question->id}}]" value="4" required>
                             <label for="Satisfied{{ $key }}"> 4 </label>

                             <input type="radio" id="Very_satisfied{{ $key }}" name="ques[{{$question->id}}]" value="5" required>
                             <label for="Very_satisfied{{ $key }}"> 5 </label>

                            @break

                        @endswitch
                    @endforeach
                    <br>
                    <input type="submit" class="btn btn-success" value="Submit feedback" style="margin-bottom: 30px; margin-top:10px;">
                </form>
            </div>
        </div>
    </div>
   
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
    
</body>
</html>
