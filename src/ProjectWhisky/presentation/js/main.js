jQuery(function(){

    /**
     * Trigger pop-up windows
     */
    jQuery("a.show-login").click(function(){
        event.preventDefault();
        jQuery(".lightbox-panel-register").fadeOut(300);
        jQuery(".lightbox-panel-recover").fadeOut(300);
        jQuery(".lightbox-panel-login").fadeIn(300);
    });

    jQuery("a.show-register").click(function(){
        event.preventDefault();
        jQuery(".lightbox-panel-login").fadeOut(300);
        jQuery(".lightbox-panel-recover").fadeOut(300);
        jQuery(".lightbox-panel-register").fadeIn(300);
    });

    jQuery("a.close-panel-login").click(function(){
        event.preventDefault();
        jQuery(".lightbox-panel-login").fadeOut(300);
    });

    jQuery("a.close-panel-register").click(function(){
        event.preventDefault();
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
        event.preventDefault(); // prevents link to open page
        jQuery("#passwordBlock").fadeToggle(300);
        jQuery('.passClass').attr('disabled', function(i, v) { return !v; }); // toggles 'disabled' attribute in password input fields
        jQuery('.dontChangePass').css('display', 'table');
        jQuery(this).css('display', 'none');
    });

    // Triggering 'don't change password' button
    jQuery(".dontChangePass").click(function(){
        event.preventDefault(); // prevents link to open page
        jQuery("#passwordBlock").fadeToggle(300);
        jQuery('.passClass').attr('disabled', function(i, v) { return !v; }); // toggles 'disabled' attribute in password input fields
        jQuery('.changePass').css('display', 'table');
        jQuery(this).css('display', 'none');
    });


    /**
     * Show selected image in 'uploadFile' block
     */
    var imageUploader = document.getElementById("imgUploader");
    if(typeof(imageUploader) != "undefined" && imageUploader !== null) {
        document.getElementById("imgUploader").onchange = function () {
            document.getElementById("uploadFile").value = this.value.substring(12);
            document.getElementById("uploadFile").style.display = "block";
        };
    }


    /**
     * USER INPUT DATA VALIDATION
     */
/*    document.addEventListener("keyup", show, true);

    function show()
    {
        var x = document.getElementById("email");

        x2 = x.value.trim();
//                x = x.value;
        var messageField = document.getElementsByClassName("email");
        if(is.email(x2))
        {
            console.log(x.value);
        }
        else
        {
            console.log(x.value);
        }
    }*/






    jQuery('.email').keyup(function(){
        emailValue = jQuery(this).val().trim();

        validateEmail(emailValue, jQuery(this));

    });

    function validateEmail(email, emailObject)
    {
        if(is.email(email))
        {
            emailObject.removeClass('red').addClass('green');
            //console.log(jQuery(emailObject).val());
        }
        else
        {
            emailObject.removeClass('green').addClass('red');
            //console.log(email + " is not an email");
        }
    }





}); //END FUNCTION


