import $ from "jquery";
import "jquery-validation";
window.$ = window.jQuery = $;

$("#register-form").validate({
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

$("#login-form").validate({
    rules: {
        email: {
            required: true,
            email: true
        },
        password: {
            required: true,
            minlength: 8
        }
    },
    messages: {
        email: {
            required: "Please enter an email address",
            email: "Please enter a valid email address"
        },
        password: {
            required: "Please provide a password",
            minlength: "Password must be at least 8 characters"
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
        "task_id[]": {
            required: true
        },
        "intern_id": {
            required: true
        }
    },
    messages: {
        "task_id[]": {
            required: "Please select a task"
        },
        "intern_id": {
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
        content: {
            required: true,
            minlength: 3
        }
    },
    messages: {
        content: {
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

$("#create-role-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        description: {
            required: true,
            minlength: 10
        },
        "permissions[]": {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please enter the role name",
            minlength: "Role name must be at least 3 characters"
        },
        description: {
            required: "Please enter the role description",
            minlength: "Role description must be at least 10 characters"
        },
        "permissions[]": {
            required: "Please select at least one permission"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") === "permissions[]") {
            error.insertAfter("#permissions-wrapper");
        } else {
            error.insertAfter(element);
        }
    }
});

$("#edit-role-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
        description: {
            required: true,
            minlength: 10
        },
        "permissions[]": {
            required: true
        }
    },
    messages: {
        name: {
            required: "Please enter the role name",
            minlength: "Role name must be at least 3 characters"
        },
        description: {
            required: "Please enter the role description",
            minlength: "Role description must be at least 10 characters"
        },
        "permissions[]": {
            required: "Please select at least one permission"
        }
    },
    errorClass: "text-red-600 text-sm mt-1",
    errorElement: "div",
    highlight: function (element) {
        $(element).addClass("border-red-500");
    },
    unhighlight: function (element) {
        $(element).removeClass("border-red-500");
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") === "permissions[]") {
            error.insertAfter("#permissions-wrapper");
        } else {
            error.insertAfter(element);
        }
    }
})

$("#create-permission-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
    },
    messages: {
        name: {
            required: "Please enter the permission name",
            minlength: "Permission name must be at least 3 characters"
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

$("#edit-permission-form").validate({
    rules: {
        name: {
            required: true,
            minlength: 3
        },
    },
    messages: {
        name: {
            required: "Please enter the permission name",
            minlength: "Permission name must be at least 3 characters"
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

$("#messageForm").validate({
    rules: {
        content: {
            required: true,
            minlength: 10
        }
    },
    messages: {
        content: {
            required: "Please enter the message",
            minlength: "Message must be at least 10 characters"
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