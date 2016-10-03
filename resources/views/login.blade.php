@extends('master')


@section('title')
Login
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
               <div class="col-md-6">
                   <div class="block">
                   <div class="block-content">
                    <div class="js-slider" data-slider-dots="true" data-slider-autoplay="true">
                                <div>
                                    <div class="block text-center remove-margin-b">
                                        <div class="block-content block-content-full" style="padding:0cm">
                                           <img   style="height:30rem;" class="img-responsive" src="http://searchengineland.com/figz/wp-content/seloads/2015/05/ecommerce-shopping-retail-ss-1920.jpg">
                                        </div>
                                        <div class="block-content block-content-full block-content-mini bg-danger text-white">
                                           Join today for unlimited clients! &nbsp;&nbsp; <button  onclick="signup()" class="btn btn-sm ">Register Now</button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="block text-center remove-margin-b">
                                        <div class="block-content block-content-full" style="padding:0cm">
                                        
                                           <img  style="height:30rem;"  class="img-responsive" src="http://cdn1.tnwcdn.com/wp-content/blogs.dir/1/files/2013/11/ecommerce.jpg">
                                        </div>
                                        <div class="block-content block-content-full block-content-mini bg-warning text-white">
                                             #1 Supplier Client Platform in Sri Lanka!  &nbsp;&nbsp; <button  onclick="signup()" class="btn btn-sm btn-info ">Join Now</button>
                                        </div>
                                    </div>
                                </div>
                                <div>
                                    <div class="block text-center remove-margin-b">
                                        <div class="block-content block-content-full" style="padding:0cm">
                                                
                                           <img style="height:30rem;" class="img-responsive" src="http://altitudelabs.com/blog/content/images/2016/01/ecommerce.jpg">
                                        </div>
                                        <div class="block-content block-content-full block-content-mini bg-primary text-white">
                                         Grow your bussiness on cloud scale! &nbsp;&nbsp;<button  onclick="signup()" class="btn btn-sm btn-warning ">Subscribe  Now</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                           
                   </div>
                   </div>
               </div>
                <div class="col-md-4 col-md-offset-2">
                    <!-- Login Block -->
                  
                    
                    <div class="block block-themed animated fadeIn" style="height:48rem">
                        <div class="block-header bg-primary login-title">
                           
                            <h3 class="block-title">Login</h3>
                        </div>
                        <div class="block-content block-content-full block-content-narrow">
                            <form id="login-form" name="login-form" class="js-validation-login form-horizontal push-50-t push-50" autocomplete="off" onsubmit="return login()">
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary">
                                            <input class="form-control" type="text" id="login-username" name="login-username">
                                            <label for="login-username">Username</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <div class="form-material form-material-primary  ">
                                            <input class="form-control" type="password" id="login-password" name="login-password">
                                            <label for="login-password">Password</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-xs-12">
                                        <label class="css-input switch switch-sm switch-primary">
                                            <input type="checkbox" id="login-remember-me" name="login-remember-me"><span></span> Remember Me?
                                        </label>
                                    </div>
                                    
                                  
                                </div>
                                     <div class="form-group">
                                    
                                    
                                    <div class="col-xs-12">
                                          <button class="btn btn-block btn-success" type="submit">  Log in</button>
                                    </div>
                                </div>
                                  <a href="base_pages_reminder.html">Forgot Password?</a>
                            </form>
                            <!-- END Login Form -->
                        </div>
                    </div>
                    <!-- END Login Block -->
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
        <script src="{{URL::asset('assets/js/pages/base_pages_login.js')}}"></script>
        <script src="{{URL::asset('assets/js/plugins/slick/slick.min.js')}}"></script>

        <!-- Page JS Code -->
        <script>
            $(function () {
                // Init page helpers (Slick Slider plugin)
                App.initHelpers('slick');
            });
            
            
            function signup(){
               location.href="{{URL::asset('signup')}}";
            }

        </script>

        <script  src="{{URL::asset('assets/js/src/login.js')}}"></script>
@endsection