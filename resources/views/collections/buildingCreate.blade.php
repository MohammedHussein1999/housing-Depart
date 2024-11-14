@extends('layouts.app')

@section('content')
    <div class="dashboard CollectionHouse">
        <div class="container ">
            @if (Session::has('done'))
                <div class="alert alert-success" role="alert" dir="rtl">
                    تمت العملية بنجاح
                </div>
            @endif
            @if ($errors->any())
                <div class="alert alert-danger" role="alert" dir="rtl">
                    لقد حدث خطأ
                </div>
            @endif
            <div class="row">
                {{-- اضافة وحدة سكنية --}}
                <div id="buildingDiv" class="col-xl-12 col-lg-12 ">
                    <div class="card shadow mb-4 content_building">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 text-right">
                            <h4 class="m-0 font-weight-bold">اضافه وحدة سكنية</h4>
                        </div>
                        <!-- Card Body -->
                        <form method="POST" action="{{ route('building.store') }}" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row" dir="rtl">
                                    @if (Auth::user()->type != 3)
                                        <div class="col-lg-4 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المنطقة <span
                                                        class="text-danger">*</span></label>
                                                <select required name="region"
                                                    class="form-select form-control-md fares w-100" id="regionsTwo"
                                                    onchange="updateCitiesTwo()" dir="rtl">
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
                                                <div class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المدينة <span
                                                        class="text-danger">*</span> </label>
                                                <select onchange="updateColl()" name="city"
                                                    class="form-select form-control-md fares" required id="citiesTwo"
                                                    dir="rtl">
                                                    <option selected disabled>أختر المدينة</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المجمع السكني <span
                                                        class="text-danger">*</span></label>
                                                <select id="selectColl" required name="collectionId"
                                                    class="form-select form-control-md fares" dir="rtl">
                                                    <option selected disabled>اختر المجمع السكني</option>
                                                </select>
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    @else
                                        <div class="col-md-12 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المجمع السكني <span
                                                        class="text-danger">*</span></label>
                                                <select onchange="collFiltering()" id="selectCollTwo" required
                                                    name="collectionId" class="form-select form-control-md fares"
                                                    dir="rtl">
                                                    <option selected disabled>اختر المجمع السكني</option>
                                                </select>
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                                <input type="text" name="region" class="form-control d-none"
                                                    id="currentRegion">
                                                <input type="text" name="city" class="form-control d-none"
                                                    id="currentCity">
                                            </div>
                                        </div>
                                    @endif
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">اسم الوحده السكنيه <span
                                                        class="text-danger">*</span></label>
                                                <input required name="name" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group text-right">
                                            <label for="exampleFormControlSelect1 ">نوع الوحدة السكنيه <span
                                                    class="text-danger">*</span></label>
                                            <select required name="buildingType"
                                                class="form-select TypeHouse form-control-md fares" dir="rtl">
                                                <option disabled selected>اختر نوع الوحدة السكنية</option>
                                                @foreach ($buildingType as $item)
                                                    @if ($item->active == 1)
                                                        <option value="{{ $item->name }}">{{ $item->name }}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                            <span class="invalid-feedback">
                                                يجب ادخال البيانات في هذا الحقل
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">عدد الطوابق <span
                                                        class="text-danger">*</span></label>
                                                <input required name="value" type="number" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">صور الوحدة السكنية </label>
                                                <div class="input-group " dir="ltr">
                                                    <input name="file" type="file" class="form-control"
                                                        id="customFile">
                                                    <button class="btn btn-save btn-success my-0 py-0" type="button"
                                                        style="font-size: 1rem" data-bs-toggle="modal"
                                                        data-bs-target="#uploadModal">اختر
                                                        صوره</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex align-items-end">
                                        <div class="col-lg-3 mb-3 text-end d-flex justify-content-evenly align-items-center p-0 m-0"
                                            dir="ltr">
                                            <button type="button" class="btn btn-location btn-success text-right mr-3"
                                                data-toggle="modal" data-target="#location">
                                                <i class="fa-solid fa-location-dot mr-2"></i>الموقع
                                            </button>
                                            <button type="button" class="btn btn-location btn-success"
                                                data-toggle="modal" data-target="#placeTwo">
                                                <i class="fa-solid fa-diagram-successor mr-2"></i> المرافق
                                            </button>
                                        </div>
                                        <div class="col-lg-2 mb-4">
                                            <div class="form-check text-right">
                                                <label class="form-check-label mr-4" for="flexCheckDefault">
                                                    التفعيل
                                                </label>
                                                <input name="active" class="form-check-input mr-3" type="checkbox"
                                                    value="1" id="flexCheckDefault">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4 mt-4">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <textarea name="attach" class="form-control d-none" id="TextareaOne" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-center my-5 mb-3">
                                <button type="submit" class="btn btn-save btn-success">
                                    حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('apartment.create') }}" id="buildingShow"
                            class="btn btn-save btn-success mb-3 " style="color: #fff; max-width: fit-content;"><i
                                class="fa-solid fa-arrow-left"> الشقق </i></a>
                        @if (Auth::user()->type != 3)
                            <a href="{{ route('collection.create') }}" id="buildingShow"
                                class="btn btn-save btn-success mb-3 " style="color: #fff; max-width: fit-content;"><i
                                    dir="rtl" class="fa-solid fa-arrow-right"> المجمعات السكنية </i></a>
                        @endif
                    </div>
                </div>
                <!-- مرفق الوحدات السكنيه -->
                <div class="position-relative">
                    <!-- Modal -->
                    <div class="modal fade" id="placeTwo" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 20%; ">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="place">اضافه مرفق</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body  bodyOfplaceTwo" style="max-height: 355px;   overflow-y: scroll;">
                                    <form action="" class="FormPlaceOne">
                                        <div class="row parentBodyPlace d-flex align-items-baseline">

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="button"
                                        class="btn btn-primary savePlacesTwo"data-dismiss="modal">حفظ</button>
                                    <button type="button" class="btn btn-primary choosePlaceTwo">اضف مرفق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- خريطه اضافه وحده -->
                <div class="position-relative">
                    <!-- Modal -->
                    <div class="modal fade" id="location" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 13%;">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="location">اضافه موقع</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row  d-flex align-items-baseline">
                                        <div class="col-lg-12">
                                            <div class="form-group text-right">
                                                <input type="text" class="form-control" id="exampleInputEmail1"
                                                    aria-describedby="emailHelp" placeholder="ابحث عن المكان الذي تريده"
                                                    dir="rtl">
                                            </div>
                                        </div>
                                        <div class="col-lg-12">
                                            <div id="mapTwo" style="height: 300px;"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="button" onclick="saveLocationTwo()" class="btn btn-primary"
                                        data-dismiss="modal"> حفظ الموقع</button>
                                </div>
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
        const coll = @json($collection);
        @if (Auth::user()->type != 1)
            var currentRegion = @json($region);
            var k = document.getElementById('aska').value
            var y = JSON.parse(k);
            @if (Auth::user()->type == 2)
                var regionSelect = document.getElementById('regionsTwo');
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
                }
            @endif
        @endif
        @if (Auth::user()->type != 3)
            function updateColl() {
                const citiesInBuilding = document.getElementById("citiesTwo").value;
                const selectColl = document.getElementById("selectColl");

                // Clear existing options in the cities dropdown
                selectColl.innerHTML = '<option selected disabled>اختر المجمع السكني</option>';

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
        @endif
        $(document).ready(function() {
            $('.fares').select2();
        });
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
