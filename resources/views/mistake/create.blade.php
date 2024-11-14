@extends('layouts.app')

@section('content')
    <div class="Waste dashboard">
        <div class="container ">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @if (Session::has('done'))
                        <div class="alert alert-success" role="alert" dir="rtl">
                            تمت العملية بنجاح
                        </div>
                    @endif
                    @if ($errors->any())
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    @endif
                    <div class="card shadow mb-4 content_building">
                        <div class="card-header p-3" dir="rtl">
                            اضافه مخالفه
                        </div>
                        <div class="card-body" style="height: auto;">
                            <div class="content_building mb-5 bg-light p-1">
                                <div class="col-md-12 mb-3 mt-5">
                                    <div class="row" dir="rtl">
                                        <div class="col-lg-6">
                                            <div class="form-group text-right">
                                                <input type="text" id="SearshInput" class="form-control" autofocus
                                                    placeholder="اكتب ما تبحث عنه..." dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group text-right">
                                                <select class="form-control form-control-md fares" id="searchSelect"
                                                    dir="rtl">
                                                    <option value="1"> رقم الموظف</option>
                                                    <option value="2"> رقم الهوية</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-lg-2">
                                            <button type="button" onclick="searchObject()"
                                                class="btn btn-secondary btn-md btn-block">بحث</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 text-right  mb-3" dir="rtl">
                                    <h5> <span class="text-danger">*</span> بيانات السكن </h5>
                                </div>
                                <form action="{{ route('mistake.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <div class="col-md-12 mb-3 mt-5">
                                        <div class="row" dir="rtl">
                                            <div class="col-md-4  mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">اسم العامل</label>
                                                    <input type="text" class="form-control" id="name" readonly
                                                        dir="rtl" required>
                                                    <input type="text" name="empId" id="empId" class="d-none">
                                                    <input type="text" name="empName" id="empName" class="d-none">
                                                    <input type="text" name="empNumId" id="empNumId" class="d-none">
                                                </div>
                                            </div>
                                            <div class="col-md-4  mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">المنطقة</label>
                                                    <input name="region" type="text" class="form-control" id="region"
                                                        readonly required dir="rtl">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">المدينه</label>
                                                    <input name="city" type="text" class="form-control" id="city"
                                                        readonly required dir="rtl">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">المجمع السكني</label>
                                                    <input name="coll" type="text" class="form-control" id="coll"
                                                        readonly required dir="rtl">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">اسم الوحده
                                                            السكنيه</label>
                                                        <input name="building" type="text" class="form-control"
                                                            dir="rtl" id="build" readonly required />
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> رقم الشقة</label>
                                                    <input name="apartment" type="text" class="form-control"
                                                        dir="rtl" id="apartment" readonly required />
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> رقم الغرفة</label>
                                                    <input name="room" type="text" class="form-control"
                                                        dir="rtl" id="room" readonly required />
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">حاله الساكن </label>
                                                    <input name="status" type="text" id="status"
                                                        class="form-control" readonly required dir="rtl">
                                                </div>
                                            </div>
                                            <div class="col-md-4 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> وصف المخالفة </label>
                                                    <select name="mistakeDescription"
                                                        class="form-control form-control-md fares" dir="rtl">
                                                        <option disabled selected>اختر وصف المخالفة</option>
                                                        @foreach ($mistake as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> التاريخ </label>
                                                    <input type="date" name="date" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> حالة المخالفة </label>
                                                    <select class="form-control form-control-md fares" name="status"
                                                        dir="rtl">
                                                        <option disabled selected>اختر حالة المخالفة</option>
                                                        <option value="قيد الدراسة">قيد الدراسة</option>
                                                        <option value="تم اتخاذ اللازم">تم اتخاذ اللازم</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> الوصف </label>
                                                    <input type="text" name="description" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                </div>
                                            </div>
                                            <div class="col-md-6 mb-3" dir="ltr">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> ارفاق صورة </label>
                                                    <div class="input-group text-right">
                                                        <input type="file" name="file" class="form-control"
                                                            id="customFile">
                                                        <button class="btn btn-primary" type="button"
                                                            data-bs-toggle="modal" data-bs-target="#uploadModal">اختر
                                                            الملفات</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex justify-content-center mt-5 mb-3">
                                        <button type="submit" class="btn btn-save btn-primary">
                                            حفظ
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12 mt-5 mb-4">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                المخالفات
                            </div>
                            <div class="card-body">
                                <table id="tableOne" class="table table-striped text-center" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center">
                                        <tr>
                                            <th class="text-center">اسم العامل</th>
                                            <th class="text-center">الرقم الوظيفي</th>
                                            <th class="text-center">وصف المخالفة</th>
                                            <th class="text-center">التاريخ</th>
                                            <th class="text-center">الملف</th>
                                            <th class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody class="text-center">
                                        @if (Auth::user()->type == 1)
                                            @foreach ($mistakes as $item)
                                                <tr>
                                                    <td>{{ $item->empName }}</td>
                                                    <td>{{ $item->empNumId }}</td>
                                                    <td>{{ $item->mistakeDescription }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    @if ($item->file != null)
                                                        <td>
                                                            <a class="btn btn-primary py-0"
                                                                href="{{ route('mistake.download', $item->id) }}">
                                                                <i class="fa-solid fa-download" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            .....
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('mistake.destroy', $item->id) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($mistakes as $item)
                                                <tr>
                                                    <td>{{ $item['empName'] }}</td>
                                                    <td>{{ $item['empNumId'] }}</td>
                                                    <td>{{ $item['mistakeDescription'] }}</td>
                                                    <td>{{ $item['date'] }}</td>
                                                    @if ($item['file'] != null)
                                                        <td>
                                                            <a class="btn btn-primary py-0"
                                                                href="{{ route('mistake.download', $item['id']) }}">
                                                                <i class="fa-solid fa-download" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            .....
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('mistake.destroy', $item['id']) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
        (() => {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            const forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.from(forms).forEach(form => {
                form.addEventListener('submit', event => {
                    if (!form.checkValidity()) {
                        event.preventDefault()
                        event.stopPropagation()
                    }

                    form.classList.add('was-validated')
                }, false)
            })
        })()
        $('document').ready(function() {
            $('.fares').select2();
        })
        var housing = @json($housing);
        var coll = @json($coll);
        var building = @json($building);
        var apartment = @json($apartment);
        var room = @json($room);
        var nameInput = document.getElementById('name');
        var regionInput = document.getElementById('region');
        var cityInput = document.getElementById('city');
        var collInput = document.getElementById('coll');
        var buildInput = document.getElementById('build');
        var apartmentInput = document.getElementById('apartment');
        var roomInput = document.getElementById('room');
        var statusInput = document.getElementById('status');

        function searchObject() {
            const inputValue = document.getElementById('SearshInput').value.toLowerCase();
            const searchType = document.getElementById('searchSelect').value.toLowerCase();

            // Search for the object with a key equal to the input value
            if (searchType == 1) {
                var foundObject = housing.find(obj => obj.empId.toLowerCase() === inputValue);
            } else {
                var foundObject = housing.find(obj => obj.empNumId.toLowerCase() === inputValue);
            }
            // Display the result
            if (foundObject) {
                var FindRegion = region.find((region) => {
                    return region.region_id == foundObject.region;
                });
                var FindCity = city.find((item) => {
                    return item.city_id == foundObject.city;
                });
                var FindColl = coll.find((item) => {
                    return item.id == foundObject.collectionId;
                });
                var FindBuilding = building.find((item) => {
                    return item.id == foundObject.buildingId;
                });
                var FindApartment = apartment.find((item) => {
                    return item.id == foundObject.apartmentId;
                });
                var FindRoom = room.find((item) => {
                    return item.id == foundObject.roomId;
                });
                nameInput.value = foundObject.empName;
                regionInput.value = FindRegion.name_ar;
                cityInput.value = FindCity.name_ar;
                collInput.value = FindColl.name;
                buildInput.value = FindBuilding.name;
                if(foundObject.apartmentId){
                    apartmentInput.value = FindApartment.apartmentNum;
                }
                if(foundObject.roomId){
                    roomInput.value = FindRoom.roomNum;
                }
                statusInput.value = foundObject.status;
                var empId = document.getElementById('empId').value = foundObject.empId;
                var empName = document.getElementById('empName').value = foundObject.empName;
                var empNumId = document.getElementById('empNumId').value = foundObject.empNumId;
            } else {
                alert('هذا العامل غير موجود');
            }
        }
    </script>
@endsection
