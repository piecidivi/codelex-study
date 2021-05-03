function handleErrors(response) {
    if (!response.ok) {
        throw Error(response.statusText);
    }
    return response;
}

document.getElementById("lookup")
    .addEventListener("submit", (event) => {
        event.preventDefault();
        emptyBuyDefault();
        const search = document.getElementById("search").value.toUpperCase();
        const lookup = "/lookup?search=" + search;

    fetch(lookup)
        .then(handleErrors)
        .then(response => response.json())
        .then(data => {
            if (data[0] === "0") {
                document.getElementById("tableMessage").innerHTML = data[1];
                clearTableMessage();
            }
            if (data[0] === "1") {
                document.getElementById("purchase_table").innerHTML = yesMatch(data[1]);
                document.getElementById("search").value = "";
            }
        })
        .catch(error => {
            console.error("Error: ", error);
        });
    });

function yesMatch(data) {
    let matchTable = '<table id="purchase_table_content" class="table-fixed text-center">';
    matchTable += '<thead class="bg-green-500"><tr><th class="border-2 border-blue-700 border-collapse py-2 px-5">Symbol</th>';
    matchTable += '<th class="border-2 border-blue-700 border-collapse py-2 px-5">Share Price</th>';
    matchTable += '<th class="border-2 border-blue-700 border-collapse py-2 px-5">Amount</th>';
    matchTable += '<th class="border-2 border-blue-700 border-collapse py-2 px-5">Total</th>';
    matchTable += '<th class="border-2 border-blue-700 border-collapse py-2 px-5"></th></tr></thead>';

    matchTable += '<tbody id="purchase_table_body" class="bg-blue-200">';
    matchTable += '<tr><td id="buySymbol" class="border-2 border-blue-700 border-collapse py-2 px-5">' + data.symbol + '</td>';
    matchTable += '<td id="buyQuote" class="border-2 border-blue-700 border-collapse py-2 px-5">' + formatTwoDecimals(data.quote / 100) + '</td>';
    matchTable += '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' +
        '<input class="focus-within:outline-none" id="buyInput" onInput="total()" type="text" placeholder="Enter number..." pattern="[0-9]+" required></td>';
    matchTable += '<td id="buyOutput" class="border-2 border-blue-700 border-collapse py-2 px-5 w-28">' +
        formatTwoDecimals(0) + '</td>';
    matchTable += '<td class="border-2 border-blue-700 border-collapse py-2 px-5 hover:bg-red-300">' +
        '<button class="focus-within:outline-none" id="buyShare" type="submit" name="buy" onClick="buyShare()">BUY</button></td></tr></tbody>';
    return matchTable;
}

function buyShare() {
    const amount = parseInt(document.getElementById("buyInput").value);
    if (isNaN(amount)) {
        document.getElementById("tableMessage").innerHTML = "Invalid amount provided. Better luck next time.";
        clearTableMessage();
        return;
    }
    const symbol = document.getElementById("buySymbol").innerHTML;
    const price = parseFloat(document.getElementById("buyQuote").innerHTML);
    const bankrollId = parseInt(document.getElementById("bankroll_id").innerHTML);
    const buyShare = "/buyShare?bankrollId=" + bankrollId + "&price=" + price + "&amount=" + amount + "&symbol=" + symbol;

    fetch(buyShare)
        .then(handleErrors)
        .then(response => response.json())
        .then(data => {
            if (data[0] === "0") {
                document.getElementById("tableMessage").innerHTML = data[1];
                emptyBuyDefault();
                clearTableMessage();
            }
            if (data[0] === "1") {
                document.getElementById("stock_table_body").innerHTML = refreshStock(data[1]);
                updateBankroll(data[2]);
                emptyBuyDefault();
            }
        })
        .catch(error => {
            console.error("Error: ", error);
        });
}

