function formValidation() {
    //var form = document.getElementById("form");
    var fname = document.getElementById("fname");
    var lname = document.getElementById("lname");
    var email = document.getElementById("email");
    var mobile = document.getElementById("mobile");
    var password1 = document.getElementById("password1");
    var password2 = document.getElementById("password2");

    /* ErrorHandle */
    function errorHandle(idName, message) {
        document.getElementById(idName).style.borderColor = "red";
        document.getElementById(idName + "Error").innerHTML = message;
        document.getElementById(idName + "Error").style.visibility = "visible";
        document.getElementById(idName).focus();
    }

    /* CorrectHandle */
    function correctHandle(idName) {
        document.getElementById(idName).style.borderColor = "green";
        document.getElementById(idName + "Error").style.visibility = "hidden";
    }

    /* EmailHandle */
    function emailHandle(email) {
        return /^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/.test(email);
    }

    /* PasswordHandle */
    function passwordHandle(password) {
        var rules = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z])(?=.*[^a-zA-Z0-9])(?!.*\s).{6,20}$/;
        if (password.match(rules)) {
            return true;
        } else {
            return false;
        }
    }

    /* Prevent auto submitting the form */
    // form.addEventListener("submit", (e) => {
    //     e.preventDefault();
    // });

    var fnameValue = fname.value.trim();
    var fnameSplit = fnameValue.split(" ");
    var lnameValue = lname.value.trim();
    var lnameSplit = lnameValue.split(" ");
    var emailValue = email.value.trim();
    var mobileValue = mobile.value.trim();
    var passwordValue1 = password1.value;
    var passwordValue2 = password2.value;

    /* Regex */
    var fnameRegex = /^[a-zA-Z-' ]+$/;
    var lnameRegex = /^[a-zA-Z-' \/]+$/;

    /* fname */
    if (fnameValue == "") {
        errorHandle("fname", "First Name cannot be blank!");
        return false;
    } else if (!fnameRegex.test(fnameValue)) {
        errorHandle("fname", "First Name can have letters only!");
        return false;
    } else {
        for (let i = 0; i < fnameSplit.length; i++) {
            if (fnameSplit[i].charCodeAt(0) < 65 || fnameSplit[i].charCodeAt(0) > 90) {
                errorHandle("fname", "First Character of each word must be in Capital Letter!");
                return false;
            }
        }
        correctHandle("fname");
    }

    /* lname */
    if (lnameValue == "") {
        errorHandle("lname", "Last Name cannot be blank!")
        return false;
    } else if (!lnameRegex.test(lnameValue)) {
        errorHandle("lname", "Last Name can have letters and / only!");
    } else {
        for (let i = 0; i < lnameSplit.length; i++) {
            if (lnameSplit[i].charCodeAt(0) < 65 || lnameSplit[i].charCodeAt(0) > 90) {
                errorHandle("lname", "First Character of each word must be in Capital Letter!");
                return false;
            }
        }
        correctHandle("lname");
    }

    /* email */
    if (emailValue == "") {
        errorHandle("email", "Email cannot be blank!")
        return false;
    } else {
        if (emailHandle(emailValue)) {
            correctHandle("email");
        } else {
            errorHandle("email", "Please enter a valid email!")
            return false;
        }
    }

    /* mobile */
    if (mobileValue == "") {
        errorHandle("mobile", "Mobile number cannot be blank!")
        return false;
    } else if (mobileValue.length < 9 || mobileValue.length > 10){
        errorHandle("mobile", "Please enter a valid mobile number!")
        return false;
    } else {
        mobile = mobileValue;
        correctHandle("mobile");
    }

    /* password1 */
    if (passwordValue1 == "") {
        errorHandle("password1", "Password cannot be blank!")
        return false;
    } else {
        if (passwordHandle(passwordValue1)) {
            correctHandle("password1");
        } else {
            errorHandle("password1", "Password must have Uppercase, Lowercase, Special <br> Character, Numbers and No Space!");
            return false;
        }
    }

    /* password2 */
    if (passwordValue2 == "") {
        errorHandle("password2", "Password cannot be blank!")
        return false;
    } else {
        if (passwordValue2 == passwordValue1) {
            correctHandle("password2");
        } else {
            errorHandle("password2", "Password does not match!");
            return false;
        }
    }

    /* t&c */
    if (document.getElementById("t&c").checked == false) {
        errorHandle("t&c", "Please read the Terms and Conditions!");
        return false;
    } else {
        correctHandle("t&c");
        return true;
    }
}

/* password visibility */
function isVisible(idName1, idName2, idName3) {
    var x = document.getElementById(idName1);
    if (x.type === "password") {
        x.type = "text";
        document.getElementById(idName2).style.visibility = "hidden";
        document.getElementById(idName3).style.visibility = "visible";
    } else {
        x.type = "password";
        document.getElementById(idName3).style.visibility = "hidden";
        document.getElementById(idName2).style.visibility = "visible";
    }
}

/* successDisplay */
function successDisplay(idName) {
    if (document.getElementById(idName).style.visibility == "hidden") {
        document.getElementById(idName).style.visibility = "visible";
    } else {
        document.getElementById(idName).style.visibility = "hidden";
    }
}

/* Password Validation Display */
var message = document.getElementById("message");
var myInput = document.getElementById("password1");
var error = document.getElementById("password1Error");
var letter = document.getElementById("letter");
var capital = document.getElementById("capital");
var number = document.getElementById("number");
var specialChar = document.getElementById("specialChar");
var length = document.getElementById("length"); 
var space = document.getElementById("space");

// When the user clicks on the password field, show the message box
myInput.onfocus = function() {
    message.style.display = "block";
    error.style.visibility = "hidden";
}

// When the user clicks outside of the password field, hide the message box
myInput.onblur = function() {
    message.style.display = "none";
    error.style.visibility = "visible";
}

// When the user starts to type something inside the password field
myInput.onkeyup = function() {
    var lowerCaseLetters = /[a-z]/g;
    var upperCaseLetters = /[A-Z]/g;
    var numbers = /[0-9]/g;
    var specialCharRegex = /[`~!@#$%^&*()_|+\-=?;:'",.<>\{\}\[\]\\\/]/g;
    var spaceRegex = /\s/g;

    function passwordValidation(id, regex) {
        if (myInput.value.match(regex)) {  
            id.classList.remove("invalid");
            id.classList.add("valid");
        } else {
            id.classList.remove("valid");
            id.classList.add("invalid");
        }
    }
    
    passwordValidation(letter, lowerCaseLetters);
    passwordValidation(capital, upperCaseLetters);
    passwordValidation(number, numbers);
    passwordValidation(specialChar, specialCharRegex);

    if (myInput.value.match(spaceRegex)) {
        space.classList.remove("valid");
        space.classList.add("invalid");
    } else {
        space.classList.remove("invalid");
        space.classList.add("valid");
    }

    // Validate length
    if (myInput.value.length >= 6) {
        length.classList.remove("invalid");
        length.classList.add("valid");
    } else {
        length.classList.remove("valid");
        length.classList.add("invalid");
    }
}