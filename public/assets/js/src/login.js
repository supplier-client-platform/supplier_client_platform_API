    'use strict';

    /**
     * Login function which contains the front-end login logic.
     * @returns {boolean}
     */
    function login() {


        $('.login-error').remove();

        if (!$('.js-validation-login').hasClass('push-50-t push-50')) {
            $('.js-validation-login').addClass('push-50-t push-50');
        }

        if (!jQuery('.js-validation-login').valid()) {
            return false;
        } else {
            $.ajax({
                type: 'post',
                url: 'http://localhost:3334/login',
                data : $('#login-form').serialize(),

                success:function(data){
                    console.log(data);
                    if($.type(data.name) != 'undefined' && $.type(data.name) !== 'null') {
                       // alert(data.name);

                        $('.js-validation-login').removeClass('push-50-t push-50');

                        $('.login-title').after( "<div class='login-error text-center fadeIn'>" +
                            "<p class='content-mini content-mini-full bg-warning'>" +
                            "<i class='fa fa-warning fa-2x'></i> Invalid Username or Password</p></div>" );
                    }
                },

                error: function(xhr, ajaxOptions, thrownError) {
                    console.log(thrownError);
                }
            });
        }

        return false;
    }