function sellShare(id) {
    const quoteElem = "quote" + id;
    const price = parseFloat(document.getElementById(quoteElem).innerHTML);
    const bankrollId = parseInt(document.getElementById("bankroll_id").innerHTML);
    const sellShare = "/sellShare?bankrollId=" + bankrollId + "&shareId=" + id + "&price=" + price;

    fetch(sellShare)
        .then(handleErrors)
        .then(response => response.json())
        .then(data => {
            if (data[0] === "0") {
                document.getElementById("tableMessage").innerHTML = data[1];
                clearTableMessage();
            }
            if (data[0] === "1") {
                document.getElementById("stock_table_body").innerHTML = refreshStock(data[1]);
                updateBankroll(data[2]);
            }
        })
        .catch(error => {
            console.error("Error: ", error);
        });
}

setInterval(function () {
    fetch("/refresh")
        .then(handleErrors)
        .then(response => response.json())
        .then(data => {
            if (data[0] === "1") {
                document.getElementById("stock_table_body").innerHTML = refreshStock(data[1]);
                updateBankroll(data[2]);
                console.log("Refresh Complete.");
            }
        })
        .catch(error => {
            console.error("Error: ", error);
        });
}, 5000);

function updateBankroll(bankroll) {
    document.getElementById("bankroll_balance").innerHTML = formatTwoDecimals(bankroll.bankroll / 100);
}

function refreshStock(stock) {
    let newInfo = '';
    Object.values(stock).forEach(share => {
        newInfo += loadNewShare(share);
    });
    return newInfo;
}

function loadNewShare(share) {
    let newShare = '<tr><td class="border-2 border-blue-700 border-collapse py-2 px-5">' + share.symbol + '</td>';
    newShare += '<td id="amount' + share.id + '" class="border-2 border-blue-700 border-collapse py-2 px-5">' +
        share.amount + '</td>';
    newShare += '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' + share.purchaseDate + '</td>';
    newShare += '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' + share.sellDate + '</td>';
    newShare += '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' +
        formatTwoDecimals(share.priceOne / 100) + '</td>';
    newShare += '<td class="border-2 border-blue-700 border-collapse py-2 px-5">' +
        formatTwoDecimals(share.priceTotal / 100) + '</td>';
    newShare += '<td id="quote' + share.id + '" class="border-2 bg-' + share.profitState + '-400 border-blue-700 border-collapse py-2 px-5">' +
        formatTwoDecimals(share.quote / 100) + '</td>';
    newShare += '<td id="project' + share.id + '" class="border-2 bg-' + share.profitState + '-400 border-blue-700 border-collapse py-2 px-5">' +
        formatTwoDecimals(share.project / 100) + '</td>';

    if (share.status === "open") {
        newShare += '<td class="border-2 border-blue-700 border-collapse py-2 px-5 hover:bg-red-300">' +
            '<button class="focus-within:outline-none" type="submit" name="sell" onclick="sellShare(' + share.id + ')">SELL</button></td>';
    }

    if (share.status === "closed") {
        newShare += '<td class="border-2 border-blue-700 border-collapse text-gray-400 py-2 px-5">SOLD</td>';
    }

    newShare += '</tr>';
    return newShare;
}

function total() {
    const bankroll = parseFloat(document.getElementById("bankroll_balance").innerHTML);
    const input = parseInt(document.getElementById("buyInput").value);
    const quote = parseFloat(document.getElementById("buyQuote").innerHTML);
    let output = 0;
    if (! isNaN(input) && input >= 0) {
        output = quote * input;
        output > bankroll ? disableElem("buyShare") : enableElem("buyShare");
    }
    document.getElementById("buyOutput").innerHTML = formatTwoDecimals(output);
}

function formatTwoDecimals(number) {
    return (Math.round(number * 100) / 100).toFixed(2);
}

function disableElem(elem) {
    document.getElementById(elem).disabled = true;
    document.getElementById(elem).style.color = "red";
}

function enableElem(elem) {
    document.getElementById(elem).disabled = false;
    document.getElementById(elem).style.color = "black";
}

function emptyBuyDefault() {
    document.getElementById("purchase_table").innerHTML =
        '<div>&nbsp;</div>' +
        '<div>&nbsp;</div>' +
        '<div>&nbsp;</div>';
}

function clearTableMessage() {
    function message() {
        document.getElementById("tableMessage").innerHTML = "&nbsp;";
    }
    setTimeout(message, 5000);
}