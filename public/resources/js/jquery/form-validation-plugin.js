$(document).ready( function() {
    // Initialize form validation on the contact form.
    // It has the name attribute "contact_Form"
    $("form[name='contact_Form']").validate({
        // Specify validation rules
        rules: {
            // The key name on the left side is the name attribute
            // of an input field. Validation rules are defined
            // on the right side
            contact_Name: "required",
            contact_State: "required",
            contact_City: "required",
            contact_Email: {
                required: true,
                // Specify that email should be validated
                // by the built-in "email" rule
                email: true
            },
            contact_Message: "required"
        },
        // Specify validation error messages
        messages: {
            contact_Name: "Please enter your firstname",
            contact_State: "Please enter your state",
            contact_City: "Please enter your city",
            contact_Email: "Please enter a valid email address",
            contact_Message: "Please enter a message"
            /*password: {
                required: "Please provide a password",
                minlength: "Your password must be at least 5 characters long"
            },*/
        },
        // Make sure the form is submitted to the destination defined
        // in the "action" attribute of the form when valid
        submitHandler: function(form) {
            form.submit();
        }
    });

    // Initialize form validation on the registration form.

    // Initialize form validation on the login form.

    // Initialize form validation on the subscribe form.

    // Initialize form validation on the forgot password form.
});