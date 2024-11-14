



$(document).ready(function () {





    // show / hiden Report

    $(".ShowReport").on("click", function () {
        $(".ShowReport").css("display", "none");
        $(".hideReport").css("display", "block");
        $(".dropdown_Report").css("display", "block");
    })
    $(".hideReport").on("click", function () {
        $(".hideReport").css("display", "none");
        $(".ShowReport").css("display", "block");
        $(".dropdown_Report").css("display", "none");
    })




    // tap in sitting
    $(".list-group .list-group-item").on("click", function () {
        $(this).addClass("active").siblings('.list-group-item').removeClass("active");

        var index = $(this).index();
        $(".tab-pane").removeClass("active").eq(index).addClass("active");
    });





});

// JavaScript to toggle the responsive aside bar
const aside_Toggle = document.querySelector('.navbar-toggle-board');
const aside = document.querySelector('.aside_bar');
aside_Toggle.addEventListener('click', function() {
  aside.classList.toggle('active');
});
document.addEventListener("click" , function(event){
  if(!aside.contains(event.target) && !aside_Toggle.contains(event.target)){
    aside.classList.remove('active');
  }
})








// حفظ المكان في localStorage
function savePlacesToLocalStorage(placesData) {
    localStorage.setItem("Places", JSON.stringify(placesData));
}
// تحميل المكان من localStorage
function loadPlaceToLocalStorage() {
    var placesData = JSON.parse(localStorage.getItem("Places")) || [];
    if (placesData.length > 0) {
        $(".bodyOfplace").html("");
        placesData.forEach(function (placeData) {
            var newPlace = '<div class="row parentBodyPlace d-flex align-items-baseline">' +
                '<div class="col-lg-2 text-center">' +
                '<i class="fa-solid fa-trash-can remove-attech text-center"></i>' +
                '</div>' +
                '<div class="col-md-6 col-10 ">' +
                '<div class="form-group text-right">' +
                '<input type="text" class="form-control namePlace" value="' + placeData.nameValue + '" dir="rtl">' +
                '</div>' +
                '</div>' +
                '<div class="col-md-6 col-10 ">' +
                '  <div class="form-group text-right">' +
                ' <input type="text" class="form-control namePlace" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="النوع" dir="rtl">' +
                '</div>' +
                ' </div> ' +
                '</div>' +
                $(".bodyOfplace").append(newPlace);
        });
    }
}



function updateLocalStorage() {
    var placesData = [];

    $(".bodyOfplace .parentBodyPlace").each(function () {
        var $nameValue = $(this).find(".namePlace").val();
        var placeData = {
            nameValue: $nameValue
        };
        placesData.push(placeData);
    });

    savePlacesToLocalStorage(placesData);
}


// // JavaScript to toggle the responsive aside bar
// const aside_Toggle = document.querySelector('.navbar-toggle-board');
// const aside = document.querySelector('.aside_bar');

// aside_Toggle.addEventListener('click', function () {
//     aside.classList.toggle('active');
// });





