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
}

function turnOffUserView() {
    document.getElementById("addUserView").style.display = "none";
}

//deleteUser View
function deleteUser(){
    document.getElementById("deleteUserView").style.display = "block";
}

function turnOffUserDelete(){
    document.getElementById("deleteUserView").style.display = "none";
}

//editUser View
function editUser(){
    document.getElementById("editUserView").style.display = "block";
}

function turnOffUserEdit(){
    document.getElementById("editUserView").style.display = "none";
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



