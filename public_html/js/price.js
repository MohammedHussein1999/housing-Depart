

const PriceData = [
    { type: "غرفة", mount: "12", date: "1/10/2003", time: "شهري" },
    { type: "شقة", mount: "13", date: "3/3/2003", time: "ثانوي" },
];

function initializeDataPrice() {
    let tbodyTable = document.querySelector('.tbodyTablePrice');
    let namePrice = document.querySelector(".namePrice")
    let TimePrice = document.querySelector(".TimePrice")
    let datePrice = document.querySelector(".datePrice")
    let selectPrice = document.querySelector(".selectPrice")

    namePrice.innerHTML = "";
    TimePrice.innerHTML = "";
    datePrice.innerHTML = "";
    selectPrice.innerHTML = "";
    tbodyTable.innerHTML = '';

    for (let i = 0; i < PriceData.length; i++) {
        createRowAndInputsPrice(i);
    }
}

function displayDataPrice() {
    let textArea = document.getElementById('textAreaPrice');
    textArea.value = JSON.stringify(PriceData, null, 2);
}

function createRowAndInputsPrice(index) {
    let tbodyTable = document.querySelector('.tbodyTablePrice');
    let namePrice = document.querySelector(".namePrice")
    let TimePrice = document.querySelector(".TimePrice")
    let datePrice = document.querySelector(".datePrice")
    let selectPrice = document.querySelector(".selectPrice")

    // Create input field for 'namePrice'
    let namePriceInput = document.createElement("input");
    namePriceInput.setAttribute("type", "text");
    namePriceInput.classList.add("form-control");
    namePriceInput.classList.add("text-center");
    namePriceInput.classList.add("mb-2");
    namePriceInput.value = PriceData[index].type;
    namePriceInput.id = `namePriceInput${index}`;

    // Create input field for 'TimePrice'
    let TimePriceInput = document.createElement("input");
    TimePriceInput.setAttribute("type", "text");
    TimePriceInput.classList.add("form-control");
    TimePriceInput.classList.add("text-center");
    TimePriceInput.classList.add("mb-2");
    TimePriceInput.value = PriceData[index].mount;
    TimePriceInput.id = `TimePriceInput${index}`;

    // Create input field for 'datePrice'
    let datePriceInput = document.createElement("input");
    datePriceInput.setAttribute("type", "date");
    datePriceInput.classList.add("form-control");
    datePriceInput.classList.add("text-center");
    datePriceInput.classList.add("mb-2");
    datePriceInput.value = PriceData[index].date;
    datePriceInput.id = `datePriceInput${index}`;

    // Create input field for 'selectPrice'
    let selectPriceInput = document.createElement("select");
    selectPriceInput.classList.add("form-control");
    selectPriceInput.classList.add("text-center");
    selectPriceInput.classList.add("mb-2");
    let option1 = document.createElement("option");
    option1.value = "شهري";
    option1.text = "شهري";
    let option2 = document.createElement("option");
    option2.value = "ثانوي";
    option2.text = "ثانوي";
    selectPriceInput.appendChild(option1);
    selectPriceInput.appendChild(option2);
    selectPriceInput.value = PriceData[index].time;
    selectPriceInput.id = `selectPriceInput${index}`;

    // Create trash icon for removing the row
    let trashIcon = document.createElement("i");
    trashIcon.classList.add("fas", "fa-trash-alt", "remove-icon", "text-center");
    trashIcon.style.cursor = "pointer";
    trashIcon.addEventListener("click", function () {
        removeRowPrice(index);
    });

    // Append inputs and trash icon to the inputFields div
    namePrice.appendChild(namePriceInput);
    TimePrice.appendChild(TimePriceInput);
    datePrice.appendChild(datePriceInput);
    selectPrice.appendChild(selectPriceInput);
    namePrice.appendChild(trashIcon);

    // Create table row
    let tr = document.createElement('tr');

    // Create table cells for 'type', 'mount', 'date', and 'time'
    let nameTd = document.createElement('td');
    nameTd.innerHTML = PriceData[index].type;

    let TimeTd = document.createElement('td');
    TimeTd.innerHTML = PriceData[index].mount;

    let dateTd = document.createElement('td');
    dateTd.innerHTML = PriceData[index].date;

    let selectTd = document.createElement('td');
    selectTd.innerHTML = PriceData[index].time;

    // Create table cell for 'operations'
    let operationsTd = document.createElement('td');
    operationsTd.appendChild(trashIcon);

    // Append table cells to the table row
    tr.appendChild(nameTd);
    tr.appendChild(TimeTd);
    tr.appendChild(dateTd);
    tr.appendChild(selectTd);
    tr.appendChild(operationsTd);

    // Append table row to the table
    tbodyTable.appendChild(tr);
}

function removeRowPrice(index) {
    PriceData.splice(index, 1);
    initializeDataPrice();
    displayDataPrice();
}

document.querySelector('.save-price').addEventListener('click', function () {
    for (let i = 0; i < PriceData.length; i++) {
        PriceData[i].type = document.getElementById(`namePriceInput${i}`).value;
        PriceData[i].mount = document.getElementById(`TimePriceInput${i}`).value;
        PriceData[i].date = document.getElementById(`datePriceInput${i}`).value;
        PriceData[i].time = document.getElementById(`selectPriceInput${i}`).value;
    }

    initializeDataPrice();
    displayDataPrice();
});

document.querySelector('.add-Price').addEventListener('click', function () {
    PriceData.push({ type: "", mount: "", date: "", time: "" });
    createRowAndInputsPrice(PriceData.length - 1);
});

// Initial setup
initializeDataPrice();
displayDataPrice();

