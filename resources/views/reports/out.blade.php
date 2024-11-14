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
                            <h6 class="m-0 font-weight-bold">تقرير الاخلاء </h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="content_building">
                                <div class="col-md-12 mb-3">
                                    <div class="form-group text-right">
                                        <div class="form-outline">
                                            <label class="form-label" for="form3Example1">الرقم الوظيفي</label>
                                            <input type="number" id="form3Example1" class="form-control selectNumJop"
                                                dir="rtl" placeholder=" ان كنت تريد كل البيانات لا تكتب رقم الموظف" />
                                        </div>
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
                                        onclick="ShowResult()" data-toggle="modal" data-target="#">
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
                                    <div class="row">
                                        <div class="col-lg-12 btns text-center">
                                            <button type="button" class="btn btn-print  btn-success display-3 mt-1 mr-2"
                                                onclick="printDiv('print')">
                                                طباعه التقرير
                                            </button>
                                            <button type="button" class="btn   btn-primary display-3 mt-1" id="btnExport">
                                                استخراج التقرير
                                            </button>
                                        </div>
                                        <div class="col-lg-12 mt-5" id="print">
                                            <table id="tableReport" class="table globalTable table-striped text-center"
                                                dir="rtl" style=" border :1px solid #c8c8c8">
                                                <thead class="text-center">
                                                    <tr>
                                                        <th class="text-center">الاسم</th>
                                                        <th class="text-center"> الرقم الوظيفي </th>
                                                        <th class="text-center">الوظيفه</th>
                                                        <th class="text-center">الجنسيه</th>
                                                        <th class="text-center">المنطقه</th>
                                                        <th class="text-center">المشروع</th>
                                                        <th class="text-center">السكن</th>
                                                        <th class="text-center">تاريخ الاخلاء</th>
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
    <script>
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
                let table = document.getElementsByTagName("table");
                TableToExcel.convert(table[0], {
                    name: "export.xlsx",
                    sheet: {
                        name: 'Sheet 1'
                    }
                });
            });
        });


        // select reach

        $(document).ready(function() {
            $('#CollectionSelect').select2();
            $('#regions').select2();
            $('#cities').select2();
            $('.selectprojects').select2();
            $('.selectNational').select2();
        });

        const arrayResult = @json($out);

        // Selectors
        const selectNumJop = document.querySelector(".selectNumJop");
        const Tbody = document.querySelector(".Tbody");
        const selectDateTO = document.querySelector("#selectDateTO");
        const selectDateFrom = document.querySelector("#selectDateFrom");

        // Result filter
        function ShowResult() {
            let cardResult = document.querySelector(".cardResult");
            cardResult.style.display = "block";

            let NumJopVal = selectNumJop.value;
            const Tbody = document.querySelector(".Tbody");
            let dateFromVal = selectDateFrom.value;
            let dateToVal = selectDateTO.value;

            Tbody.innerHTML = "";
            if (dateFromVal == '' && dateToVal == '') {
                if (NumJopVal == '') {
                    arrayResult.forEach((Result) => {
                        appendResultToTable(Result);
                    });
                } else if (NumJopVal != '') {
                    const resultFilter = arrayResult.filter((result) => {
                        return (
                            (result.empNum == NumJopVal)
                        );
                    });
                    resultFilter.forEach((Result) => {
                        appendResultToTable(Result);
                    });
                }
            } else if (dateFromVal != '' && dateToVal != '') {
                if (NumJopVal == '') {
                    var resultFilter = arrayResult
                } else if (NumJopVal != '') {
                    var resultFilter = arrayResult.filter((result) => {
                        return (
                            (result.empNum == NumJopVal)
                        );
                    });
                }
                const filteredData = resultFilter.filter(item => {
                    const itemDate = item.outDate;
                    return itemDate >= dateToVal && itemDate <= dateFromVal;
                });
                filteredData.forEach((Result) => {
                    appendResultToTable(Result);
                });
            }
        }

        function appendResultToTable(Result) {
            let newTr = document.createElement("tr");

            let tdNameNum = document.createElement("td");
            let tdjopNum = document.createElement("td");
            let tdJop = document.createElement("td");
            let tdNationality = document.createElement("td");
            let tdRagion = document.createElement("td");
            let tdProject = document.createElement("td");
            let tdHousing = document.createElement("td");
            let tdoutDate = document.createElement("td");

            tdNameNum.textContent = Result.empName;
            tdjopNum.textContent = Result.empNum;
            tdJop.textContent = Result.empJob;
            tdNationality.textContent = Result.empNationality;
            tdRagion.textContent = Result.empCity;
            tdProject.textContent = Result.empLocation;
            tdHousing.textContent = `المنطقة : ${Result.region} - المدينة : ${Result.city} - المجمع : ${Result.collection} -
            الوحدة : ${Result.building} - الشقة : ${Result.apartmentNum} - الغرفة : ${Result.roomNum}`;
            tdoutDate.textContent = Result.outDate;

            newTr.value = Result.id;

            newTr.appendChild(tdNameNum);
            newTr.appendChild(tdjopNum);
            newTr.appendChild(tdJop);
            newTr.appendChild(tdNationality);
            newTr.appendChild(tdRagion);
            newTr.appendChild(tdProject);
            newTr.appendChild(tdHousing);
            newTr.appendChild(tdoutDate);

            Tbody.appendChild(newTr);
        }
    </script>
@endsection
