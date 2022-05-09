
//1. ------------- aceesing value attribute by id
// document.getElementById("email-phone").value;

// var c=console.log(document.getElementById("email-phone").value);

// document.getElementById("log-in").onclick = alert("hello");


// document.getElementById("pass").value= 456;

function loginValidate() {

    console.log("hello");

    var email = document.getElementById("email-phone").value;
    var password = document.getElementById("login-pass").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var validphone = /^\d{11}$/;
    var validpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$/;
    if (email == "") {
        alert("Please enter the Email Adress");
    }
    else if (password == "") {

        alert("Please enter the Password");
    }
    else if (!email.match(validRegex) && !email.match(validphone)) {

        alert("InValid email address!");

    }
    else if (!password.match(validpass)) {

        alert("InValid password! Password Must Contain one capital letter, one small letter, one number and should be of length 8 to 12 characters");
    }
    else {

        alert("Form Submitted Successfully");
    }
}
