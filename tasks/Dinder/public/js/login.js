let signupPushed = false;

const functionSelector = {
    login: function () {
        login();
    },
    signup: function () {
        signup();
    },
    confirm: function () {
        confirm();
    }
}

/*** FORM LISTENER ***/
document.getElementById("login_form")
    .addEventListener("submit", (event) => {
        event.preventDefault();
        functionSelector[event.submitter.attributes.id.value]();
    });

function login() {
    document.getElementById("login_form").action = "/login";
    document.getElementById("login_form").submit();
}

/*** Signup loads confirm password field ***/
function signup() {
    console.log("signup is good");
    if (signupPushed === false) {

        const email = document.getElementById("email").value;
        const password = document.getElementById("password").value;

        document.getElementById("login_form").innerHTML +=
            '<br><input class="border-2 border-blue-500 rounded focus-within:outline-none p-1 mb-0.5"' +
            'type="password" id="confirmPassword" name="confirmPassword" size="30" placeholder="Repeat password..."' +
            'onkeyup="checkRepeat()" required><br>' +
            '<button class="border-2 border-blue-500 hover:border-blue-500  rounded focus-within:outline-none hover:bg-blue-300 p-1 px-3 text-2xl mb-0.5"' +
            'type="submit" id="confirm" name="confirm">Confrim Password</button>' +
            '<br><span id="confirm_password_message" class="p-1 mb-0.5 text-red-700"></span>';
        document.getElementById("email").setAttribute("value", email);
        document.getElementById("password").setAttribute("value", password);
    }
    signupPushed = true;
}

function confirm() {
    // If passwords, do not match -> put out msg - passwords do not match
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        document.getElementById("confirm_password_message").innerHTML = "Passwords need to match!";
        return;
    }

    document.getElementById("login_form").action = "/signup";
    document.getElementById("login_form").submit();
}

function checkRepeat() {
    if (document.getElementById('password').value ===
        document.getElementById('confirmPassword').value) {
        document.getElementById('confirmPassword').className =
            "border-2 border-green-700 rounded focus-within:outline-none p-1 mb-0.5";
    } else {
        document.getElementById('confirmPassword').className =
            "border-2 border-red-700 rounded focus-within:outline-none p-1 mb-0.5";
    }
}






