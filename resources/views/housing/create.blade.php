@extends('layouts.app')

@section('content')
    <div class="housing dashboard">
        <div class="container ">
            <div class="row">
                <div class="col-xl-12 col-lg-12">
                    @if (Session::has('done'))
                        <div class="alert alert-success" role="alert" dir="rtl">
                            تمت العملية بنجاح
                        </div>
                    @endif
                    @if (Session::has('ll'))
                        <div class="alert alert-danger" role="alert" dir="rtl">
                            هذه الغرفة ممتلئة
                        </div>
                    @endif
                    @if (Session::has('rr'))
                        <div class="alert alert-danger" role="alert" dir="rtl">
                            هذا العامل مسجل بالفعل
                        </div>
                    @endif
                    <div id="housing" class="d-none">
                        <div class="alert alert-danger" role="alert" dir="rtl">
                            هذا العامل يتقاضى بدل سكن
                        </div>
                    </div>
                    <div class="card shadow mb-4 content_building">
                        <div class="card-header py-3 text-right">
                            <h6 class="m-0 font-weight-bold">التسكين</h6>
                        </div>
                        <div class="card-body" style=" height: auto">
                            <div class="content_building">
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
                                <div class="col-lg-12 text-right mt-5" dir="rtl">
                                    <h5> <span class="text-danger">*</span> البيانات الشخصيه</h5>
                                </div>
                                <div class="col-md-12 mb-3 mt-5">
                                    <div class="row" dir="rtl">
                                        <div class="col-lg-4">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">الاسم</label>
                                                <input disabled type="text" id="Name" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> الرقم الوظيفي</label>
                                                <input disabled type="text" id="NumberJop" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> رقم الهويه / الاقامه</label>
                                                <input disabled type="text" id="NumberLocation" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> المهنه</label>
                                                <input disabled type="text" id="WOrk" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> الجنسية</label>
                                                <input disabled type="text" id="nationality" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> المنطقة</label>
                                                <input disabled type="text" id="Site" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>
                                        <div class="col-lg-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1"> الموقع</label>
                                                <input disabled type="text" id="Location" class="form-control"
                                                    dir="rtl" />
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="col-lg-12 text-right  mb-3" dir="rtl">
                                    <h5> <span class="text-danger">*</span> تسجيل بيانات السكن </h5>
                                </div>
                                <form method="POST" action="{{ route('housing.store') }}" class="needs-validation"
                                    novalidate>
                                    @csrf
                                    <div class="col-md-12 mb-3 mt-5">
                                        <div class="row" dir="rtl">
                                            @if (Auth::user()->type != 3)
                                                <div class="col-md-3 mb-3 mb-3">
                                                    <div class="form-group text-right">
                                                        <label for="exampleFormControlSelect1">المنطقة</label>
                                                        <select required name="region"
                                                            class="form-control form-control-md fares" id="regions"
                                                            onchange="updateCities()" dir="rtl">
                                                            <option disabled selected>اختر المنطقة</option>
                                                            @if (Auth::user()->type == 1)
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
                                                            @endif
                                                        </select>
                                                        <input type="text" name="empId" id="empId"
                                                            class="d-none">
                                                        <input type="text" name="empName" id="empName"
                                                            class="d-none">
                                                        <input type="text" name="empNumId" id="empNumId"
                                                            class="d-none">
                                                    </div>
                                                </div>
                                                <div class="col-md-2 mb-3">
                                                    <div class="form-group text-right">
                                                        <label for="exampleFormControlSelect1">المدينة</label>
                                                        <select required name="city" onchange="updateColl()"
                                                            class="form-control form-control-md fares" id="cities"
                                                            dir="rtl">
                                                            <option value="" selected disabled>اختر المدينة</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4 mb-3">
                                                    <div class="form-group text-right">
                                                        <label for="exampleFormControlSelect1">المجمع السكني</label>
                                                        <select required name="collectionId" id="selectColl"
                                                            onchange="updateBuilding()"
                                                            class="form-control form-control-md fares" dir="rtl">
                                                            <option selected disabled>اختر المجمع السكني</option>
                                                            {{-- @foreach ($coll as $item)
                                                            <option value="{{ $item->id }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            @else
                                                <div class="col-md-9 mb-3">
                                                    <div class="form-group text-right">
                                                        <label for="exampleFormControlSelect1">المجمع السكني <span
                                                                class="text-danger">*</span></label>
                                                        <select onchange="collFiltering()" onchange="updateBuilding()"
                                                            id="selectCollTwo" required name="collectionId"
                                                            class="form-select form-control-md fares" dir="rtl">
                                                            <option selected disabled>اختر المجمع السكني</option>
                                                        </select>
                                                        <span class="invalid-feedback">
                                                            يجب ادخال البيانات في هذا الحقل
                                                        </span>
                                                        <input type="text" name="region" class="form-control d-none"
                                                            id="currentRegion">
                                                        <input type="text" name="city" class="form-control d-none"
                                                            id="currentCity">
                                                        <input type="text" name="empId" id="empId"
                                                            class="d-none">
                                                        <input type="text" name="empName" id="empName"
                                                            class="d-none">
                                                        <input type="text" name="empNumId" id="empNumId"
                                                            class="d-none">
                                                    </div>
                                                </div>
                                            @endif
                                            <div class="col-md-3  mb-3">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <label class="form-label"> الوحده
                                                            السكنيه</label>
                                                        <select required name="buildingId" id="selectBuilding"
                                                            onchange="updateApartment()"
                                                            class="form-control form-control-md fares" dir="rtl">
                                                            <option selected disabled>اختر الوحده السكنية</option>
                                                            {{-- @foreach ($building as $item)
                                                                <option value="{{ $item->id }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach --}}
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-lg-2" id="selectApartmentContainer">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1"> رقم الشقة</label>
                                                    <select required name="apartmentId" id="selectApartment"
                                                        class="form-control fares" onchange="updateRoom()">
                                                        <option disabled selected>اختر رقم الشقة</option>
                                                        {{-- @foreach ($apartment as $item)
                                                            <option value="{{ $item->id }}">{{ $item->apartmentNum }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-lg-2">
                                                <div class="form-group text-right" id="selectRoomContainer">
                                                    <label for="exampleFormControlSelect1"> رقم الغرفة</label>
                                                    <select required name="roomId" id="selectRoom"
                                                        class="form-control fares">
                                                        <option disabled selected>اخر رقم الغرفة</option>
                                                        {{-- @foreach ($room as $item)
                                                            <option value="{{ $item->id }}">{{ $item->roomNum }}
                                                            </option>
                                                        @endforeach --}}
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-2 mb-3">
                                                <div class="form-group text-right">
                                                    <label for="exampleFormControlSelect1">حاله الساكن </label>
                                                    <select required name="status" class="form-control fares">
                                                        <option disabled selected>اختر حالة الساكن</option>
                                                        @foreach ($status as $item)
                                                            <option value="{{ $item->name }}">{{ $item->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1"> نوع السكن</label>
                                                        <select required name="type" class="form-control fares">
                                                            <option disabled selected>اختر نوع السكن</option>
                                                            @foreach ($value as $item)
                                                                <option value="{{ $item->name }}">{{ $item->name }}
                                                                </option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <div class="form-group text-right">
                                                    <div class="form-outline">
                                                        <label class="form-label" for="form3Example1">تاريخ
                                                            التسكين</label>
                                                        <input required name="date" type="date" id="form3Example1"
                                                            class="form-control" dir="rtl" />
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
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->type != 1)
        <input type="text" id="aska" class="d-none" value="{{ Auth::user()->attach }}">
    @endif
    <script>
        var currentRegion = @json($region);
        var coll = @json($coll);

        @if (Auth::user()->type != 1)
            var k = document.getElementById('aska').value
            var y = JSON.parse(k);
            @if (Auth::user()->type == 2)
                var regionSelect = document.getElementById('regions');
                for (let i = 0; i < y.length; i++) {
                    var findRegion = currentRegion.filter(coll => coll.id == y[i]);
                    let newOption2 = document.createElement("option");
                    newOption2.value = findRegion[0].id;
                    newOption2.text = findRegion[0].name;
                    regionSelect.add(newOption2);
                }
            @endif
            @if (Auth::user()->type == 3)
                var selectCollTwo = document.getElementById('selectCollTwo');
                for (let i = 0; i < y.length; i++) {
                    var findColl = coll.filter(coll => coll.id == y[i]);
                    let newOption3 = document.createElement("option");
                    newOption3.value = findColl[0].id;
                    newOption3.text = findColl[0].name;
                    selectCollTwo.add(newOption3);
                }

                function collFiltering() {
                    const collFiltering = coll.filter(coll => coll.id == selectCollTwo.value);
                    document.getElementById('currentRegion').value = collFiltering[0].region
                    document.getElementById('currentCity').value = collFiltering[0].city
                    var selectColl = document.getElementById("selectCollTwo").value;
                    var selectBuilding = document.getElementById("selectBuilding");

                    // Clear existing options in the cities dropdown
                    selectBuilding.innerHTML = '<option selected disabled>اختر الوحده السكنية</option>';

                    if (selectColl) {
                        var cityFiltering = building.filter(building => building.collectionId == selectColl);
                        cityFiltering.forEach(building => {
                            let newOption = document.createElement("option");
                            newOption.value = building.id; // Use name_en or name_ar based on your preference
                            newOption.text = building.name;
                            selectBuilding.add(newOption);
                        });
                    }
                }
            @endif
        @endif
        $(document).ready(function() {
            $('.fares').select2();
        });
        const inputName = document.getElementById("Name");
        const inputNumberJop = document.getElementById("NumberJop");
        const inputNumberLocation = document.getElementById("NumberLocation");
        const inputWOrk = document.getElementById("WOrk");
        const inputnationality = document.getElementById("nationality");
        const inputSite = document.getElementById("Site");
        const inputLocation = document.getElementById("Location");
        var myArray = @json($data);
        // بحث العامل
        function searchObject() {
            const inputValue = document.getElementById('SearshInput').value.toLowerCase();
            const searchType = document.getElementById('searchSelect').value.toLowerCase();

            // Search for the object with a key equal to the input value
            if (searchType == 1) {
                var foundObject = myArray.find(obj => obj.num.toLowerCase() === inputValue);
            } else {
                var foundObject = myArray.find(obj => obj.idNum.toLowerCase() === inputValue);
            }

            // Display the result
            if (foundObject) {
                inputName.value = foundObject.name;
                inputNumberJop.value = foundObject.num;
                inputNumberLocation.value = foundObject.idNum;
                inputWOrk.value = foundObject.job;
                inputnationality.value = foundObject.nationality;
                inputSite.value = foundObject.city;
                inputLocation.value = foundObject.location;
                if(foundObject.housing == 1){
                    document.getElementById('housing').classList.replace("d-none", "d-block");
                }else{
                    document.getElementById('housing').classList.replace("d-block", "d-none");
                }
                var empId = document.getElementById('empId').value = foundObject.num;
                var empName = document.getElementById('empName').value = foundObject.name;
                var empNumId = document.getElementById('empNumId').value = foundObject.idNum;
            } else {
                alert('هذا العامل غير موجود');
            }
        }
        // فلتر المجاعات
        function updateColl() {
            var citiesInBuilding = document.getElementById("cities").value;
            var selectColl = document.getElementById("selectColl");

            // Clear existing options in the cities dropdown
            selectColl.innerHTML = '<option selected disabled>اختر المجمع السكني</option>';

            if (citiesInBuilding) {
                var cityFiltering = coll.filter(coll => coll.city == citiesInBuilding);
                cityFiltering.forEach(coll => {
                    let newOption = document.createElement("option");
                    newOption.value = coll.id; // Use name_en or name_ar based on your preference
                    newOption.text = coll.name;
                    selectColl.add(newOption);
                });
            }
        }
        var building = @json($building);
        // فلتر الوحدات
        function updateBuilding() {
            var selectColl = document.getElementById("selectColl").value;
            var selectBuilding = document.getElementById("selectBuilding");

            // Clear existing options in the cities dropdown
            selectBuilding.innerHTML = '<option selected disabled>اختر الوحده السكنية</option>';

            if (selectColl) {
                var cityFiltering = building.filter(building => building.collectionId == selectColl);
                cityFiltering.forEach(building => {
                    let newOption = document.createElement("option");
                    newOption.value = building.id; // Use name_en or name_ar based on your preference
                    newOption.text = building.name;
                    selectBuilding.add(newOption);
                });
            }
        }
        var apartment = @json($apartment)
        // فلتر الشقق
        function updateApartment() {
            var selectBuilding = document.getElementById("selectBuilding").value;
            var selectApartment = document.getElementById("selectApartment");
            var selectApartmentContainer = document.getElementById("selectApartmentContainer");
            var selectRoomContainer = document.getElementById("selectRoomContainer");
            var selectRoom = document.getElementById("selectRoom");
            var unit_type = building.filter(building => building.id == selectBuilding)[0].buildingType;
            if(unit_type == 'كبينة'){
                selectApartmentContainer.style.display = 'none';
                selectApartment.removeAttribute("required");
                updateRoom2()
            }else{
                selectApartmentContainer.style.display = 'block';
                selectApartment.setAttribute('required', true);
                // Clear existing options in the cities dropdown
            selectApartment.innerHTML = '<option selected disabled>اختر رقم الشقة</option>';
            if (selectBuilding) {
                var cityFiltering = apartment.filter(apartment => apartment.buildingId == selectBuilding);
                cityFiltering.forEach(building => {
                    let newOption = document.createElement("option");
                    newOption.value = building.id; // Use name_en or name_ar based on your preference
                    newOption.text = building.apartmentNum;
                    selectApartment.add(newOption);
                });
            }
            }

        }
        var room = @json($room);
        // فلتر الغرف
        function updateRoom() {
            var selectApartment = document.getElementById("selectApartment").value;
            var selectRoom = document.getElementById("selectRoom");
            console.log(apartment);

            // Clear existing options in the cities dropdown
            selectRoom.innerHTML = '<option selected disabled>اخر رقم الغرفة</option>';

            if (selectApartment) {
                var cityFiltering = room.filter(room => room.apartmentNum == selectApartment);
                cityFiltering.forEach(room => {
                    let newOption = document.createElement("option");
                    newOption.value = room.id; // Use name_en or name_ar based on your preference
                    newOption.text = room.roomNum;
                    selectRoom.add(newOption);
                });
            }
        }
        function updateRoom2() {
            var selectBuilding = document.getElementById("selectBuilding").value;
            var selectRoom = document.getElementById("selectRoom");
            console.log(apartment);

            // Clear existing options in the cities dropdown
            selectRoom.innerHTML = '<option selected disabled>اخر رقم الغرفة</option>';

            if (selectBuilding) {
                var cityFiltering = room.filter(room => room.buildingId == selectBuilding);
                cityFiltering.forEach(room => {
                    let newOption = document.createElement("option");
                    newOption.value = room.id; // Use name_en or name_ar based on your preference
                    newOption.text = room.roomNum;
                    selectRoom.add(newOption);
                });
            }
        }
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
    </script>
@endsection
