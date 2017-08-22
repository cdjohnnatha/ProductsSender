$(function(){
    $('.alerting-delete').click(function (e) {
        var formId = $(this).attr('formSubmitId');

        e.stopPropagation();
        swal({
            title: "Are you sure?",
            text: "You will not be able to recover this data!",
            type: "warning",
            showCancelButton: true,
            confirmButtonColor: "#DD6B55",
            confirmButtonText: "Yes, delete it!"
        }).then( function () {
            swal("Deleted!", "Your imaginary file has been deleted.", "success").then(function(){
                $('#'+formId).submit();
            });

        });
    });

});