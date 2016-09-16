@extends('master')


@section('title')
Signup
@endsection


@section('content')

<div class=" ">

    <div class=" ">
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
                                <a class="inactive" href="#validation-step1" data-toggle="tab">1. Personal Details</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step2" data-toggle="tab">2. Company Details</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step3" data-toggle="tab">3. Payment Plan</a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step4" data-toggle="tab">4. Terms </a>
                            </li>
                            <li>
                                <a class="inactive" href="#validation-step5" data-toggle="tab">5. Finish</a>
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
                                                <div class="form-material form-material-primary">
                                                    <input class="form-control" type="text" id="validation-firstname" name="validation-firstname" placeholder="Please enter your firstname">
                                                    <label for="validation-firstname">Full Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material form-material-primary">
                                                    <input class="form-control" type="text" id="validation-nic" name="validation-nic" placeholder="Please enter your NIC number">
                                                    <label for="validation-lastname">NIC</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material form-material-primary">
                                                    <input class="form-control" type="email" id="validation-email" name="validation-email" placeholder="Please enter your personal email address">
                                                    <label for="validation-email">Personal Email</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material form-material-primary">
                                                    <input class="form-control" type="text" id="validation-contact" name="validation-contact" placeholder="Please enter your personal contact number">
                                                    <label for="validation-lastname">Personal Contact</label>
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
                                                    <select class="form-control" type="text" id="validation-category" name="validation-category"  >
                                                        <option value="supermarket">Supermarket</option>
                                                        <option value="food-chain">Food Chain</option>
                                                    </select>
                                                    <label for="validation-details">Supplier Category</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material">

                                                    <input class="form-control" type="text" id="validation-company-name" name="validation-company-name" placeholder="Please enter your Company/Bussiness name">
                                                    <label for="validation-firstname">Company/Bussiness Name</label>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material">
                                                    <input class="form-control" type="email" id="validation-company-email" name="validation-company-email" placeholder="Please enter your Company/Bussiness email address">
                                                    <label for="validation-email">Company/Bussiness Email</label>

                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material">

                                                    <input class="form-control" type="text" id="validation-company-contact" name="validation-company-contact" placeholder="Please enter your personal contact number">
                                                    <label for="validation-lastname">Company/Bussiness Contact</label>
                                                </div>
                                            </div>
                                        </div>


                                        <div class="form-group">
                                            <div class="col-sm-8 col-sm-offset-2">
                                                <div class="form-material">

                                                    <select class="form-control" type="text" id="validation-city" name="validation-city"  >
                                                        <option value="Sri Lanka">Colombo</option>
                                                    </select>
                                                    <label for="validation-lastname">Base City</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- END Step 2 -->

                                    <!-- Step 3 -->
                                    <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step3">

                                        <div class="row push-20-t push-20">
                                            <div class="col-sm-6 col-lg-4 animated fadeInUp" data-toggle="appear" data-offset="50" data-class="animated fadeInUp">
                                                <!-- Developer Plan -->
                                                <a class="block block-bordered block-link-hover3 text-center" href="javascript:void(0)">
                                                    <div class="block-header">
                                                        <h3 class="block-title">Startup</h3>
                                                    </div>
                                                    <div class="block-content block-content-full bg-gray-lighter">
                                                        <div class="h1 font-w700 push-10">FREE</div>
                                                        <div class="h5 font-w300 text-muted">Lifetime</div>
                                                    </div>
                                                    <div class="block-content">
                                                        <table class="table table-borderless table-condensed">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>10 </strong> Brands</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1</strong> User</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1</strong> Branch</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Email</strong> Support</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                                                        <span class="btn btn-warning btn-block">Sign Up</span>
                                                    </div>
                                                </a>
                                                <!-- END Developer Plan -->
                                            </div>
                                            <div class="col-sm-6 col-lg-4 animated fadeInUp" data-toggle="appear" data-offset="50" data-timeout="200" data-class="animated fadeInUp">
                                                <!-- Startup Plan -->
                                                <a class="block block-bordered block-link-hover3 text-center" href="frontend_signup.html">
                                                    <div class="block-header">
                                                        <h3 class="block-title text-primary">Established</h3>
                                                    </div>
                                                    <div class="block-content block-content-full bg-gray-lighter">
                                                        <div class="h1 font-w700 text-primary push-10">Rs. 1000/-</div>
                                                        <div class="h5 font-w300 text-muted">per year</div>
                                                    </div>
                                                    <div class="block-content">
                                                        <table class="table table-borderless table-condensed">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>50 </strong> Brands</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>10</strong> Storage</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>10</strong> Branches</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>FULL</strong> Support</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                                                        <span class="btn btn-block btn-default">Sign Up</span>
                                                    </div>
                                                </a>
                                                <!-- END Startup Plan -->
                                            </div>
                                            <div class="col-sm-6 col-lg-4 animated fadeInUp" data-toggle="appear" data-offset="50" data-timeout="400" data-class="animated fadeInUp">
                                                <!-- Business Plan -->
                                                <a class="block block-bordered block-link-hover3 text-center" href="javascript:void(0)">
                                                    <div class="block-header">
                                                        <h3 class="block-title text-primary" >Cooperate</h3>
                                                    </div>
                                                    <div class="block-content block-content-full bg-gray-lighter">
                                                        <div class="h1 font-w700 push-10 text-primary">Rs. 5000/-</div>
                                                        <div class="h5 font-w300 text-muted">per year</div>
                                                    </div>
                                                    <div class="block-content">
                                                        <table class="table table-borderless table-condensed">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Unlimited</strong> brands</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Unlimited</strong> users</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Unlimited</strong> Branches</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>FULL</strong> Support</td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                    <div class="block-content block-content-mini block-content-full bg-gray-lighter">
                                                        <span class="btn btn-block btn-default">Sign Up</span>
                                                    </div>
                                                </a>
                                                <!-- END Business Plan -->
                                            </div> 
                                        </div>

                                    </div>
                                    <!-- END Step 3 -->


                                    <div class="tab-pane fade fade-right   push-50" id="validation-step4">


                                        <a href="#terms" class="btn" data-toggle="collapse"> <h4>Terms and Conditions</h4></a>
                                        <hr/>
                                        <div id="terms" data-spy="scroll" data-target=".collapse" data-offset="50" style="height:10rem"  class="collapse">
                                            Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                            
                                              Lorem ipsum dolor sit amet, consectetur adipisicing elit,
                                            sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam,
                                            quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.
                                        </div>
                                        
                                        <div class="form-group">
                                    <div class="col-xs-12" style="text-align:right">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> I understand and  agree for the terms and conditions.
                                        </label>
                                    </div>
                                    
                                  
                                </div>
                                    </div>

                                    <!-- step 4 -->

                                    <div class="tab-pane fade fade-right push-30-t push-50" id="validation-step5">

                                        <div class="alert alert-success alert-dismissable">

                                            <h3 class="font-w300 push-15">Congratulations!</h3>
                                            <p>You have registered <a class="alert-link" href="javascript:void(0)">successfully!</a> </p>
                                        </div>
                                    </div>


                                    <!-- END Step 4 -->
                                </div>
                                <!-- END Steps Content -->

                                <!-- Steps Navigation -->
                                <div class="block-content block-content-mini block-content-full border-t">
                                    <div class="row">
                                        <div class="col-xs-6">
                                            <button class="wizard-prev btn btn-default" type="button">  Previous</button>
                                        </div>
                                        <div class="col-xs-6 text-right">
                                            <button class="wizard-next btn btn-info" type="button">Next  </button>
                                            <button class="wizard-finish btn btn-success" type="submit"><i class="fa fa-check-circle-o"></i> Go to Dashboard</button>
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