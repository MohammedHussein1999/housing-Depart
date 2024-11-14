@extends('layouts.app')

@section('content')
    <script src="https://cdn.jsdelivr.net/gh/linways/table-to-excel@v1.0.4/dist/tableToExcel.js"></script>
    <div class="EmployeeData dashboard">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12 cardreasersh">
                    <div class="card shadow mb-4 content_building">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 text-right">
                            <h6 class="m-0 font-weight-bold">تقرير شامل</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="content_building">
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="regions">المنطقة</label>
                                        <select class="form-control form-control-md fares" id="regions"
                                            onchange="updateCitiesReports()" dir="rtl">
                                            <option selected disabled> اختر المنطقه</option>
                                            <option value="0">الكل</option>
                                            <option value="1">منطقة الرياض</option>
                                            <option value="2">منطقة مكة المكرمة</option>
                                            <option value="3">منطقة المدينة المنورة</option>
                                            <option value="4">منطقة القصيم</option>
                                            <option value="5">منطقة الشرقية</option>
                                            <option value="6">منطقة عسير</option>
                                            <option value="8">منطقة تبوك</option>
                                            <option value="9">منطقة حائل</option>
                                            <option value="10">منطقة الحدود الشمالية</option>
                                            <option value="11">منطقة جازان</option>
                                            <option value="12">منطقة نجران</option>
                                            <option value="13">منطقة الباحة</option>
                                            <option value="14">منطقة الجوف</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12 col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="cities">المدينة</label>
                                        <select class="form-control form-control-md fares" id="cities"
                                            onchange="updateCollections()" dir="rtl">
                                            <option selected disabled> اختر المدينه</option>
                                            <option value="0">الكل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="CollectionSelect">المجمع السكني</label>
                                        <select class="form-control form-control-md fares" id="CollectionSelect"
                                            dir="rtl">
                                            <option selected disabled> اختر المجمع السكني </option>
                                            <option value="0">الكل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1">جنسيه العامل</label>
                                        <select class="form-control selectNational form-control-md fares" dir="rtl">
                                            <option value="0">الكل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <label for="exampleFormControlSelect1">المشروع الحالي</label>
                                        <select class="form-control form-control-md selectprojects fares" dir="rtl">
                                            <option value="0">الكل</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-lg-12">
                                    <div class="row">
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">الفتره الي</label>
                                                    <input type="date" id="selectDateFrom" class="form-control"
                                                        dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">الفتره من</label>
                                                    <input type="date" id="selectDateTO" class="form-control"
                                                        dir="rtl" />
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-center mt-2 mb-3">
                                    <button type="button" class="btn btnResult  btn-save btn-success"
                                        onclick="ShowResult()">
                                        ارسال
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 ">
                    <div class="card cardResult shadow mb-4 content_building">
                        <div class="card-header py-3 text-right">
                            <h6 class="m-0 font-weight-bold">نتائج التقرير</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="content_building">
                                <div class="col-lg-12 d-flex justify-content-center mt-2 mb-3">
                                    <div class="row w-100" dir="rtl">
                                        <div class="col-lg-12 btns text-center">
                                            <button type="button" class="btn btn-print  btn-success display-3 mt-1 mr-2"
                                                onclick="printDiv('printDiv')">
                                                طباعه التقرير
                                            </button>
                                            <button type="button" class="btn   btn-primary display-3 mt-1" id="btnExport"
                                                data-toggle="modal" data-target="#">
                                                استخراج التقرير
                                            </button>
                                        </div>
                                        <div class="col-lg-12 mt-5" id="printDiv" style="overflow: auto;">
                                            <table id="tableReport" class="table globalTable table-striped text-center"
                                                dir="rtl" style=" border :1px solid #c8c8c8">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th class="text-center">الاسم</th>
                                                        <th class="text-center" style="min-width:150px"> الرقم الوظيفي
                                                        </th>
                                                        <th class="text-center">الوظيفه</th>
                                                        <th class="text-center">الجنسيه</th>
                                                        <th class="text-center">المنطقه</th>
                                                        <th class="text-center">المشروع</th>
                                                        <th class="text-center">السكن</th>
                                                        <!-- السكن جواه region -city - collectionName - unitName - appartment - room -->
                                                    </tr>
                                                </thead>
                                                <tbody class="Tbody">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
        // print
        function printDiv(divId) {
            var printContents = document.getElementById(divId).innerHTML;
            var originalContents = document.body.innerHTML;

            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }

        // extract exel

        $(document).ready(function() {
            $("#btnExport").click(function() {
                let table = document.getElementById('tableReport');
                TableToExcel.convert(
                    table, { // html code may contain multiple tables so here we are refering to 1st table tag
                        name: `export.xlsx`, // fileName you could use any name
                        sheet: {
                            name: 'Sheet 1' // sheetName
                        }
                    });
            });
        });


        // select reach

        $(document).ready(function() {
            $('.fares').select2();
        });






        // Selectors
        const selectNational = document.querySelector(".selectNational");
        const selectProjects = document.querySelector(".selectprojects");
        const Tbody = document.querySelector(".Tbody");
        const selectRegion = document.querySelector("#regions");
        const selectCity = document.querySelector("#cities");
        const selectCollection = document.querySelector("#CollectionSelect");
        const selectNationality = document.querySelector(".selectNational");
        const selectProject = document.querySelector(".selectprojects");
        const selectDateTO = document.querySelector("#selectDateTO");
        const selectDateFrom = document.querySelector("#selectDateFrom");

        let collections = @json($coll);

        const arrayResult = @json($data);
        let nationalities = @json($nationality);

        let projects = @json($location);



        // nationalities

        nationalities.forEach((national) => {

            let Newselect = document.createElement("option");
            Newselect.value = national.nationality
            Newselect.textContent = national.nationality
            selectNational.appendChild(Newselect)
        })

        // project

        let selectprojects = document.querySelector(".selectprojects");
        projects.forEach((project) => {

            let Newselect = document.createElement("option");
            Newselect.value = project.location
            Newselect.textContent = project.location
            selectprojects.appendChild(Newselect)
        })


        // city
        function updateCitiesReports() {
            const cities = document.getElementById("cities");
            const regions = document.getElementById("regions");
            const regionsVal = regions.value;

            cities.innerHTML = '<option value="0">الكل</option>';

            if (regionsVal === "0") {
                city.forEach(city => {
                    let newOption = document.createElement("option");
                    newOption.value = city.city_id;
                    newOption.text = city.name_ar;
                    cities.add(newOption);
                });
            } else if (regionsVal) {
                const cityFiltering = city.filter(city => city.region_id == regionsVal);
                cityFiltering.forEach(city => {
                    let newOption = document.createElement("option");
                    newOption.value = city.city_id;
                    newOption.text = city.name_ar;
                    cities.add(newOption);
                });
            }
        }

        // collections

        function updateCollections() {
            const Collection = document.getElementById("CollectionSelect");
            const Citys = document.getElementById("cities");
            const CityVal = Citys.value;

            let CollectionFiltering = [];

            Collection.innerHTML = '<option value="0" selected disabled>الكل</option>';
            if (CityVal === "0") {
                collections.forEach(collect => {
                    let newOption = document.createElement("option");
                    newOption.value = collect.name;
                    newOption.text = collect.name;
                    Collection.add(newOption);
                });
            } else if (CityVal) {
                CollectionFiltering = collections.filter(collect => collect.city == CityVal);
                CollectionFiltering.forEach(collect => {
                    let newOption = document.createElement("option");
                    newOption.value = collect.name;
                    newOption.text = collect.name;
                    Collection.add(newOption);
                });
            }
        }





        // Result fillter

        function ShowResult() {
            let cardResult = document.querySelector(".cardResult");
            cardResult.style.display = "block";

            let regionVal = selectRegion.value;
            let cityVal = selectCity.value;
            let collectionVal = selectCollection.value;
            let nationalityVal = selectNationality.value;
            let projectVal = selectProject.value;
            let dateFromVal = selectDateFrom.value;
            let dateToVal = selectDateTO.value;

            Tbody.innerHTML = "";

            function applyFilters(arrayResult, filters) {
                return arrayResult.filter(item => {
                    for (let key in filters) {
                        if (filters[key] !== "0" && item[key] !== filters[key]) {
                            return false;
                        }
                    }
                    return true;
                });
            }

            var filters = {
                "region": regionVal,
                "cityId": cityVal,
                "collectionName": collectionVal,
                "empNationality": nationalityVal,
                "empLocation": projectVal
            };

            var Filtering = applyFilters(arrayResult, filters);

            if(dateFromVal != '' && dateToVal != ''){
                var filteredData = Filtering.filter(item => {
                    const itemDate = item.date;
                    return itemDate >= dateToVal && itemDate <= dateFromVal;
                });
            }else{
                var filteredData = Filtering
            }

            filteredData.forEach((Result) => {
                appendResultToTable(Result);
            });
        }

        function appendResultToTable(Result) {
            let newTr = document.createElement("tr");

            let tdName = document.createElement("td");
            let tdjopNum = document.createElement("td");
            let tdJop = document.createElement("td");
            let tdNationality = document.createElement("td");
            let tdRagion = document.createElement("td");
            let tdProject = document.createElement("td");
            let tdHousing = document.createElement("td");

            tdName.textContent = Result.empName;
            tdjopNum.textContent = Result.empNum;
            tdJop.textContent = Result.empJob;
            tdNationality.textContent = Result.empNationality;
            tdRagion.textContent = Result.empCity;
            tdProject.textContent = Result.empLocation;
            tdHousing.textContent =
                `المنطقة : ${Result.region} - المدينة : ${Result.cityId} - المجمع : ${Result.collectionName} -
            الوحدة : ${Result.unitName} - الشقة : ${Result.apartmentNum} - الغرفة : ${Result.roomNum}`;

            newTr.value = Result.id;

            newTr.appendChild(tdName);
            newTr.appendChild(tdjopNum);
            newTr.appendChild(tdJop);
            newTr.appendChild(tdNationality);
            newTr.appendChild(tdRagion);
            newTr.appendChild(tdProject);
            newTr.appendChild(tdHousing);

            Tbody.appendChild(newTr);
        }
    </script>
@endsection
