@extends('layouts.app')

@section('content')
    @if ($user->type == 2)
        <div class="EditUser dashboard">
            <div class="container ">
                <div class="col-lg-12 mt-5 mb-4">
                    <div class="card">
                        <div class="card-header" dir="rtl">
                            تعديل
                        </div>
                        <form action="{{ route('register.update', $user->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="Edit_User">
                                    <div class="row" dir="rtl">
                                        <div class="col-lg-10 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <select class="form-control form-control-md fares" id="regionsTwo">
                                                    <option selected disabled> اختر المنطقه </option>
                                                    <option value="1">منطقة الرياض </option>
                                                    <option value="2">منطقة مكة المكرمة </option>
                                                    <option value="3">منطقة المدينة المنورة </option>
                                                    <option value="4">منطقة القصيم</option>
                                                    <option value="5">منطقة الشرقية</option>
                                                    <option value="6">منطقة عسير</option>
                                                    <option value="7">منطقة تبوك</option>
                                                    <option value="8">منطقة حائل</option>
                                                    <option value="9">منطقة الحدود الشماليه</option>
                                                    <option value="10">منطقة جازان</option>
                                                    <option value="11">منطقة نجران</option>
                                                    <option value="12">منطقة الباحة</option>
                                                    <option value="13">منطقة الجوف</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-primary  Add-Region ml-4 mr-4">
                                                حفظ</button>
                                        </div>
                                        <div class="col-lg-12 mb-4 mt-4 d-none">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <textarea id="textArea" name="attach" class="form-control" rows="5" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-5">
                                            <table class="table text-center   red-border" id="placesTable" dir="rtl">
                                                <thead class="table-primary ">
                                                    <tr>
                                                        <th scope="col">المنطقه</th>
                                                        <th scope="col">الاجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyTable" class="globalTableOne">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer mb-4">
                                <button type="submit" class="btn btn-primary savePlaces ml-4 mr-4"> حفظ التعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" class="d-none" id="sas" value="{{ $user->attach }}">
        <script src="{{ asset('js/city.js') }}"></script>
        <script>
            $('document').ready(function() {
                $('.fares').select2();
            })

            @if ($user->attach != null)
                var x = document.getElementById('sas').value;
                var z = JSON.parse(x);
                const UserData = z;
            @else
                const UserData = [];
            @endif
            function displayData() {
                let textArea = document.getElementById('textArea');
                textArea.value = JSON.stringify(UserData);

                let tableBody = document.getElementById('tbodyTable');
                tableBody.innerHTML = '';

                UserData.forEach((regionId, index) => {
                    let row = document.createElement('tr');
                    let cellOne = document.createElement('td');
                    let cellTwo = document.createElement('td');

                    const regionData = region.find(region => region.region_id == regionId);
                    cellOne.textContent = regionData ? regionData.name_ar : '';
                    cellTwo.innerHTML = `<i class="fas fa-trash deleteRow" data-index="${index}"></i>`;
                    row.appendChild(cellOne);
                    row.appendChild(cellTwo);
                    tableBody.appendChild(row);
                });
            }

            function AddData() {
                let inputRegion = document.getElementById('regionsTwo').value;
                UserData.push(inputRegion);
                displayData();
            }

            let AddBtn = document.querySelector(".Add-Region");
            AddBtn.addEventListener("click", AddData);

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('deleteRow')) {
                    let index = e.target.getAttribute('data-index');
                    UserData.splice(index, 1);
                    displayData();
                }
            });

            displayData();
        </script>
    @elseif ($user->type == 3)
        <div class="EditUser dashboard">
            <div class="container ">
                <div class="col-lg-12 mt-5 mb-4">
                    <div class="card">
                        <div class="card-header" dir="rtl">
                            تعديل1515
                        </div>
                        <form action="{{ route('register.update', $user->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="Edit_User">
                                    <div class="row" dir="rtl">
                                        <div class="col-lg-10 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <select class="form-control form-control-md fares" id="regionsTwo">
                                                    <option selected disabled> اختر المجمع السكني </option>
                                                    @foreach($coll as $item)
                                                    <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" class="btn btn-primary  Add-Region ml-4 mr-4">
                                                حفظ</button>
                                        </div>
                                        <div class="col-lg-12 mb-4 mt-4 d-none">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <textarea id="textArea" name="attach" class="form-control" rows="5" readonly></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mt-5 mb-5">
                                            <table class="table text-center   red-border" id="placesTable" dir="rtl">
                                                <thead class="table-primary ">
                                                    <tr>
                                                        <th scope="col">المنطقه</th>
                                                        <th scope="col">االاجراءات</th>
                                                    </tr>
                                                </thead>
                                                <tbody id="tbodyTable" class="globalTableOne">
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer mb-4">
                                <button type="submit" class="btn btn-primary savePlaces ml-4 mr-4"> حفظ التعديل</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <input type="text" class="d-none" id="sas" value="{{ $user->attach }}">
        <script src="{{ asset('js/city.js') }}"></script>
        <script>
            $('document').ready(function() {
                $('.fares').select2();
            })

            @if ($user->attach != null)
                var x = document.getElementById('sas').value;
                var z = JSON.parse(x);
                const UserData = z;
            @else
                const UserData = [];
            @endif

            var coll = @json($coll);
            function displayData() {
                let textArea = document.getElementById('textArea');
                textArea.value = JSON.stringify(UserData);

                let tableBody = document.getElementById('tbodyTable');
                tableBody.innerHTML = '';

                UserData.forEach((regionId, index) => {
                    let row = document.createElement('tr');
                    let cellOne = document.createElement('td');
                    let cellTwo = document.createElement('td');

                    const regionData = coll.find(region => region.id == regionId);
                    cellOne.textContent = regionData ? regionData.name : '';
                    cellTwo.innerHTML = `<i class="fas fa-trash deleteRow" data-index="${index}"></i>`;
                    row.appendChild(cellOne);
                    row.appendChild(cellTwo);
                    tableBody.appendChild(row);
                });
            }

            function AddData() {
                let inputRegion = document.getElementById('regionsTwo').value;
                UserData.push(inputRegion);
                displayData();
            }

            let AddBtn = document.querySelector(".Add-Region");
            AddBtn.addEventListener("click", AddData);

            document.addEventListener('click', function(e) {
                if (e.target.classList.contains('deleteRow')) {
                    let index = e.target.getAttribute('data-index');
                    UserData.splice(index, 1);
                    displayData();
                }
            });

            displayData();
        </script>
    @endif
@endsection
