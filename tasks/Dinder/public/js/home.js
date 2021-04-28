function handleErrors(response) {
    if (!response.ok) {
        throw Error(response.statusText);
    }
    return response;
}

function sendLike(selection) {
    const formData = new FormData();
    formData.append("option", selection);

    fetch("/like", {
        method: "POST",
        body: formData
    })
        .then(handleErrors)
        .then(response => response.json())
        .then(data => {
            document.getElementById("controlMessage").innerHTML = loadData(data);
        })
        .catch(error => {
            console.error("Error: ", error);
        })

}

function loadData(data) {
    let innerControl = "";
    switch (data["controlMessage"]) {
        case "NOCHECK":
            innerControl = noCheck();
            break;
        case "SETPROFILE":
            innerControl = setProfile();
            break;
        default:
            innerControl = showPicture(data["checkUser"], data["history"]);
    }
    return innerControl;
}

function noCheck() {
    return '<section class="block"><section class="flex justify-center mb-5">' +
        '<p class="block text-center text-2xl mb-5">No more people left to check.<br />' +
        'Wait for others to join,<br />or You can RESET and start all over again!</p></section>' +
        '<section class="flex justify-center mb-5">' +
        '<a href="/reset" class="border-2 border-blue-700 border-opacity-0 hover:border-blue-300' +
        ' rounded px-24 py-2 text-green-900 text-2xl no-underline hover:bg-green-600 hover:text-white">Reset</a></section></section>';
}

function setProfile() {
    return '<section class="block"><section class="flex justify-center mb-5">' +
        '<p class="block text-center text-2xl mb-5">Please add name and picture to Your profile to meet other people.</p></section>' +
        '<section class="flex justify-center mb-5">' +
        '<a href="/profile" class="border-2 border-blue-700 border-opacity-0 hover:border-blue-300' +
        ' rounded px-24 py-2 text-green-900 text-2xl no-underline hover:bg-green-600 hover:text-white">Update Profile</a><section></section>';
}

function showPicture(checkUser, history) {
    let element = '<section class="inline-block rounded"><section id="rate_picture" class="block">' +
        '<label class="flex justify-center bg-blue-400 text-2xl rounded" for="check_image">' + checkUser.name + '</label>' +
        '<section class="h-96">' +
        '<img class="h-full max-h-96 rounded" id="check_image" src="' + checkUser.imagePath + '" alt="' + checkUser.originalImagePath + '">' +
        '</section><section class="grid grid-cols-2">' +
        '<button class="border-2 border-blue-700 border-opacity-0 hover:border-green-900 hover:bg-green-600 rounded text-green-900' +
        ' text-2xl p-1 hover:text-white" type="button" id="yes" name="yes" onclick="sendLike(' + "'yes'" + ')">like</button>' +
        '<button class="border-2 border-blue-700 border-opacity-0 hover:border-red-900 hover:bg-red-700 rounded text-red-700' +
        ' text-2xl p-1 hover:text-white" type="button" id="no" name="no" onclick="sendLike(' + "'no'" + ')">dislike</button></section></section></section>';

    if (history.length > 0) {
        element += addHistory(history);
    } else {
        element += '<section class="inline-block rounded"><p class="w-64"></p></section>' +
            '<section class="inline-block rounded"><p class="w-64"></p></section>';
    }

    element += '</section>';
    return element;
}

function addHistory(history) {
    let table = '<section class="inline-block rounded"><p class="w-64"></p></section><section class="inline-block rounded">' +
        '<table id="history" class="table-fixed text-center"><thead class="bg-green-500">' +
        '<tr><th class="border-2 border-blue-700 border-collapse py-2 px-5">Name</th>' +
        '<th class="border-2 border-blue-700 border-collapse py-2 px-5">Like</th>' +
        '<th class="border-2 border-blue-700 border-collapse py-2 px-5">Date</th></tr></thead>' +
        '<tbody id="history_body" class="bg-blue-200">';

    Object.values(history).forEach(record => {
        table += '<tr><td class="border-2 border-blue-700 border-collapse py-2 px-5">' + record.checkedName + '</td>' +
            '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' + record.liked + '</td>' +
            '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' + record.created + '</td></tr>'
    });

    table += '</tbody></table></section>';
    return table;
}

