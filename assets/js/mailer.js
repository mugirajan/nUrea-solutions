$("#contact-form").unbind("submit").bind("submit", function() {

    let form = new FormData(this);
   

    $.ajax({
        url: "./php/mailController.php",
        type: "POST",
        data: form,
        dataType: 'json',
        success:function(response) {
            console.log("Success: ", response)
            if(response.success) {
                // shows a successful message after operation
                $('.mail-messages').html('<div class="alert alert-success">'+
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.message +
                '</div>');

                // remove the mesages
                $(".alert-success").delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                }); // /.alert
            } else {
                // shows a successful message after operation
                $('.mail-messages').html('<div class="alert alert-danger">'+
                    '<button type="button" class="close" data-dismiss="alert">&times;</button>'+
                    '<strong><i class="glyphicon glyphicon-ok-sign"></i></strong> '+ response.message +
                '</div>');

                // remove the mesages
                $(".alert-danger").delay(500).show(10, function() {
                    $(this).delay(3000).hide(10, function() {
                        $(this).remove();
                    });
                }); // /.alert
            }
        },
        error: function(response) {
            console.log("Error: ", response)
            customToast(response.message, "error")
        }
    });

    return false;

});

