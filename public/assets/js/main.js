"use strict";
$(document).ready(function () {
    $("#depertment_select").select2({
        placeholder: "Select Your Department",
    });
    $("#designation_select").select2({
        placeholder: "Select Your Designation",
    });
    $("#selectMeals").select2({
        placeholder: "Select Your Meals",
        dropdownParent: $("#addFoodModal"),
    });
    $("#selectExam").select2({
        placeholder: "Select Exam...",
    });
    $("#question_type").select2({
        placeholder: "Select Question Type...",
    });
    $("#roleUpdateSelect").select2({
        placeholder: "Select Employee Role",
        dropdownParent: $("#editFoodModal"),
    });

    $("#roleAddSelect").select2({
        placeholder: "Select Employee Role",
        dropdownParent: $("#addSKfModal"),
    });

    //added by Rifat Naeem
    $("#addStaffRole").select2({
        placeholder: "Select Role",
        dropdownParent: $("#addSKfModal"),
    });

    $("#addStaffDepartment").select2({
        placeholder: "Select Department",
        dropdownParent: $("#addSKfModal"),
    });

    $("#time_specification").select2({
        placeholder: "Select Specification...",
        dropdownParent: $("#addSKfModal"),
    });

    $("#parent_id").select2({
        placeholder: "Select department",
        dropdownParent: $("#addSKfModal"),
    });

    //end

    $("#addManageDep").select2({
        placeholder: "Select Employee Department",
        dropdownParent: $("#addSKfModal"),
    });

    $("#mangeAddSelect").select2({
        placeholder: "Select Employee Role",
        dropdownParent: $("#editFoodModal"),
    });

    //Add Mahfuj--08.03.22
    $("#selectEmployee").select2({
        placeholder: "Select Emp.",
    });
    $("#cartNumber0").select2();
    $('input[name="order_delivery_date-1"]').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        startDate: moment().startOf("hour"),
        endDate: moment().startOf("hour").add(32, "hour"),
        locale: {
            format: "M/DD hh:mm A",
        },
    });

    //End

    //Add Mahfuj-13.03.22
    $("#payment_status").select2({
        placeholder: "Select status.",
    });
    $("#statusSelect").select2({
        placeholder: "Select Payment.",
    });
    //End Mahfuj-13.03.22

    //Summernote Editor
    $("#summernote").summernote({
        height: 250,
        placeholder: "Write Your Email",

    });

    //Date Picker
    var start = moment().subtract(29, "days");
    var end = moment();

    function cb(start, end) {
        $("#reportrange span").html(
            start.format("MMM D, YYYY") + " - " + end.format("MMM D, YYYY")
        );
    }

    $("#reportrange,#editDate").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Tomorrow: [moment().add(1, "days"), moment().add(1, "days")],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },

        cb
    );

    $("#mealCalender,#mealHeaderInput,#editDate").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                Today: [moment(), moment()],
                Tomorrow: [moment().add(1, "days"), moment().add(1, "days")],
                // "Last 7 Days": [moment().subtract(6, "days"), moment()],
                // "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                // "Last Month": [
                //     moment().subtract(1, "month").startOf("month"),
                //     moment().subtract(1, "month").endOf("month"),
                // ],
            },
        },

        cb
    );

    $("#editDate1").daterangepicker(
        {
            startDate: start,
            endDate: end,
            ranges: {
                select: "Select Date",
                Today: [moment(), moment()],
                Yesterday: [
                    moment().subtract(1, "days"),
                    moment().subtract(1, "days"),
                ],
                "Last 7 Days": [moment().subtract(6, "days"), moment()],
                "Last 30 Days": [moment().subtract(29, "days"), moment()],
                "This Month": [
                    moment().startOf("month"),
                    moment().endOf("month"),
                ],
                "Last Month": [
                    moment().subtract(1, "month").startOf("month"),
                    moment().subtract(1, "month").endOf("month"),
                ],
            },
        },
        cb
    );

    cb(start, end);

    //Food Popup
    $(".food_img").magnificPopup({
        type: "image",
        gallery: {
            enabled: true,
        },
    });
    $(".meal_setter_food_img,.order_food_img").magnificPopup({
        type: "image",
    });
});

function editSelectBox(id) {
    return id;
}

// Form Validation
var forms = document.querySelectorAll(".needs-validation");

// Loop over them and prevent submission
Array.prototype.slice.call(forms).forEach(function (form) {
    form.addEventListener(
        "submit",
        function (event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
            }

            form.classList.add("was-validated");
        },
        false
    );
});

