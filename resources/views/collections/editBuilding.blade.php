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
                        تعديل سجل وحده السكنيه
                    </div>
                    <div class="card-body">
                        <div class="content_history">
                            <form action="{{ route('building.update', $building->id) }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المدينة : <span
                                                        id="currentCity"></span> </label>
                                                <select onchange="updateColl()" name="city"
                                                    class="form-control form-control-md fares" id="cities"
                                                    dir="rtl">
                                                    <option value="" selected disabled>أختر لتعديل المدينة</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المنطقة : <span
                                                        id="currentRegion"></span></label>
                                                <select name="region" class="form-control form-control-md fares"
                                                    id="regions" onchange="updateCities()" dir="rtl">
                                                    <option disabled selected>اختر لتعديل المنطقة</option>
                                                    <option value="1">منطقة الرياض </option>
                                                    <option value="2">منطقة مكة المكرمة </option>
                                                    <option value="3">منطقة المدينة المنورة </option>
                                                    <option value="4">منطقة القصيم</option>
                                                    <option value="5">منطقة الشرقية</option>
                                                    <option value="6">منطقة عسير</option>
                                                    <option value="8">منطقة تبوك</option>
                                                    <option value="9">منطقة حائل</option>
                                                    <option value="10">منطقة الحدود الشماليه</option>
                                                    <option value="11">منطقة جازان</option>
                                                    <option value="12">منطقة نجران</option>
                                                    <option value="13">منطقة الباحة</option>
                                                    <option value="14">منطقة الجوف</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1">المجمع السكني : <span
                                                id="currentcoll"></span></label>
                                        <select name="collectionId" id="selectColl"
                                            class="form-control form-control-md fares" dir="rtl">
                                            <option disabled selected>اختر لتعديل اسم المجمع</option>
                                        </select>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">اسم الوحده السكنيه</label>
                                            <input name="name" value="{{ $building->name }}" type="text"
                                                id="form3Example1" class="form-control" dir="rtl" />
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1 ">نوع الوحدة السكنية </label>
                                        <select name="buildingType" class="form-control TypeHouse form-control-md fares"
                                            dir="rtl">
                                            <option value="{{ $building->buildingType }}" selected>
                                                {{ $building->buildingType }}</option>
                                            @foreach ($type as $item)
                                                <option value="{{ $item->name }}">{{ $item->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-lg-12 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">عدد الطوابق</label>
                                                    <input name="value" value="{{ $building->value }}" type="number"
                                                        id="form3Example1" class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="text-right">تعديل صور المجمع السكني </div>
                                    <div class="input-group mt-3">
                                        <input name="file" type="file" class="form-control" id="customFile">
                                        <button class="btn btn-primary" type="button" data-bs-toggle="modal"
                                            data-bs-target="#uploadModal">اختر صوره</button>
                                    </div>
                                </div>
                                @if ($building->file != null)
                                    <div class="col-md-12 mb-3 mt-3">
                                        <div class="d-grid gap-2">
                                            <a href="{{ route('building.download', $building->id) }}"
                                                class="btn btn-primary p-2" type="button">تحميل صوره السكن</a>
                                        </div>
                                    </div>
                                @endif
                                <div class="col-md-12 mb-4">
                                    <div class="form-check text-right   mb-4">
                                        <label class="form-check-label mr-4" for="flexCheckDefault">
                                            التفعيل
                                        </label>
                                        <input class="form-check-input" name="active" type="checkbox" value="1"
                                            @if ($building->active == 1) checked @endif id="flexCheckDefault">
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3 text-end d-flex justify-content-end align-items-center">
                                    <button type="button" class="btn btn-location btn-primary text-right  mr-2"
                                        data-toggle="modal" data-target="#location">
                                        <i class="fa-solid fa-location-dot mr-2"></i>الموقع
                                    </button>
                                    <button type="button" class="btn btn-location btn-primary" data-toggle="modal"
                                        data-target="#place">
                                        <i class="fa-solid fa-diagram-successor mr-2"></i> المرافق
                                    </button>
                                </div>
                                <div class="col-lg-12 mb-4 mt-4 d-none">
                                    <div class="form-group text-right">
                                        <div class="form-outline">
                                            <textarea id="textArea" class="form-control " rows="5" name="attach"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <table class="table text-center   red-border" id="placesTable" dir="rtl">
                                        <thead class="table-primary">
                                            <tr>
                                                <th scope="col">النوع</th>
                                                <th scope="col">العدد</th>
                                                <th scope="col">الاجرائات</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbodyTable">
                                        </tbody>
                                    </table>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-primary savePlaces ml-4 mr-4"> حفظ
                                        التعديل</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="place" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%; ">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="place">اضافه مرفق</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  place-container" style="max-height: 355px;   overflow-y: scroll;">
                        <form action="" class="FormPlaceOne">
                            <div class="row  parent-row d-flex align-items-baseline">
                                <div class="col-md-1 col-2 remove-icon text-center">

                                </div>
                                <div class="col-lg-6 col-5">
                                    <div class="form-group inputTwo text-right">

                                    </div>
                                </div>
                                <div class="col-lg-5 col-5">
                                    <div class="form-group inputOne text-right">

                                    </div>
                                </div>
                            </div>
                        </form>
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
    <input type="text" class="d-none" value="{{ $building->attach }}" id="asa">
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
        var coll = @json($coll);

        function updateColl() {
            const citiesInBuilding = document.getElementById("cities").value;
            const selectColl = document.getElementById("selectColl");

            // Clear existing options in the cities dropdown
            selectColl.innerHTML = '<option selected disabled>اختر لتعديل اسم المجمع</option>';

            if (citiesInBuilding) {
                const cityFiltering = coll.filter(coll => coll.city == citiesInBuilding);
                cityFiltering.forEach(coll => {
                    let newOption = document.createElement("option");
                    newOption.value = coll.id; // Use name_en or name_ar based on your preference
                    newOption.text = coll.name;
                    selectColl.add(newOption);
                });
            }
        }
        var filterCities = city.filter(city => city.city_id == {{ $building->city }});
        document.getElementById('currentCity').innerHTML = filterCities[0].name_ar;
        var filterRegion = region.filter(region => region.region_id == {{ $building->region }});
        document.getElementById('currentRegion').innerHTML = filterRegion[0].name_ar;
        var filterColl = coll.filter(coll => coll.id == {{ $building->collectionId }});
        document.getElementById('currentcoll').innerHTML = filterColl[0].name;
        $(document).ready(function() {
            $('.fares').select2();
        });
        @if ($building->attach == null)
            const placesData = [];
        @else
            var x = document.getElementById('asa').value;
            z = JSON.parse(x);
            const placesData = z;
        @endif

        function initializeData() {
            let tbodyTable = document.querySelector('.tbodyTable');
            let inputOne = document.querySelector(".inputOne")
            let inputTwo = document.querySelector(".inputTwo")
            inputOne.innerHTML = "";
            inputTwo.innerHTML = "";
            tbodyTable.innerHTML = '';

            for (let i = 0; i < placesData.length; i++) {
                createRowAndInputs(i);
            }
        }

        function displayData() {
            let textArea = document.getElementById('textArea');
            textArea.value = JSON.stringify(placesData);
        }

        function createRowAndInputs(index) {
            let tbodyTable = document.querySelector('.tbodyTable');
            let inputOne = document.querySelector(".inputOne")
            let inputTwo = document.querySelector(".inputTwo")

            // Create input field for 'type'
            let typeInput = document.createElement("input");
            typeInput.setAttribute("type", "text");
            typeInput.classList.add("form-control")
            typeInput.classList.add("text-center")
            typeInput.classList.add("mb-2")
            typeInput.value = placesData[index].nameValue;
            typeInput.id = `typeInput${index}`;

            // Create input field for 'mount'
            let mountInput = document.createElement("input");
            mountInput.setAttribute("type", "text");
            mountInput.classList.add("form-control");
            mountInput.classList.add("text-center")
            mountInput.classList.add("mb-2")
            mountInput.value = placesData[index].typeValue;
            mountInput.id = `mountInput${index}`;

            // Create trash icon for removing the row
            let trashIcon = document.createElement("i");
            trashIcon.classList.add("fas", "fa-trash-alt", "remove-icon", "text-center");
            trashIcon.style.cursor = "pointer";
            trashIcon.addEventListener("click", function() {
                removeRow(index);
            });

            // Append inputs and trash icon to the inputFields div
            inputOne.appendChild(typeInput);
            inputTwo.appendChild(mountInput);

            // Create table row
            let tr = document.createElement('tr');

            // Create table cells for 'type' and 'mount'
            let typeTd = document.createElement('td');
            typeTd.innerHTML = placesData[index].nameValue;

            let mountTd = document.createElement('td');
            mountTd.innerHTML = placesData[index].typeValue;

            // Create table cell for 'operations'
            let operationsTd = document.createElement('td');
            operationsTd.appendChild(trashIcon);

            // Append table cells to the table row
            tr.appendChild(typeTd);
            tr.appendChild(mountTd);
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
                placesData[i].nameValue = document.getElementById(`typeInput${i}`).value;
                placesData[i].typeValue = document.getElementById(`mountInput${i}`).value;
            }

            initializeData();
            displayData();
        });

        document.getElementById('AddData').addEventListener('click', function() {
            placesData.push({
                nameValue: '',
                typeValue: ''
            });
            createRowAndInputs(placesData.length - 1);
        });

        initializeData();
        displayData();
    </script>
@endsection
