"use strict";
$(document).ready(function () {
  $("#depertment_select").select2({
    placeholder: "Select Your Department",
  });
  $("#designation_select").select2({
    placeholder: "Select Your Designation",
  });
  $("#cartNumber,#cartNumber2").select2();
  $("#createUserSelect").select2({
    placeholder: "Select Your User",
  });
  $("#paymentUserSelect").select2({
    placeholder: "Select Payment Method",
  });
  $("#skfDesignationSelect").select2({
    placeholder: "Select Your Designation",
    dropdownParent: $(".staffSkfAddModal"),
  });

  $("#selectMeals").select2({
    placeholder: "Select Your Meals",
    dropdownParent: $("#addFoodModal"),
  });
  $("#userEmail").select2({
    placeholder: "Select Your Users",
  });
  $("#roleUpdateSelect").select2({
    placeholder: "Select Employee Role",
    dropdownParent: $("#editFoodModal"),
  });
  $("#roleAddSelect").select2({
    placeholder: "Select Department",
    dropdownParent: $("#addSKfModal"),
  });
  $("#addManageDep").select2({
    placeholder: "Select Employee Department",
    dropdownParent: $("#addSKfModal"),
  });
  $("#mangeAddSelect").select2({
    placeholder: "Select Employee Role",
    dropdownParent: $("#editFoodModal"),
  });
  $("#deliveryTo").select2({
    placeholder: "Select Delivery",
  });
  $("#selectEmployee").select2({
    placeholder: "Select Emp.",
  });

  //Summernote Editor
  $("#summernote").summernote({ height: 200 });

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
        Yesterday: [moment().subtract(1, "days"), moment().subtract(1, "days")],
        "Last 7 Days": [moment().subtract(6, "days"), moment()],
        "Last 30 Days": [moment().subtract(29, "days"), moment()],
        "This Month": [moment().startOf("month"), moment().endOf("month")],
        "Last Month": [
          moment().subtract(1, "month").startOf("month"),
          moment().subtract(1, "month").endOf("month"),
        ],
      },
    },
    cb
  );

  cb(start, end);
  $('input[name="birthday"]').daterangepicker({
    singleDatePicker: true,
   
  } );
  //Food Popup
  $(".food_img").magnificPopup({
    type: "image",
    gallery: {
      enabled: true,
    },
  });
});

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

let accrodionList = document.querySelectorAll(".accrodion_list li");
accrodionList.forEach((e) => {
  accrodionList.forEach((e) => {
    e.classList.remove("inner_active");
  });
  e.classList.add("inner_active");
});

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
console.log(checkboxes);

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

if (editProfileButton) {
  editProfileButton.addEventListener("click", () => {
    updteProfile("Save Changes");
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
if (document.querySelector("#updateEmail")) {
  document.querySelector("#updateEmail").addEventListener("click", () => {
    changeAlert("Email");
  });
}
if (document.querySelector("#updatePassword")) {
  document.querySelector("#updatePassword").addEventListener("click", () => {
    changeAlert("Password");
  });
}
function hideChangeForm(hideArea) {
  let hideSection = document.querySelector(hideArea);
  hideSection.classList.add("change_active");
}
if (document.querySelector("#changeEmailButton")) {
  document.querySelector("#changeEmailButton").addEventListener("click", () => {
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
  document.querySelector("#emailChangeCancel").addEventListener("click", () => {
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
for(let x of addCartButton){
  console.log(x);
  x.addEventListener("click",()=>{
    DispalyCheckout()
  })
}
}

//Dashboard Chart
const labelsLineMonth = [
  "January",
  "February",
  "March",
  "April",
  "May",
  "June",
];

const dataLineMonth = {
  labels: labelsLineMonth,
  datasets: [
    {
      label: "Monthly Value",
      backgroundColor: "rgb(255, 99, 132)",
      borderColor: "rgb(255, 99, 132)",
      data: [0, 10, 5, 2, 20, 30, 45],
    },
  ],
};

const configLineMonth = {
  type: "line",
  data: dataLineMonth,

  options: {
    // responsive: true,
    plugins: {
      title: {
        display: true,
      },
      legend: {
        display: false,
      },
    },
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
        },
      },
      y: {
        display: true,
        ticks: {
          callback: function (value, index, values) {
            return "$" + value + "k";
          },
        },
      },
    },
  },
};
const myChart = new Chart(
  document.getElementById("chartLine"),
  configLineMonth
);
const labelsLineWeek = ["Sat", "Sun", "Mon", "Tue", "Wed", "Thu", "Fri"];

const dataLineWeek = {
  labels: labelsLineWeek,
  datasets: [
    {
      label: "Weekly Value",
      backgroundColor: "rgb(255, 99, 132)",
      borderColor: "rgb(255, 99, 132)",
      data: [0, 10, 25, 2, 20, 22, 45],
    },
  ],
};

const configLineWeek = {
  type: "line",
  data: dataLineWeek,

  options: {
    responsive: true,
    plugins: {
      title: {
        display: true,
      },
      legend: {
        display: false,
      },
    },
    interaction: {
      intersect: false,
    },
    scales: {
      x: {
        display: true,
        title: {
          display: true,
        },
      },
      y: {
        display: true,
        ticks: {
          callback: function (value, index, values) {
            return "$" + value + "k";
          },
        },
      },
    },
  },
};
const myChartWeek = new Chart(
  document.getElementById("chartLineWeek"),
  configLineWeek
);

const labels = ["January", "February", "March", "April", "May", "June", "July"];

const data = {
  labels: labels,
  datasets: [
    {
      backgroundColor: "rgb(255, 99, 132)",
      borderColor: "rgb(255, 99, 132)",
      borderRadius: 10,
      barThickness: 6,
      data: [5, 10, 30, 25, 20, 40, 45],
    },
  ],
};

const config = {
  type: "bar",
  data: data,
  options: {
    responsive: true,
    plugins: {
      legend: {
        display: false,
      },
    },
  },
};

const myChartBar = new Chart(document.getElementById("chartBar"), config);

//Notification Icon Toggle
let notificationIcon = document.querySelector("#notificationIcon");
let notificationArea = document.querySelector("#notificationArea");
if (notificationIcon) {
  notificationIcon.addEventListener("click", () => {
    notificationArea.classList.toggle("notification_active");
  });
}
