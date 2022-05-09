function signupValidate() {

    var firstName = document.getElementById("firstName").value;
    var surName = document.getElementById("surName").value;
    var email = document.getElementById("email-phone").value;
    var password = document.getElementById("password1").value;
    var validRegex = /^[a-zA-Z0-9.!#$%&'*+/=?^_`{|}~-]+@[a-zA-Z0-9-]+(?:\.[a-zA-Z0-9-]+)*$/;
    var validphone = /^\d{11}$/;
    var validpass = /^(?=.*[a-z])(?=.*[A-Z])(?=.*[0-9]).{8,12}$/;
    if (firstName == "") {
        alert("Please enter the First Name");
    }
    else if (surName == "") {
        alert("Please enter the Sur Name");
    }

    else if (!email.match(validRegex) && !email.match(validphone)) {

        alert("InValid email address!");
    }
    else if (!password.match(validpass)) {
        alert("InValid password! Password Must Contain one capital letter, one small letter, one number and should be of length 8 to 12 characters");
    }

    else if (!document.getElementById('Male').checked && !document.getElementById('Female').checked && !document.getElementById('Custom').checked) {
        alert("Select Male/Female");
    }
    else {
        alert("Form Submitted Successfully");
    }
}