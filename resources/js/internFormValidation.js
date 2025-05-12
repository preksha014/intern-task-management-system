import $ from "jquery";
import "jquery-validation";
window.$ = window.jQuery = $;

$("#register-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 2,
        },
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 8,
        },
        password_confirmation: {
            required: true,
            equalTo: "#password",
        },
        department: {
            required: true,
        },

    },
    messages: {
        name: {
            required: "Please enter your name",
            minlength: "Your name must be at least 2 characters long",
        },
        email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address",
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
        },
        password_confirmation: {
            required: "Please confirm your password",
            equalTo: "Passwords do not match",
        },
        department: {
            required: "Please select a department",
        },
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
});

$("#login-form").validate({
    rules: {
        email: {
            required: true,
            email: true,
        },
        password: {
            required: true,
            minlength: 8,
        },
    },
    messages: {
        email: {
            required: "Please enter your email address",
            email: "Please enter a valid email address",
        },
        password: {
            required: "Please provide a password",
            minlength: "Your password must be at least 8 characters long",
        },
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
});

$("#messageForm").validate({
    rules: {
        content: {
            required: true,
            minlength: 10,
        },
    },
    messages: {
        content: {
            required: "Please enter a message",
            minlength: "Your message must be at least 10 characters long",
        },
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
});

$("#intern-comment-form").validate({
    rules: {
        content: {
            required: true,
            minlength: 10,
        },
    },
    messages: {
        content: {
            required: "Please enter a comment",
            minlength: "Your comment must be at least 10 characters long",
        },
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
});