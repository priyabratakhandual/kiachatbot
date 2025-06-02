<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Globtier talent directory form</title>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i" rel="stylesheet">
    <link href="form/css/main.css" rel="stylesheet" media="all">
</head>

<body>
    <div class="page-wrapper bg-dark p-t-100 p-b-50">
        <div class="wrapper wrapper--w900">
            <div class="card card-6">
                <div class="card-heading">
                    <h2 class="title">Talent Directory</h2>
                    <div class="bg-wht">
                       <!--  <p>The name and photo associated with your Google account will be recorded when you upload files and submit this form. Not <strong>tekpcsol.harry@gmail.com? </strong> <a href="#"> Switch account </a> </p>
                        <p class="clr">* Required</p> -->
                    </div>
                </div>
                <div class="card-body">
                    <form id="registerForm">
                        <div class="form-row">
                            <div class="name">Email address<p class="star">*</p></div>
                            <div class="value">
                                <div class="input-group">
                                    <input class="input--style-6" type="email" name="email" id="email" placeholder="example@email.com">
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">First Name<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="f_name" id="f_name" placeholder="name...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Last Name<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="l_name" id="l_name" placeholder="name...">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Phone<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="phone" id="phone" placeholder="phone no...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">City<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="city" id="city" placeholder="city name...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">LinkedIn Profile<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="linkedIn" id="linkedIn" placeholder="lnkedIn profile...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Organization<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="organization" id="organization" placeholder="Organization...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Designation<p class="star">*</p></div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="designation" id="designation" placeholder="Designation...">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Employment Status<p class="star">*</p></div>
                            <div class="value">
                                <select  class="input--style-6 select-box" name="employer_status" id="employer_status">
                                    <option>Choose an option</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name name2">Share about 100 word summary of your career journey & highlights</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="share_about" id="share_about" placeholder="your answer"></textarea>
                                </div>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Skills</div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="skills" id="skills" placeholder="your answer"></textarea>
                                </div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Preferred Employment type<p class="star">*</p></div>
                            <div class="value">
                                <select  class="input--style-6 select-box" name="pf_emp_type" id="pf_emp_type">
                                    <option>Choose an option</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Roles of Interest</div>
                            <div class="value">
                                <input class="input--style-6" type="text" name="rolesinterest" id="rolesinterest" placeholder="Roles of Interest...">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Open to relocation? <p class="star">*</p></div>
                            <div class="value">
                                <div class="radio">
                                    <input id="radio-1" name="open_to_rel" id="open_to_rel" type="radio" value="Yes">
                                    <label for="radio-1" class="radio-label">Yes</label>
                                </div>

                                <div class="radio">
                                    <input id="radio-2" name="open_to_rel" id="open_to_rel" type="radio" value="No">
                                    <label for="radio-2" class="radio-label">No</label>
                                </div>
    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Open to remote work? <p class="star">*</p></div>
                            <div class="value">
                                <div class="radio">
                                    <input id="radio-3" name="open_to_remote" id="open_to_remote" type="radio" value="Yes">
                                    <label for="radio-3" class="radio-label">Yes</label>
                                </div>

                                <div class="radio">
                                    <input id="radio-4" name="open_to_remote" id="open_to_remote" type="radio" value="No">
                                    <label for="radio-4" class="radio-label">No</label>
                                </div>
    
                            </div>
                        </div>

                         <div class="form-row">
                            <div class="name">Open to a Contract job? <p class="star">*</p></div>
                            <div class="value">
                                <div class="radio">
                                    <input id="radio-5" name="open_to_contract" id="open_to_contract" type="radio" value="Yes">
                                    <label for="radio-5" class="radio-label">Yes</label>
                                </div>

                                <div class="radio">
                                    <input id="radio-6" name="open_to_contract" id="open_to_contract" type="radio" value="No">
                                    <label for="radio-6" class="radio-label">No</label>
                                </div>
    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Have you worked in a start-up earlier? <p class="star">*</p></div>
                            <div class="value">
                                <div class="radio">
                                    <input id="radio-7" name="worked_in_startup" id="worked_in_startup" type="radio" value="Yes">
                                    <label for="radio-7" class="radio-label">Yes</label>
                                </div>

                                <div class="radio">
                                    <input id="radio-8" name="worked_in_startup" id="worked_in_startup" type="radio" value="No">
                                    <label for="radio-8" class="radio-label">No</label>
                                </div>
    
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="name">Open to Side Gigs? <p class="star">*</p></div>
                            <div class="value">
                                <div class="radio">
                                    <input id="radio-9" name="open_to_gig" id="open_to_gig" type="radio" value="Yes">
                                    <label for="radio-9" class="radio-label">Yes</label>
                                </div>

                                <div class="radio">
                                    <input id="radio-11" name="open_to_gig" id="open_to_gig" type="radio" value="No">
                                    <label for="radio-11" class="radio-label">No</label>
                                </div>
    
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Upload CV</div>
                            <div class="value">
                                <div class="input-group js-input-file">
                                    <input class="input-file" type="file" name="file" id="file">
                                    <label class="label--file" for="file">Add file</label>
                                    <span class="input-file__info">No file chosen</span>
                                </div>
                                <div class="label--desc">Upload your CV/Resume or any other relevant file. Max file size 50 MB</div>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="name">Any other information </div>
                            <div class="value">
                                <div class="input-group">
                                    <textarea class="textarea--style-6" name="other_info" id="other_info" placeholder="your answer"></textarea>
                                </div>
                            </div>
                        </div>
                                        <div class="card-footer">
                    <button class="btn btn--radius-2 btn--blue-2" type="submit" id="sendapp">Send Application</button>
                </div>
                    </form>
                </div>

            </div>
        </div>
    </div>

    <script src="form/js/jquery.min.js"></script>
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    <script src="form/js/global.js"></script>
    <script type="text/javascript">

        $(document).ready(function(){
             
              $.get("https://kia.chatbot.inhelpdesk.com/public/api/get-fields", function(data){
                var emp_status = data.data.result.fields.filter(obj=>obj.name==='cf_882');
                var pf_emp_type = data.data.result.fields.filter(obj=>obj.name==='cf_886');

                (emp_status[0].type.picklistValues).forEach((item) => {
                     $('#employer_status').append('<option value="'+item.value+'">'+item.label+'</option>');
                });

                (pf_emp_type[0].type.picklistValues).forEach((item) => {
                     $('#pf_emp_type').append('<option value="'+item.value+'">'+item.label+'</option>');
                });

              });

              $("#registerForm").submit(function(e){
                  e.preventDefault();
                    $('#sendapp').prop('disabled', true);
                    $('.error').remove();
                    $('#email_exist').text('');
                        let currentSelect = $(this);
                         $.ajax({
                         url: "https://kia.chatbot.inhelpdesk.com/public/api/registerlead",
                         method:"POST",
                         data: new FormData(this),
                         dataType:'JSON',
                         contentType: false,
                         cache: false,
                         processData: false,
                         beforeSend: function(){
                           $('#preloader').show();
                                       },
                         success:function(data)
                         {
                           $('#sendapp').prop('disabled', false);
                           $('#preloader').hide();
                            if(data.status == 0){
                              swal("Error", "Please fill the details correctly", "error");
                              $.each(data.message , function(i,v){
                                var input = $(currentSelect).find('input[name='+i+']');
                                  if(Object.keys(input).length == 3){
                                    input.before('<p style="color:red" class="error">' +v + '</p>');
                                  }else{
                                    input.parent().parent().append('<p style="color:red" class="error">' +v + '</p>');
                                  }
                                 $(currentSelect).find('select[name='+i+']').before('<p style="color:red" class="error">' +v + '</p>'); 
                              });
                            }
                            else{
                                 document.getElementById("registerForm").reset();
                                 swal("Good job!", "Your details has been submitted.", "success");
                            }     
                        }    
                       });
                  });

        });
    </script>
</body>
</html>