//Password Visibility
//01.Login
let inputPassword1 = document.querySelector("#password_input1");
if (inputPassword1) {
    inputPassword1.addEventListener("click", () => {
        passwordVisibility(
            "password_input1",
            "password_eye_icon_area1",
            "eyeOpen1",
            "eyeClose1"
        );
    });
}

//Register
let inputPassword2 = document.querySelector("#password_input2");
if (inputPassword2) {
    inputPassword2.addEventListener("click", () => {
        passwordVisibility(
            "password_input2",
            "password_eye_icon_area2",
            "eyeOpen2",
            "eyeClose2"
        );
    });
}

function passwordVisibility(inputId, eyeIconArea, eyeOpen, eyeClose) {
    let passwordInput = document.getElementById(inputId);
    let passwordIconArea = document.getElementById(eyeIconArea);
    let eyeOpenIcon = document.getElementById(eyeOpen);
    let eyeCloseIcon = document.getElementById(eyeClose);
    passwordIconArea.style.cssText = "display:inline";
    eyeOpenIcon.addEventListener("click", () => {
        if (passwordInput.type === "password") {
            passwordInput.type = "text";
        }
        eyeOpenIcon.style.cssText = "display:none";
        eyeCloseIcon.style.cssText = "display:inline";
    });
    eyeCloseIcon.addEventListener("click", () => {
        if (passwordInput.type === "text") {
            passwordInput.type = "password";
        }
        eyeCloseIcon.style.cssText = "display:none";
        eyeOpenIcon.style.cssText = "display:inline";
    });
}

//Sidebar Menu
//--Hover Background
let menuList = document.querySelectorAll(".menu_list_area li");
function showHover() {
    menuList.forEach((item) => {
        item.classList.remove("hoverd");
        this.classList.add("hoverd");
    });
}

menuList.forEach((item) => {
    item.addEventListener("mouseover", showHover);
});

//--Menu Toggle
let menuButton = document.querySelector("#menuButton");
let menuSidebar = document.querySelector("#menuSidebar");
let dashboardContentArea = document.querySelector("#dashboardContentArea");
if (menuButton) {
    menuButton.addEventListener("click", () => {
        menuSidebar.classList.toggle("toggleSidebar");
        dashboardContentArea.classList.toggle("dashboard_active");
    });
}

 //Mobile Menu Area
 let menuSidebarMobile =  document.querySelector("#menuSidebar");
 let mobileToggleIcon =  document.querySelector("#mobileToggleIcon");
 let mobileCloseIcon =  document.querySelector("#mobileCloseIcon");
 let mobileOverlay =  document.querySelector("#mobileOverlay");
 if(mobileToggleIcon){
   mobileToggleIcon.addEventListener("click",()=>{
     menuSidebarMobile.classList.add("mobileSidebarActive");
     mobileOverlay.classList.add("mobileOverlyActive");
   })
 }
 if(mobileCloseIcon){
  mobileCloseIcon.addEventListener("click",()=>{
    menuSidebarMobile.classList.remove("mobileSidebarActive");
    mobileOverlay.classList.remove("mobileOverlyActive");
  })
 }
 if(mobileOverlay){
  mobileOverlay.addEventListener("click",()=>{
    menuSidebarMobile.classList.remove("mobileSidebarActive")
    mobileOverlay.classList.remove("mobileOverlyActive");
  })
 }

//Edit Alert
let deleteFoodList = document.querySelectorAll("#deleteFoodList");
for (let x of deleteFoodList) {
    x.addEventListener("click", () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonColor: "#3085d6",
            cancelButtonColor: "#d33",
            confirmButtonText: "Yes, delete it!",
        }).then((result) => {
            if (result.isConfirmed) {
                Swal.fire("Deleted!", "Your file has been deleted.", "success");
            }
        });
    });
}

//Check Input
let checkboxes = document.querySelectorAll("#foodListTable #flexCheckDefault");

function checkAll(myCheckbox) {
    if (myCheckbox.checked == true) {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = true;
        });
    } else {
        checkboxes.forEach(function (checkbox) {
            checkbox.checked = false;
        });
    }
}

//Profile Dropdwon
let userImage = document.querySelector("#userImage");
let profileDropdown = document.querySelector("#profileDropdown");
let profileOverlay = document.querySelector("#profileOverlay");
function dropdown(profile) {
    let profileArea = document.querySelector(profile);
    profileArea.classList.toggle("profileActive");
}
function removeDropdown(profile) {
    let profileArea = document.querySelector(profile);
    profileArea.classList.remove("profileActive");
}
if (userImage) {
    userImage.addEventListener("click", () => {
        dropdown("#profileDropdown");
    });
}
if (profileOverlay) {
    profileOverlay.addEventListener("click", () => {
        removeDropdown("#profileDropdown");
    });
}

