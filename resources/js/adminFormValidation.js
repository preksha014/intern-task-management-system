import $ from "jquery";
import "jquery-validation";
window.$ = window.jQuery = $;
$("#create-admin-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },
        department: {
            required: true
        },
        position: {
            required: true
        },
        "roles[]": {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please enter the full name",
            minlength: "Name must be at least 3 characters"
        },
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Password must be at least 8 characters"
        },
        password_confirmation: {
            required: "Please confirm the password",
            equalTo: "Passwords do not match"
        },
        department: {
            required: "Please enter the department"
        },
        position: {
            required: "Please enter the position"
        },
        "roles[]": {
            required: "Please select at least one role"
        }
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

$("#edit-admin-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        },
        password: {
            minlength: 8
        },
        password_confirmation: {
            equalTo: "#password"
        },
        department: {
            required: true
        },
        position: {
            required: true
        },
        "roles[]": {
            required: true
        }   

    },
    messages: {
        name: {
            required: "Please enter the full name",
            minlength: "Name must be at least 3 characters"
        },
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            minlength: "Password must be at least 8 characters" 
        },
        password_confirmation: {
            equalTo: "Passwords do not match"
        },
        department: {
            required: "Please enter the department"
        },
        position: {
            required: "Please enter the position"
        },
        "roles[]": {
            required: "Please select at least one role"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
})

$("#create-intern-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        },
        password_confirmation: {
            required: true,
            equalTo: "#password"
        },
        department: {
            required: true
        },
    },
    messages: {
        name: {
            required: "Please enter the full name",
            minlength: "Name must be at least 3 characters"
        },
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Password must be at least 8 characters"
        },
        password_confirmation: {
            required: "Please confirm the password",
            equalTo: "Passwords do not match"
        },
        department: {
            required: "Please enter the department"
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
})

$("#edit-intern-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        email: {
            required: true,
            email: true
        },
        password: {
            minlength: 8
        },
        password_confirmation: {
            equalTo: "#password"
        },
        department: {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please enter the full name",
            minlength: "Name must be at least 3 characters"
        },
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            minlength: "Password must be at least 8 characters"
        },
        password_confirmation: {
            equalTo: "Passwords do not match"
        },
        department: {
            required: "Please enter the department"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }   
})

$("#assign-task-form").validate({
    rules: {
        task: {
            required: true
        },
        intern: {
            required: true
        },
    },
    messages: {
        task: {
            required: "Please select a task"
        },
        intern: {
            required: "Please select an intern"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }

})

$("#create-task-form").validate({
    rules: {
        title: {
            required: true,
            minlength: 3
        },
        description: {
            required: true,
            minlength: 10
        },
        due_date: {
            required: true
        },
        status: {
            required: true
        },
        "interns[]":{
            required: true
        }
    },
    messages: {
        title: {
            required: "Please enter the title",
            minlength: "Title must be at least 3 characters"
        },
        description: {
            required: "Please enter the description",
            minlength: "Description must be at least 10 characters"
        },
        due_date: {
            required: "Please enter the due date"
        },
        status: {
            required: "Please select the status"
        },
        "interns[]": {
            required: "Please select at least one intern"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
})

$("#edit-task-form").validate({
    rules: {
        title: {
            required: true,
            minlength: 3
        },
        description: {
            required: true,
            minlength: 10
        },
        due_date: {
            required: true
        },
        status: {
            required: true
        },
        "interns[]":{
            required: true
        }
    },
    messages: {
        title: {
            required: "Please enter the title",
            minlength: "Title must be at least 3 characters"
        },
        description: {
            required: "Please enter the description",
            minlength: "Description must be at least 10 characters"
        },
        due_date: {
            required: "Please enter the due date"
        },
        status: {
            required: "Please select the status"
        },
        "interns[]": {
            required: "Please select at least one intern"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
})

$("#admin-comment-form").validate({
    rules: {
        comment: {
            required: true,
            minlength: 3
        }
    },
    messages: {
        comment: {
            required: "Please enter the comment",
            minlength: "Comment must be at least 3 characters"
        }
    },  
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    }
})