$(document).ready(function() {

    $(".login-btn").click(function() {
        $("#logindiv").css("display", "block");
    });

        $(".register-btn").click(function() {
        $("#registerdiv").css("display", "block");
    });

    $("#cancel-login").click(function() {
        $("#logindiv").hide();
    });

    $("#cancel-register").click(function() {
        $("#registerdiv").hide();
    });

        $("#cancel-success-msg").click(function() {
        $("#success-message").hide();
    });


//contact form popup send-button click event
    $("#send").click(function() {
        var name = $("#name").val();
        var email = $("#email-user").val();
        var password = $("#password-user").val();
        var repassword = $("#re-password-user").val();
        var dob = $("#dob-user").val();
        var rules = $("#rules-user").val();
        if (name == "" || email == "" || password == "" || repassword == "" || dob == "")
        {
            alert("Te rog completeaza toate campurile!");
            return false;
        }
        if (password != repassword) {
            alert("Parolele nu sunt la fel!");
            $("#password-user").val('');
            $("#password-user").css("border", "1px solid #ED5454");
            $("#re-password-user").val('');
            $("#re-password-user").css("border", "1px solid #ED5454");
            return false;
        } else {
            $("#password-user").css("border", "1px solid #ccc");
            $("#re-password-user").css("border", "1px solid #ccc");
        }
        if(!$("#rules-user").is(':checked')) {
            alert("Trebuie sa citesti regulile!");
            return false;
        }
        else
        {
            if (validateEmail(email)) {
                $('#register-box').on("click", ":submit", function(e){
                    var submitVal = $(this).val();
                });
                $('#register-box').submit(function (e) {
                    e.preventDefault();
                    $.ajax({
                        type: 'post',
                        url: '/register',
                        data: $(this).serialize(),
                        success: function () {
                            $("#registerdiv").css("display", "none");
                            $("#success-message").delay(700).fadeIn();
                        }
                    });
                });
            }
            else {
                alert('Adresa de Email incorecta.');
                $("#email-user").css("border", "1px solid #ED5454");
                return false;
            }
            function validateEmail(email) {
                var filter = /^[\w\-\.\+]+\@[a-zA-Z0-9\.\-]+\.[a-zA-z0-9]{2,4}$/;

                if (filter.test(email)) {
                    return true;
                }
                else {
                    return false;
                }
            }
        }
    });

});

 