// مرفق المجمعات السكنيه
document.addEventListener('DOMContentLoaded', function () {
    let PlacesOne = () => {
        const bodyOfplaceOne = document.querySelector(".bodyOfplaceOne");
        const rowTemplate = `
      <div class="row parentBodyPlace d-flex align-items-baseline">
        <div class="col-md-1 col-2 text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-lg-5 col-5">
          <div class="form-group text-right">
            <input type="number" class="form-control namePlace" aria-describedby="emailHelp" placeholder="العدد" dir="rtl">
          </div>
        </div>
        <div class="col-lg-6 col-5">
          <div class="form-group text-right">
            <input type="text" class="form-control typePlace" aria-describedby="emailHelp" placeholder="النوع" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfplaceOne.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyPlace");
                parentRow.remove();
            });
        });
    };

    let SaveVal = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfplaceOne .parentBodyPlace");
        const placesData = [];

        rows.forEach(row => {
            const nameInput = row.querySelector("input[type='number']");
            const typeInput = row.querySelector("input[type='text']");

            // Check if the input elements are found before accessing their values
            if (nameInput && typeInput) {
                const placeData = {
                    nameValue: nameInput.value,
                    typeValue: typeInput.value
                };

                placesData.push(placeData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaTwo");

        if (textVal) {
            textVal.textContent = JSON.stringify(placesData);
        } else {
            console.error('Element with ID "TextareaTwo" not found.');
        }
    };

    const addBtnOne = document.querySelector(".choosePlaceOne");
    const savePlaces = document.querySelector(".savePlaces");

    addBtnOne.addEventListener("click", PlacesOne);
    savePlaces.addEventListener("click", SaveVal);
});


// مرفق  الوحدات

document.addEventListener('DOMContentLoaded', function () {
    let PlacesTwo = () => {
        const bodyOfplaceOne = document.querySelector(".bodyOfplaceTwo");
        const rowTemplate = `
      <div class="row parentBodyPlace d-flex align-items-baseline">
        <div class="col-md-1 col-2 text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-lg-5 col-5">
          <div class="form-group text-right">
            <input type="number" class="form-control namePlace" aria-describedby="emailHelp" placeholder="العدد" dir="rtl">
          </div>
        </div>
        <div class="col-lg-6 col-5">
          <div class="form-group text-right">
            <input type="text" class="form-control typePlace" aria-describedby="emailHelp" placeholder="النوع" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfplaceOne.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyPlace");
                parentRow.remove();
            });
        });
    };

    let SaveValTwo = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfplaceTwo .parentBodyPlace");
        const placesData = [];

        rows.forEach(row => {
            const nameInput = row.querySelector("input[type='number']");
            const typeInput = row.querySelector("input[type='text']");

            // Check if the input elements are found before accessing their values
            if (nameInput && typeInput) {
                const placeData = {
                    nameValue: nameInput.value,
                    typeValue: typeInput.value
                };

                placesData.push(placeData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaOne");

        if (textVal) {
            textVal.textContent = JSON.stringify(placesData);
        } else {
            console.error('Element with ID "TextareaTwo" not found.');
        }
    };

    const addBtnOne = document.querySelector(".choosePlaceTwo");
    const savePlaces = document.querySelector(".savePlacesTwo");

    addBtnOne.addEventListener("click", PlacesTwo);
    savePlaces.addEventListener("click", SaveValTwo);
});





// شقة اشعارات المصروفات
document.addEventListener('DOMContentLoaded', function () {
    let PriceOne = () => {
        const bodyOfPrice = document.querySelector(".bodyOfPrice");
        const rowTemplate = `
      <div class="row parentBodyPrice d-flex align-items-baseline">
        <div class="col-md-1 col-2 text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-md-2 col-2 mb-3">
          <div class="form-group text-right">
            <select class="form-control selectPrice form-control-md" dir="rtl">
              <option value="مرة واحدة">مرة واحدة</option>
              <option value="ثانوي">ثانوي</option>
              <option value="شهري">شهري</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-2">
          <div class="form-group text-right">
            <input type="date" class="form-control datePrice" aria-describedby="dateInputHelp" placeholder="الميعاد" dir="rtl">
          </div>
        </div>
        <div class="col-md-2 col-2">
          <div class="form-group text-right">
            <input type="text" class="form-control priceInput" aria-describedby="priceInputHelp" placeholder="القيمة" dir="rtl">
          </div>
        </div>
        <div class="col-md-4 col-4">
          <div class="form-group text-right">
            <input type="text" class="form-control namePrice" aria-describedby="nameInputHelp" placeholder="الاسم" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfPrice.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyPrice");
                parentRow.remove();
            });
        });
    };

    let SaveValThree = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfPrice .parentBodyPrice");
        const placesData = [];

        rows.forEach(row => {
            const nameInput = row.querySelector(".namePrice");
            const typeInput = row.querySelector(".selectPrice");
            const dateInput = row.querySelector(".datePrice");
            const priceInput = row.querySelector(".priceInput");

            // Check if the input elements are found before accessing their values
            if (nameInput && typeInput && dateInput && priceInput) {
                const placeData = {
                    nameValue: nameInput.value,
                    typeValue: typeInput.value,
                    dateValue: dateInput.value,
                    priceValue: priceInput.value
                };

                placesData.push(placeData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaPriceOne");

        if (textVal) {
            textVal.textContent = JSON.stringify(placesData);
        } else {
            console.error('Element with ID "TextareaPriceOne" not found.');
        }
    };

    const addBtnOne = document.querySelector(".addPrice");
    const savePlaces = document.querySelector(".saveprice");

    addBtnOne.addEventListener("click", PriceOne);
    savePlaces.addEventListener("click", SaveValThree);
});



// غرفة اشعارات المصروفات
document.addEventListener('DOMContentLoaded', function () {
    let PriceTwo = () => {
        const bodyOfPriceTwo = document.querySelector(".bodyOfPriceTwo");
        const rowTemplate = `
      <div class="row parentBodyPriceTwo d-flex align-items-baseline">
        <div class="col-md-1 col-2 text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-md-2 col-2 mb-3">
          <div class="form-group text-right">
            <select class="form-control selectPrice form-control-md" dir="rtl">
            <option value="مرة واحدة">مرة واحدة</option>
            <option value="ثانوي">ثانوي</option>
            <option value="شهري">شهري</option>
            </select>
          </div>
        </div>
        <div class="col-md-3 col-2">
          <div class="form-group text-right">
            <input type="date" class="form-control datePrice" id="dateInputTwo" aria-describedby="dateInputHelpTwo" placeholder="الميعاد" dir="rtl">
          </div>
        </div>
        <div class="col-md-2 col-2">
          <div class="form-group text-right">
            <input type="text" class="form-control priceInput" id="priceInputTwo" aria-describedby="priceInputHelpTwo" placeholder="القيمة" dir="rtl">
          </div>
        </div>
        <div class="col-md-4 col-4">
          <div class="form-group text-right">
            <input type="text" class="form-control namePrice" id="nameInputTwo" aria-describedby="nameInputHelpTwo" placeholder="الاسم" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfPriceTwo.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyPriceTwo");
                parentRow.remove();
            });
        });
    };

    let SaveValFour = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfPriceTwo .parentBodyPriceTwo");
        const placesData = [];

        rows.forEach(row => {
            const nameInput = row.querySelector(".namePrice");
            const typeInput = row.querySelector(".priceInput");
            const selectInput = row.querySelector(".selectPrice");
            const dateInput = row.querySelector(".datePrice");


            // Check if the input elements are found before accessing their values
            if (nameInput && typeInput && selectInput && dateInput) {
                const placeData = {
                    nameValue: nameInput.value,
                    typeValue: typeInput.value,
                    selectValue: selectInput.value,
                    dateValue: dateInput.value
                };

                placesData.push(placeData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaPriceTwo");

        if (textVal) {
            textVal.textContent = JSON.stringify(placesData);
        } else {
            console.error('Element with ID "TextareaPriceTwo" not found.');
        }
    };

    const addBtnTwo = document.querySelector(".addPriceTwo");
    const savePlacesTwo = document.querySelector(".savepriceTwo");

    addBtnTwo.addEventListener("click", PriceTwo);
    savePlacesTwo.addEventListener("click", SaveValFour);
});




// اخري  شقه



document.addEventListener('DOMContentLoaded', function () {
    let OtherOne = () => {
        const bodyOfOtherTwo = document.querySelector(".bodyOfOtherOne");
        const rowTemplate = `
      <div class="row parentBodyOtherOne d-flex align-items-baseline">
        <div class="col-md-1 col-2  text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-md-11 col-2">
          <div class="form-group text-right">
            <input type="text" class="form-control OtherInput" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="المرافق المنزلية (الحمامات والمطابخ وما إلى ذلك)" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfOtherTwo.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyOtherOne");
                parentRow.remove();
            });
        });
    };

    let SaveValFive = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfOtherOne .parentBodyOtherOne");
        const OthersData = [];

        rows.forEach(row => {
            const OtherInput = row.querySelector(".OtherInput");

            // Check if the input elements are found before accessing their values
            if (OtherInput) {
                const OtherData = {
                    OtherValue: OtherInput.value
                };

                OthersData.push(OtherData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaOtherOne");

        if (textVal) {
            textVal.textContent = JSON.stringify(OthersData);
        } else {
            console.error('Element with ID "TextareaOtheOne" not found.');
        }
    };

    const addBtnTwo = document.querySelector(".addOtherOne");
    const saveOtherTwo = document.querySelector(".saveOtherOne");

    addBtnTwo.addEventListener("click", OtherOne);
    saveOtherTwo.addEventListener("click", SaveValFive);
});



// اخري غرفه
document.addEventListener('DOMContentLoaded', function () {
    let OtherOne = () => {
        const bodyOfOtherTwo = document.querySelector(".bodyOfOtherTwo");
        const rowTemplate = `
      <div class="row parentBodyOtherTwo d-flex align-items-baseline">
        <div class="col-md-1 col-2  text-center">
          <i class="fa-solid fa-trash-can remove-attech text-center"></i>
        </div>
        <div class="col-md-11 col-2">
          <div class="form-group text-right">
            <input type="text" class="form-control OtherInput" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="المرافق المنزلية (الحمامات والمطابخ وما إلى ذلك)" dir="rtl">
          </div>
        </div>
      </div>
    `;

        bodyOfOtherTwo.insertAdjacentHTML('beforeend', rowTemplate);

        // Add an event listener to the trash can icon for each new row
        const removeIcons = document.querySelectorAll(".remove-attech");
        removeIcons.forEach(icon => {
            icon.addEventListener("click", function () {
                const parentRow = icon.closest(".parentBodyOtherTwo");
                parentRow.remove();
            });
        });
    };

    let SaveValFive = (e) => {
        e.preventDefault();

        const rows = document.querySelectorAll(".bodyOfOtherTwo .parentBodyOtherTwo");
        const OthersData = [];

        rows.forEach(row => {
            const OtherInput = row.querySelector(".OtherInput");

            // Check if the input elements are found before accessing their values
            if (OtherInput) {
                const OtherData = {
                    OtherValue: OtherInput.value
                };

                OthersData.push(OtherData);
            } else {
                console.error('Input element not found in the row.');
            }
        });

        // Display the object in a textarea
        const textVal = document.querySelector("#TextareaOtherTwo");

        if (textVal) {
            textVal.textContent = JSON.stringify(OthersData);
        } else {
            console.error('Element with ID "TextareaOtherTwo" not found.');
        }
    };

    const addBtnTwo = document.querySelector(".addOtherTwo");
    const saveOtherTwo = document.querySelector(".saveOtherTwo");

    addBtnTwo.addEventListener("click", OtherOne);
    saveOtherTwo.addEventListener("click", SaveValFive);
});



// عرض التسكين

// filter search








// data table

new DataTable('#tableOne', {
    responsive: true
})

new DataTable('#tableTwo', {
    responsive: true
})
new DataTable('#tableThree', {
    responsive: true
})
new DataTable('#tableFour', {
    responsive: true
})
new DataTable('#tableSitting-One', {
    responsive: true
})
new DataTable('#tableSitting-Two', {
    responsive: true
})
new DataTable('#tableSitting-Four', {
    responsive: true
})
new DataTable('#tableSitting-Five', {
    responsive: true
})
new DataTable('#tableSitting-Six', {
    responsive: true
})








