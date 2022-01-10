//addProduct View
function addProduct() {
    document.getElementById("addProductView").style.display = "block";
}

function turnOff() {
    document.getElementById("addProductView").style.display = "none";
}

//Edit product view
function editProduct() {
    document.getElementById("editProductView").style.display = "block";
}

function turnOffEdit(){
    document.getElementById("editProductView").style.display = "none";
}

//Delete product view
function deleteProduct() {
    document.getElementById("deleteProductView").style.display = "block";
}

function turnOffDelete(){
    document.getElementById("deleteProductView").style.display = "none";
}

//addUser View
function addUser() {
    document.getElementById("addUserView").style.display = "block";
    //Calculate table height
    let html = document.body.scrollHeight;
    html += 60;
    document.getElementById("addUserView").style.height = html + 'px';
}

function turnOffUserView() {
    document.getElementById("addUserView").style.display = "none";
}

//editUser View
function editUser(userID, fname, lname, email, mobile, state, gender, userType) {
    document.getElementById("editUserView").style.display = "block";
    document.getElementById("userID").value = userID;
    document.getElementById("editfname").value = fname;
    document.getElementById("editlname").value = lname;
    document.getElementById("editemail").value = email;
    document.getElementById("editmobile").value = mobile;
    document.getElementById("editstate").value = state;
    if (gender == 'Male') {
        document.getElementById("editmale").checked = true;
    } else {
        document.getElementById("editfemale").checked = true;
    }
    document.getElementById("userType").value = userType;
}

function turnOffUserEditView() {
    document.getElementById("editUserView").style.display = "none";
}

//deleteUser View
function deleteUser() {
    document.getElementById("deleteUserView").style.display = "block";
}

function turnOffUserDelete() {
    document.getElementById("deleteUserView").style.display = "none";
}

/* successDisplay */
function successDisplay(idName) {
    if (document.getElementById(idName).style.visibility == "hidden") {
        document.getElementById(idName).style.visibility = "visible";
    } else {
        document.getElementById(idName).style.visibility = "hidden";
    }
}

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