//Profile Update
let editProfileButton = document.querySelector("#editProfileButton");
let discardButton = document.querySelector("#discardButton");
let profileFormArea = document.querySelectorAll("#profileFormArea input ");
let profileFormAreaSelect = document.querySelectorAll(
    "#profileFormArea select "
);
function updteProfile(text) {
    editProfileButton.innerText = text;
    for (let x of profileFormArea) {
        x.disabled = false;
    }
    for (let x of profileFormAreaSelect) {
        x.disabled = false;
    }
}
function updteProfileDisabled(text) {
    editProfileButton.innerText = text;
    for (let x of profileFormArea) {
        x.disabled = true;
    }
    for (let x of profileFormAreaSelect) {
        x.disabled = true;
    }
}

// if (editProfileButton) {
//   editProfileButton.addEventListener("click", () => {
//     updteProfile("Save Changes");
//     discardButton.style.cssText = "display:block;";
//   });
// }

if (editProfileButton) {
    editProfileButton.addEventListener("click", () => {
        var innerTextEditBtn = editProfileButton.innerText;
        if (innerTextEditBtn == "Save Changes") {
            let name = document.getElementById("name").value;
            let email = document.getElementById("email").value;
            let department_id =
                document.getElementById("depertment_select").value;
            let skf_employee_id =
                document.getElementById("skf_employee_id").value;
            let designation_id =
                document.getElementById("designation_select").value;
            let image = document.getElementById("changeUserImage").value;

            var error_profile_name =
                document.getElementById("error_profile_name");
            var error_profile_skf_employee_id = document.getElementById(
                "error_profile_skf_employee_id"
            );
            var error_profile_designation = document.getElementById(
                "error_profile_designation"
            );
            var error_profile_department = document.getElementById(
                "error_profile_department"
            );
            var error_profile_email = document.getElementById(
                "error_profile_email"
            );

            if (
                name != "" &&
                email != "" &&
                department_id != "" &&
                designation_id != "" &&
                skf_employee_id != ""
            ) {
                document.getElementById("profileFormArea").submit();
            } else {
                if (name == "") {
                    error_profile_name.innerText = "Name field is required.";
                }
                if (name != "") {
                    error_profile_name.innerText = "";
                }

                if (email == "") {
                    error_profile_email.innerText = "Email field is required.";
                }
                if (email != "") {
                    error_profile_email.innerText = "";
                }

                if (department_id == "") {
                    error_profile_department.innerText =
                        "Department field is required.";
                }
                if (department_id != "") {
                    error_profile_department.innerText = "";
                }

                if (designation_id == "") {
                    error_profile_designation.innerText =
                        "Designation field is required.";
                }
                if (designation_id != "") {
                    error_profile_designation.innerText = "";
                }

                if (skf_employee_id == "") {
                    error_profile_skf_employee_id.innerText =
                        "SKF employee id field is required.";
                }
                if (skf_employee_id != "") {
                    error_profile_skf_employee_id.innerText = "";
                }

                return false;
            }
        }

        updteProfile("Save Changes", "disabled");
        discardButton.style.cssText = "display:block;";
    });
}

if (discardButton) {
    discardButton.addEventListener("click", () => {
        updteProfileDisabled("Edit Profile");
        discardButton.style.cssText = "display:none;";
    });
}

function changeAlert(alertText) {
    Swal.fire("Good job!", `Change Your ${alertText}`, "success");
}

// if (document.querySelector("#updateEmail")) {
//   document.querySelector("#updateEmail").addEventListener("click", () => {
//     changeAlert("Email");
//   });
// }

if (document.querySelector("#updateEmail")) {
    document.querySelector("#updateEmail").addEventListener("click", () => {
        let email = document.getElementById("change_email").value;
        let password = document.getElementById("change_password").value;
        var error_change_password = document.getElementById(
            "error_change_password"
        );
        var error_change_email = document.getElementById("error_change_email");

        if (password != "" && email != "") {
            document.getElementById("changeEmailForm").submit();
        } else {
            if (email == "") {
                error_change_email.innerText = "Email field is required.";
            }
            if (email != "") {
                error_change_email.innerText = "";
            }

            if (password == "") {
                error_change_password.innerText = "Password field is required.";
            }
            if (password != "") {
                error_change_password.innerText = "";
            }

            return false;
        }
        // changeAlert("Email");
    });
}

// if (document.querySelector("#updatePassword")) {
//   document.querySelector("#updatePassword").addEventListener("click", () => {
//     changeAlert("Password");
//   });
// }

