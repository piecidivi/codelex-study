/*** MANAGE MODALS ***/
const toggleModalPassword = () => {
    document.querySelector(".password-modal")
        .classList.toggle("modal--hidden");
};

const toggleModalDelete = () => {
    document.querySelector(".delete-modal")
        .classList.toggle("modal--hidden")
}

const spanXPassword = () => {
    document.getElementById("oldPassword").value = "";
    document.getElementById("newPassword").value = "";
    document.getElementById("confirmNewPassword").value = "";
    document.getElementById("confirm_new_password_message").innerHTML = "";
    document.getElementById('confirmNewPassword').className =
        "border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5";
    toggleModalPassword();
}

const cancelPassword = () => {
    document.getElementById("oldPassword").value = "";
    document.getElementById("newPassword").value = "";
    document.getElementById("confirmNewPassword").value = "";
    document.getElementById("confirm_new_password_message").innerHTML = "";
    document.getElementById('confirmNewPassword').className =
        "border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5";
    toggleModalPassword();
}

const spanXDelete = () => {
    toggleModalDelete();
}

const cancelDelete = () => {
    toggleModalDelete();
}

function passwordClick() {
    toggleModalPassword();
}

function deleteClick() {
    toggleModalDelete();
}

/*** PASSWORD VALIDATION AND SUBMIT LISTENER ***/
document.getElementById("change_password")
    .addEventListener("submit", (event) => {
        event.preventDefault();
        // If passwords, do not match -> put out msg - passwords do not match
        const password = document.getElementById("newPassword").value;
        const confirmPassword = document.getElementById("confirmNewPassword").value;

        if (password !== confirmPassword) {
            document.getElementById("confirm_new_password_message").innerHTML = "Passwords need to match!";
            return;
        }

        document.getElementById("change_password").action = "/password";
        document.getElementById("change_password").submit();
    });

function checkNewPassword() {
    if (document.getElementById('newPassword').value ===
        document.getElementById('confirmNewPassword').value) {
        document.getElementById('confirmNewPassword').className =
            "border-2 border-green-700 rounded focus-within:outline-none p-1 mb-0.5";
    } else {
        document.getElementById('confirmNewPassword').className =
            "border-2 border-red-700 rounded focus-within:outline-none p-1 mb-0.5";
    }
}

/*** PICTURE ONLOAD MANAGER ***/
if (window.File && window.FileReader && window.FileList && window.Blob) {
    function showImage() {
        const image = document.getElementById("edit_image");
        const file = document.getElementById("edit_user_image").files[0];
        const filename = file.name;
        const ext = filename.substr(filename.length - 3).toLowerCase();

        if (["gif", "png", "jpg", "jpeg"].includes(ext)) {
            const reader = new FileReader();
            reader.onload = function () {
                image.src = reader.result;
            }
            reader.readAsDataURL(file);
            console.log(file);
        } else {
            // If file does not meet condition set value and preview to none
            document.getElementById("edit_user_image").value = "";
            document.getElementById("edit_image").src = "";
            alert("Please upload only pictures (gif, png, jpg).");
        }

        const reader = new FileReader();
        reader.onload = function () {
            image.src = reader.result;
        }
        reader.readAsDataURL(file);
        console.log(file);
    }
} else {
    alert("Your browser is too old to support HTML5 File API");
}