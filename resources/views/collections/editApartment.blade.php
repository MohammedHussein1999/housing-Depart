@extends('layouts.app')

@section('content')
    <div class="histiryHouses dashboard">
        <div class="container ">
            <div class="col-lg-12 mt-5 mb-4">
                @if ($errors->any())
                    <div class="alert alert-danger" role="alert" dir="rtl">
                        لقد حدث خطأ
                    </div>
                @endif
                <div class="card">
                    <div class="card-header" dir="rtl">
                        تعديل سجل الشقق
                    </div>
                    <form action="{{ route('apartment.update', $apartment->id) }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="card-body">
                            <div class="row parentBodyPlace d-flex align-items-baseline">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1">المجمع السكني</label>
                                        <select name="collectionId" class="form-control form-control-md fares"
                                            dir="rtl" id="selectCollTwo" onchange="updateBuilding()">
                                            <option disabled selected>اختر لتعديل المجمع السكني</option>
                                            @foreach ($coll as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1">وحدة سكنية</label>
                                        <select name="buildingId" class="form-select fares" dir="rtl"
                                            id="selectBuilding">
                                            <option disabled selected>اختر لتعديل الوحدة السكنية</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">رقم الشقه</label>
                                                    <input type="text" name="apartmentNum"
                                                        value="{{ $apartment->apartmentNum }}" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">رقم الطابق</label>
                                                    <input type="text" name="floorNum" value="{{ $apartment->floorNum }}"
                                                        id="form3Example1" class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">عدد الحمامات</label>
                                                    <input type="number" name="bathroomCount"
                                                        value="{{ $apartment->bathroomCount }}" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">عداد الكهرباء</label>
                                                    <input type="text" value="{{ $apartment->electricity }}"
                                                        name="electricity" id="form3Example1" class="form-control"
                                                        dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">رقم الحساب </label>
                                            <input type="text" value="{{ $apartment->accountNum }}" name="accountNum"
                                                id="form3Example1" class="form-control" dir="rtl" />
                                        </div>
                                    </div>
                                </div>
                                <div
                                    class="col-lg-12 mb-3 d-none text-right d-flex justify-content-end align-items-center mt-4 mb-3 ">
                                    <div class="col-md-6 mb-3 mt-3 text-center">
                                        <button type="button" class="btn btn-location btn-primary mr-2" data-toggle="modal"
                                            data-target="#other">
                                            <i class="fa-solid fa-ellipsis  mr-2"></i> اخري
                                        </button>
                                        <button type="button" class="btn btn-location btn-primary text-right  "
                                            style="font-size: 14px; " data-toggle="modal" data-target="#price">
                                            <i class="fa-solid fa-coins mr-1"></i> الاستحقاقات
                                        </button>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="input-group mt-4 text-right">
                                            <input type="file" name="file" class="form-control" id="customFile">
                                            <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#uploadModal">اختر الملفات</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 mt-3">
                                    @if ($apartment->file != null)
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('apartment.download', $apartment->id) }}"
                                                class="btn btn-primary p-2" type="button">تحميل صوره السكن</a>
                                        </div>
                                    @endif
                                    <div class="col-lg-12 d-none">
                                        <div class="row">
                                            <div class="col-lg-6 mb-4 mt-4">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <textarea id="textAreaPrice" name="attach" class="form-control" rows="5" readonly></textarea>
                                                        <input type="text" id="attachValue" class="d-none"
                                                            value="{{ $apartment->attach }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-6 mb-4 mt-4">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <textarea id="textAreaOther" name="other" class="form-control" rows="5" readonly></textarea>
                                                        <input type="text" id="otherValue" class="d-none"
                                                            value="{{ $apartment->other }}">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-none" dir="rtl">
                                    <div class="row">
                                        <div class="col-lg-6">
                                            <table class="table text-center" id="pricesTable">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">الاسم</th>
                                                        <th scope="col">القيمة</th>
                                                        <th scope="col">التاريخ</th>
                                                        <th scope="col">التوقيت</th>
                                                        <th scope="col">العمليات</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyTablePrice">
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="col-lg-6">
                                            <table class="table text-center  red-border" id="OtherTable" dir="rtl">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">المرافق</th>
                                                        <th scope="col">الاجرائات</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="tbodyTableOther">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer mt-5 mb-4">
                            <button type="submit" class="btn btn-primary savePlaces mr-4 ml-4"> حفظ التعديل</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: 0;">
            <div class="modal-dialog  modal-lg" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="price">اشعارات المصروفات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOFPrice" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodYPrice d-flex align-items-baseline">
                            <div class="col-md-3 namePrice"></div>
                            <div class="col-md-3 TimePrice"></div>
                            <div class="col-md-3 datePrice"></div>
                            <div class="col-md-3 selectPrice"></div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="button" class="btn btn-primary save-price" data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary add-Price">إضافة سعر</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="other" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: 0;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: auto !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="other"> اخري </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOFOther" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodYOther d-flex align-items-baseline">
                            <div class="col-lg-12 col-5">
                                <div class="form-group inputOne text-right">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="button" class="btn btn-primary" id="SaveData" data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary" id="AddData">اضف مرفق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var building = @json($building);

        function updateBuilding() {
            const selectCollTwo = document.getElementById("selectCollTwo").value;
            const selectBuilding = document.getElementById("selectBuilding");

            // Clear existing options in the cities dropdown
            selectBuilding.innerHTML = '<option selected disabled>اختر لتعديل الوحدة السكنية</option>';

            if (selectCollTwo) {
                const cityFiltering = building.filter(building => building.collectionId == selectCollTwo);
                cityFiltering.forEach(building => {
                    let newOption = document.createElement("option");
                    newOption.value = building.id; // Use name_en or name_ar based on your preference
                    newOption.text = building.name;
                    selectBuilding.add(newOption);
                });
            }
        }
        $('document').ready(function() {
            $('.fares').select2();
        })

        @if ($apartment->other == null)
            const placesData = [];
        @else
            var x = document.getElementById('otherValue').value;
            z = JSON.parse(x);
            const placesData = z;
        @endif

        function initializeData() {
            let tbodyTable = document.querySelector('.tbodyTableOther');
            let inputOne = document.querySelector(".inputOne")
            inputOne.innerHTML = "";
            tbodyTable.innerHTML = '';

            for (let i = 0; i < placesData.length; i++) {
                createRowAndInputs(i);
            }
        }

        function displayData() {
            let textArea = document.getElementById('textAreaOther');
            textArea.value = JSON.stringify(placesData);
        }

        function createRowAndInputs(index) {
            let tbodyTable = document.querySelector('.tbodyTableOther');
            let inputOne = document.querySelector(".inputOne")

            // Create input field for 'type'
            let typeInput = document.createElement("input");
            typeInput.setAttribute("type", "text");
            typeInput.classList.add("form-control")
            typeInput.classList.add("text-center")
            typeInput.classList.add("mb-2")
            typeInput.value = placesData[index].OtherValue;
            typeInput.id = `typeInput${index}`;



            // Create trash icon for removing the row
            let trashIcon = document.createElement("i");
            trashIcon.classList.add("fas", "fa-trash-alt", "remove-icon", "text-center");
            trashIcon.style.cursor = "pointer";
            trashIcon.addEventListener("click", function() {
                removeRow(index);
            });

            // Append inputs and trash icon to the inputFields div
            inputOne.appendChild(typeInput);

            // Create table row
            let tr = document.createElement('tr');

            // Create table cells for 'type' and 'mount'
            let typeTd = document.createElement('td');
            typeTd.innerHTML = placesData[index].OtherValue;


            // Create table cell for 'operations'
            let operationsTd = document.createElement('td');
            operationsTd.appendChild(trashIcon);

            // Append table cells to the table row
            tr.appendChild(typeTd);
            tr.appendChild(operationsTd);

            // Append table row to the table
            tbodyTable.appendChild(tr);
        }

        function removeRow(index) {
            placesData.splice(index, 1);
            initializeData();
            displayData();
        }

        document.getElementById('SaveData').addEventListener('click', function() {
            for (let i = 0; i < placesData.length; i++) {
                placesData[i].OtherValue = document.getElementById(`typeInput${i}`).value;
            }

            initializeData();
            displayData();
        });

        document.getElementById('AddData').addEventListener('click', function() {
            placesData.push({
                OtherValue: ''
            });
            createRowAndInputs(placesData.length - 1);
        });

        initializeData();
        displayData();



        // شقق

        @if ($apartment->other == null)
            const PriceData = [];
        @else
            var y = document.getElementById('attachValue').value;
            m = JSON.parse(y);
            const PriceData = m;
        @endif

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
            textArea.value = JSON.stringify(PriceData);
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
            namePriceInput.value = PriceData[index].nameValue;
            namePriceInput.id = `namePriceInput${index}`;

            // Create input field for 'TimePrice'
            let TimePriceInput = document.createElement("input");
            TimePriceInput.setAttribute("type", "text");
            TimePriceInput.classList.add("form-control");
            TimePriceInput.classList.add("text-center");
            TimePriceInput.classList.add("mb-2");
            TimePriceInput.value = PriceData[index].typeValue;
            TimePriceInput.id = `TimePriceInput${index}`;

            // Create input field for 'datePrice'
            let datePriceInput = document.createElement("input");
            datePriceInput.setAttribute("type", "date");
            datePriceInput.classList.add("form-control");
            datePriceInput.classList.add("text-center");
            datePriceInput.classList.add("mb-2");
            datePriceInput.value = PriceData[index].dateValue;
            console.log(PriceData[index].dateValue);
            datePriceInput.id = `datePriceInput${index}`;

            // Create input field for 'selectPrice'
            let selectPriceInput = document.createElement("select");
            selectPriceInput.classList.add("form-control");
            selectPriceInput.classList.add("text-center");
            selectPriceInput.classList.add("mb-2");
            let option1 = document.createElement("option");
            option1.value = "شهرى";
            option1.text = "شهرى";
            let option2 = document.createElement("option");
            option2.value = "ثانوي";
            option2.text = "ثانوي";
            let option3 = document.createElement("option");
            option3.value = "مرة واحدة";
            option3.text = "مرة واحدة";
            selectPriceInput.appendChild(option1);
            selectPriceInput.appendChild(option2);
            selectPriceInput.appendChild(option3);
            selectPriceInput.id = `selectPriceInput${index}`;

            // Create trash icon for removing the row
            let trashIcon = document.createElement("i");
            trashIcon.classList.add("fas", "fa-trash-alt", "remove-icon", "text-center");
            trashIcon.style.cursor = "pointer";
            trashIcon.addEventListener("click", function() {
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
            nameTd.innerHTML = PriceData[index].nameValue;

            let TimeTd = document.createElement('td');
            TimeTd.innerHTML = PriceData[index].typeValue;

            let dateTd = document.createElement('td');
            dateTd.innerHTML = PriceData[index].dateValue;

            let selectTd = document.createElement('td');
            selectTd.innerHTML = PriceData[index].priceValue;

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

        document.querySelector('.save-price').addEventListener('click', function() {
            for (let i = 0; i < PriceData.length; i++) {
                PriceData[i].nameValue = document.getElementById(`namePriceInput${i}`).value;
                PriceData[i].typeValue = document.getElementById(`TimePriceInput${i}`).value;
                PriceData[i].dateValue = document.getElementById(`datePriceInput${i}`).value;
                PriceData[i].priceValue = document.getElementById(`selectPriceInput${i}`).value;
            }

            initializeDataPrice();
            displayDataPrice();
        });

        document.querySelector('.add-Price').addEventListener('click', function() {
            PriceData.push({
                nameValue: "",
                typeValue: "",
                dateValue: "",
                priceValue: ""
            });
            createRowAndInputsPrice(PriceData.length - 1);
        });


        initializeDataPrice();
        displayDataPrice();
    </script>
@endsection