if (document.querySelector("#updatePassword")) {
    document.querySelector("#updatePassword").addEventListener("click", () => {
        let reset_current_password = document.getElementById(
            "reset_current_password"
        ).value;
        let reset_new_password =
            document.getElementById("reset_new_password").value;
        let reset_new_confirm_Password = document.getElementById(
            "reset_new_confirm_Password"
        ).value;

        var error_reset_current_password = document.getElementById(
            "error_reset_current_password"
        );
        var error_reset_new_Password = document.getElementById(
            "error_reset_new_Password"
        );
        var error_reset_new_confirm_Password = document.getElementById(
            "error_reset_new_confirm_Password"
        );

        if (
            reset_current_password != "" &&
            reset_new_confirm_Password != "" &&
            reset_new_confirm_Password == reset_new_password &&
            reset_new_password != "" &&
            reset_new_password.length > 5
        ) {
            document.getElementById("resetPasswordForm").submit();
        } else {
            if (reset_current_password == "") {
                error_reset_current_password.innerText =
                    "Current password field is required.";
            }
            if (reset_current_password != "") {
                error_reset_current_password.innerText = "";
            }

            if (reset_new_password == "") {
                error_reset_new_Password.innerText =
                    "New Password field is required.";
            }
            if (reset_new_password != "") {
                if (reset_new_password.length < 6) {
                    error_reset_new_Password.innerText =
                        "Your password must be at least 6 characters.";
                } else {
                    error_reset_new_Password.innerText = "";
                }
            }

            if (reset_new_confirm_Password == "") {
                error_reset_new_confirm_Password.innerText =
                    "Confirm Password field is required.";
            }
            if (reset_new_confirm_Password != "") {
                error_reset_new_confirm_Password.innerText = "";
            }

            if (
                reset_new_confirm_Password != reset_new_password &&
                reset_new_confirm_Password != "" &&
                reset_new_password != ""
            ) {
                error_reset_new_confirm_Password.innerText =
                    "Confirm Password & New Password field dose not match!.";
            }

            if (
                reset_new_confirm_Password == reset_new_password &&
                reset_new_confirm_Password != "" &&
                reset_new_password != "" &&
                reset_new_password.length < 6
            ) {
                error_reset_new_Password.innerText =
                    "Your password must be at least 6 characters.";
            }

            return false;
        }
        // changeAlert("Password");
    });
}

function hideChangeForm(hideArea) {
    let hideSection = document.querySelector(hideArea);
    hideSection.classList.add("change_active");
}
if (document.querySelector("#changeEmailButton")) {
    document
        .querySelector("#changeEmailButton")
        .addEventListener("click", () => {
            hideChangeForm("#changeEmailForm");
        });
}
if (document.querySelector("#resetPasswordButton")) {
    document
        .querySelector("#resetPasswordButton")
        .addEventListener("click", () => {
            hideChangeForm("#resetPasswordForm");
        });
}
function hideChangeForm2(hideArea) {
    let hideSection = document.querySelector(hideArea);
    hideSection.classList.remove("change_active");
}
if (document.querySelector("#emailChangeCancel")) {
    document
        .querySelector("#emailChangeCancel")
        .addEventListener("click", () => {
            hideChangeForm2("#changeEmailForm");
        });
}
if (document.querySelector("#resetPassowrdCanelButton")) {
    document
        .querySelector("#resetPassowrdCanelButton")
        .addEventListener("click", () => {
            hideChangeForm2("#resetPasswordForm");
        });
}

//Checkout Sidebar
let checkoutSidebar = document.querySelector("#checkoutSidebar");
let cartIcon = document.querySelector("#cartIcon");
let addCartButton = document.querySelectorAll("#addCartButton");
let checkoutOverlay = document.querySelector("#checkoutOverlay");
let closeCardIcon = document.querySelector("#closeCardIcon");
let cancelButton = document.querySelector("#cancelButton");

function DispalyCheckout() {
    checkoutSidebar.classList.add("chackoutActive");
    checkoutOverlay.classList.add("chackoutOverlyActive");
}
function CloseCheckout() {
    checkoutSidebar.classList.remove("chackoutActive");
    checkoutOverlay.classList.remove("chackoutOverlyActive");
}

if (cartIcon) {
    cartIcon.addEventListener("click", () => {
        DispalyCheckout();
    });
}
if (closeCardIcon) {
    closeCardIcon.addEventListener("click", () => {
        CloseCheckout();
    });
}
if (cancelButton) {
    cancelButton.addEventListener("click", () => {
        CloseCheckout();
    });
}
if (checkoutOverlay) {
    checkoutOverlay.addEventListener("click", () => {
        CloseCheckout();
    });
}
if (addCartButton) {
    for (let x of addCartButton) {

        x.addEventListener("click", () => {
            DispalyCheckout();
        });
    }
}

