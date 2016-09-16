@extends('master')


@section('title')
Signup
@endsection


@section('content')

<div class="outer-div">

    <div class="middle-div">
          <center>
      <h1 style="margin-bottom:2.5rem">SUPPLIER CLIENT PLATFORM <small>TODO : Create a LOGO</small></h1>
  </center>
         
          <!-- Login Content -->
        <div class="content overflow-hidden"  >
            <div class="row " >
               <div class="col-md-8 col-md-offset-2">
       
                            <!-- Validation Wizard (.js-wizard-validation class is initialized in js/pages/base_forms_wizard.js) -->
                            <!-- For more examples you can check out http://vadimg.com/twitter-bootstrap-wizard-example/ -->
                            <div class="js-wizard-validation block">
                                <!-- Step Tabs -->
                                <ul class="nav nav-tabs nav-tabs-alt nav-justified">
                                    <li class="active">
                                        <a class="inactive" href="#validation-step1" data-toggle="tab">1. Personal</a>
                                    </li>
                                    <li>
                                        <a class="inactive" href="#validation-step2" data-toggle="tab">2. Details</a>
                                    </li>
                                    <li>
                                        <a class="inactive" href="#validation-step3" data-toggle="tab">3. Extra</a>
                                    </li>
                                </ul>
                                <!-- END Step Tabs -->

                                <!-- Form -->
                                <!-- jQuery Validation (.js-form2 class is initialized in js/pages/base_forms_wizard.js) -->
                                <!-- For more examples you can check out https://github.com/jzaefferer/jquery-validation -->
                                <form class="js-form2 form-horizontal" action="base_forms_wizard.html" method="post">
                                    <!-- Steps Content -->
                                    
                                         <!-- Steps Progress -->
                                 <div class="block-content block-content-mini block-content-full border-b">
                                    <div class="wizard-progress progress active remove-margin-b">
                                        <div class="progress-bar progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 0"></div>
                                    </div>
                                    <!-- END Steps Progress -->
                                    
                                    
                                    <div class="block-content tab-content">
                                        <!-- Step 1 -->
                                        <div class="tab-pane fade fade-right in push-30-t push-50 active" id="validation-step1">
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="validation-firstname" name="validation-firstname" placeholder="Please enter your firstname">
                                                        <label for="validation-firstname">First Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="validation-lastname" name="validation-lastname" placeholder="Please enter your lastname">
                                                        <label for="validation-lastname">Last Name</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <input class="form-control" type="email" id="validation-email" name="validation-email" placeholder="Please enter your email">
                                                        <label for="validation-email">Email</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Step 1 -->

                                        <!-- Step 2 -->
                                        <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step2">
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <textarea class="form-control" id="validation-details" name="validation-details" rows="9" placeholder="Share something about yourself"></textarea>
                                                        <label for="validation-details">Details</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Step 2 -->

                                        <!-- Step 3 -->
                                        <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step3">
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <input class="form-control" type="text" id="validation-city" name="validation-city" placeholder="Where do you live?">
                                                        <label for="validation-city">City</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <div class="form-material">
                                                        <select class="form-control" id="validation-skills" name="validation-skills" size="1">
                                                            <option value="">Please select your best skill</option>
                                                            <option value="1">Photoshop</option>
                                                            <option value="2">HTML</option>
                                                            <option value="3">CSS</option>
                                                            <option value="4">JavaScript</option>
                                                        </select>
                                                        <label for="validation-skills">Skills</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <div class="col-sm-8 col-sm-offset-2">
                                                    <label class="css-input switch switch-sm switch-primary" for="validation-terms">
                                                        <input type="checkbox" id="validation-terms" name="validation-terms"><span></span> Agree with the <a data-toggle="modal" data-target="#modal-terms" href="#">terms</a>
                                                    </label>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- END Step 3 -->
                                    </div>
                                    <!-- END Steps Content -->

                                    <!-- Steps Navigation -->
                                    <div class="block-content block-content-mini block-content-full border-t">
                                        <div class="row">
                                            <div class="col-xs-6">
                                                <button class="wizard-prev btn btn-warning" type="button"><i class="fa fa-arrow-circle-o-left"></i> Previous</button>
                                            </div>
                                            <div class="col-xs-6 text-right">
                                                <button class="wizard-next btn btn-success" type="button">Next <i class="fa fa-arrow-circle-o-right"></i></button>
                                                <button class="wizard-finish btn btn-primary" type="submit"><i class="fa fa-check-circle-o"></i> Submit</button>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Steps Navigation -->
                                </form>
                                <!-- END Form -->
                            </div>
                            <!-- END Validation Wizard Wizard -->
                       
               
                </div>
                 </div>
        </div>
        <!-- END Login Content -->

        <!-- Login Footer -->
        <div class="push-10-t text-center animated fadeInUp">
            <small class="text-muted font-w600"><span class="js-year-copy"></span> &copy; SLIIT_SEP_008</small>
        </div>
        <!-- END Login Footer -->
    </div>
</div>
    
@endsection






@section('js') 
        <script src="{{URL::asset('assets/js/pages/base_forms_wizard.js')}}"></script>

        <!-- Page JS Code -->
        <script>
        
        </script>
@endsection