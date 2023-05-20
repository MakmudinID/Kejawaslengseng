$('#birth').datetimepicker({
    format: 'MM/DD/YYYY'
});

$('#state').select2({
    theme: "bootstrap"
});

/* validate */

// validation when select change
$("#state").change(function () {
    $(this).valid();
})

// validation when inputfile change
$("#uploadImg").on("change", function () {
    $(this).parent('form').validate();
})

$("#exampleValidation").validate({
    validClass: "success",
    rules: {
        gender: { required: true },
        confirmpassword: {
            equalTo: "#password"
        },
        birth: {
            date: true
        },
        uploadImg: {
            required: true,
        },
    },
    highlight: function (element) {
        $(element).closest('.form-group').removeClass('has-success').addClass('has-error');
    },
    success: function (element) {
        $(element).closest('.form-group').removeClass('has-error').addClass('has-success');
    },
});