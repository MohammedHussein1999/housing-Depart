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
                <div class="col-xl-12 col-lg-12 ">
                    <div class="card shadow mb-4 content_apartment">
                        <div class="card-header py-3 text-right">
                            <h4 class="m-0 font-weight-bold"> اضافة غرفة</h4>
                        </div>
                        <form action="{{ route('room.store') }}" method="post" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row" dir="rtl">
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group text-right">
                                            <label for="exampleFormControlSelect1">المجمع السكني <span
                                                    class="text-danger">*</span></label>
                                            <select onchange="updateBuildingTwo()" id="selectCollThree" required
                                                name="collectionId" class="form-select form-control-md fares"
                                                dir="rtl">
                                                <option selected disabled>اختر المجمع السكني</option>
                                                @if (Auth::user()->type == 1)
                                                    @foreach ($collection as $item)
                                                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                                                    @endforeach
                                                @endif
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group text-right">
                                            <label for="exampleFormControlSelect1">وحدة سكنية <span
                                                    class="text-danger">*</span></label>
                                            <select onchange="updateApartment()" id="selectBuildingTwo" required
                                                name="buildingId" class="form-select form-control-md fares" dir="rtl">
                                                <option selected disabled>اختر الوحدة السكنية</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3" id="selectApartmentContainer">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم الشقه <span
                                                        class="text-danger">*</span></label>
                                                <select id="selectApartment" name="apartmentNum"
                                                    class="form-select form-control-md fares" dir="rtl">
                                                    <option disabled selected>اختر رقم الشقة</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم الغرفه <span
                                                        class="text-danger">*</span></label>
                                                <input required name="roomNum" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">السعه <span
                                                        class="text-danger">*</span></label>
                                                <input required name="count" type="number" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم
                                                    الطابق <span class="text-danger">*</span></label>
                                                <input required name="floorNum" type="number" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="d-flex align-items-end">
                                        <div class="col-lg-6 mb-3 px-0 d-none" dir="ltr">
                                            <div class="text-right"> صور المجمع السكني </div>
                                            <div class="input-group mt-4">
                                                <input name="file" type="file" class="form-control" id="customFile">
                                                <button class="btn btn-save btn-success m-0 py-0" type="button"
                                                    style="font-size: 1rem" data-bs-toggle="modal"
                                                    data-bs-target="#uploadModal">اختر
                                                    صوره</button>
                                            </div>
                                        </div>
                                        <div class="col-lg-4 mb-3 d-none text-end d-flex justify-content-evenly align-items-center p-0 m-0"
                                            dir="ltr">
                                            <button type="button" class="btn btn-location btn-success mr-2"
                                                data-toggle="modal" data-target="#otherTwo">
                                                <i class="fa-solid fa-ellipsis  mr-2"></i> اخري
                                            </button>
                                            <button type="button" class="btn btn-location btn-success text-right  "
                                                style="font-size: 14px;" data-toggle="modal" data-target="#priceTwo">
                                                <i class="fa-solid fa-coins mr-1"></i> الاستحقاقات
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
                                    <div class="col-lg-12 mb-4 mt-4 d-none">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <textarea name="other" class="form-control d-none" id="TextareaOtherTwo" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4 mt-4">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <textarea name="attach" class="form-control d-none" id="TextareaPriceTwo" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-center mt-2 mb-3">
                                <button type="submit" class="btn btn-save btn-success">
                                    حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row" dir="rtl">
                        <div class="col-lg-6">
                            <a href="{{ route('apartment.create') }}" id="buildingShow"
                                class="btn btn-save btn-success mb-3" style="color: #fff"><i
                                    class="fa-solid fa-arrow-right"> الشقق </i></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="priceTwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: -112px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 148% !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="price">اشعارات المصروفات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOfPriceTwo" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodyPriceTwo d-flex align-items-baseline">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="button" class="btn btn-primary savepriceTwo"data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary addPriceTwo">اضف استحقاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="otherTwo" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: 0;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: auto !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="otherTwo"> اخري </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOfOtherTwo" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodyOtherTwo d-flex align-items-baseline">
                            <div class="col-lg-1  col-2 text-center">
                                <i class="fa-solid fa-trash-can remove-attech text-center"></i>
                            </div>
                            <div class="col-lg-11 col-10 ">
                                <div class="form-group text-right">
                                    <input type="text" class="form-control OtherInput" id="exampleInputEmail1"
                                        aria-describedby="emailHelp"
                                        placeholder="المرافق المنزلية (الحمامات والمطابخ وما إلى ذلك)" dir="rtl">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="button" class="btn btn-primary saveOtherTwo" data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary addOtherTwo">اضف </button>
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
        const coll = @json($collection);
        const building = @json($building);
        const apartment = @json($apartment);
        @if (Auth::user()->type != 1)
            var currentRegion = @json($region);
            var k = document.getElementById('aska').value
            var y = JSON.parse(k);
            @if (Auth::user()->type == 2)
                var collSelect = document.getElementById('selectCollThree');
                for (let i = 0; i < y.length; i++) {
                    var findColl = coll.filter(coll => coll.region == y[i]);
                    if (findColl.length != 0) {
                        let newOption2 = document.createElement("option");
                        newOption2.value = findColl[0].id;
                        newOption2.text = findColl[0].name;
                        collSelect.add(newOption2);
                    }
                }
            @endif
            @if (Auth::user()->type == 3)
                var collSelect = document.getElementById('selectCollThree');
                for (let i = 0; i < y.length; i++) {
                    var findColl = coll.filter(coll => coll.id == y[i]);
                    let newOption3 = document.createElement("option");
                    newOption3.value = findColl[0].id;
                    newOption3.text = findColl[0].name;
                    collSelect.add(newOption3);
                }
            @endif
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



        function updateBuildingTwo() {
            const selectCollThree = document.getElementById("selectCollThree").value;
            const selectBuildingTwo = document.getElementById("selectBuildingTwo");

            // Clear existing options in the cities dropdown
            selectBuildingTwo.innerHTML = '<option selected disabled>اختر الوحدة السكنية</option>';

            if (selectCollThree) {
                const cityFiltering = building.filter(building => building.collectionId == selectCollThree);
                cityFiltering.forEach(building => {
                    let newOption = document.createElement("option");
                    newOption.value = building.id; // Use name_en or name_ar based on your preference
                    newOption.text = building.name;
                    selectBuildingTwo.add(newOption);
                });
            }
        }

        function updateApartment() {
            const selectBuildingTwo = document.getElementById("selectBuildingTwo").value;
            const selectApartment = document.getElementById("selectApartment");
            const selectApartmentContainer = document.getElementById("selectApartmentContainer");
            const cityFiltering = building.filter(building => building.id == selectBuildingTwo)[0].buildingType;
            console.log(cityFiltering);
            if (cityFiltering == 'كبينة') {
                selectApartmentContainer.style.display = 'none';
                selectApartment.removeAttribute('required');
            } else {
                selectApartmentContainer.style.display = 'block';
                selectApartment.setAttribute('required', true);
                // Clear existing options in the cities dropdown
                selectApartment.innerHTML = '<option selected disabled>اختر رقم الشقة</option>';

                if (selectBuildingTwo) {
                    const cityFiltering = apartment.filter(apartment => apartment.buildingId == selectBuildingTwo);
                    cityFiltering.forEach(building => {
                        let newOption = document.createElement("option");
                        newOption.value = building.id; // Use name_en or name_ar based on your preference
                        newOption.text = building.apartmentNum;
                        selectApartment.add(newOption);
                    });
                }
            }

        }
    </script>
@endsection
