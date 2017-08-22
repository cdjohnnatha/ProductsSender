$(function(){
    $('.alerting-delete').click(function (e) {
        e.stopPropagation();
        console.log('eita');
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!"
        }).then( function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success").then(function(){
                var formId = $('.alerting-warning').attr('formSubmitId');
                $('#'+formId).submit();
            });

        });
    });


    $('.alerting-success').click( function (e) {
        e.stopPropagation();
        swal("Good job!", "Everything seems ok!", "success");
    });


});