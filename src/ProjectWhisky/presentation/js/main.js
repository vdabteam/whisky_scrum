jQuery(function(){

    /**
     * Trigger pop-up windows
     */
    jQuery("a.show-login").click(function(){
        jQuery(".lightbox-panel-register").fadeOut(300);
        jQuery(".lightbox-panel-recover").fadeOut(300);
        jQuery(".lightbox-panel-login").fadeIn(300);
    });

    jQuery("a.show-register").click(function(){
        jQuery(".lightbox-panel-login").fadeOut(300);
        jQuery(".lightbox-panel-recover").fadeOut(300);
        jQuery(".lightbox-panel-register").fadeIn(300);
    });

    jQuery("a.close-panel-login").click(function(){
        jQuery(".lightbox-panel-login").fadeOut(300);
    });

    jQuery("a.close-panel-register").click(function(){
        jQuery(".lightbox-panel-register").fadeOut(300);
    });

    /**
     * Handle authorization.
     */
    jQuery('#login_form').submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            type:"POST",
            async:false,
            url:"authorization.php",
            data: jQuery("#login_form").serialize(),
            success: function(response){
                jQuery(".error_reporting").addClass('result').css('visibility','visible');
                jQuery(".result").html(response);

            }
        });
    }); // End Handle authorization



    /**
     * Handle registration.
     */
    jQuery('#register_form').submit(function(e) {
        e.preventDefault();
        jQuery.ajax({
            type:"POST",
            async:false,
            url:"registration.php",
            data: jQuery("#register_form").serialize(),
            success: function(response){
                jQuery(".error_reporting_registration").addClass('result_registration').css('visibility','visible');
                jQuery(".result_registration").html(response);

            }
        });
    }); // End Handle registration




    /**
     * Password section
     * Triggering 'change password' button
     */
    // Triggering 'change password' button
    jQuery(".changePass").click(function(){
        jQuery("#passwordBlock").fadeToggle(30);
        jQuery('.passClass').attr('disabled', function(i, v) { return !v; }); // toggles 'disabled' attribute in password input fields
        jQuery('.dontChangePass').fadeToggle(10);
        jQuery(this).fadeOut(10);
    });

    // Triggering 'don't change password' button
    jQuery(".dontChangePass").click(function(){
        jQuery("#passwordBlock").fadeToggle(30);
        jQuery('.passClass').attr('disabled', function(i, v) { return !v; }); // toggles 'disabled' attribute in password input fields
        jQuery('.changePass').fadeToggle(10);
        jQuery(this).fadeOut(10);
    });





}); //END FUNCTION