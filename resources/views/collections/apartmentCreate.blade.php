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
                <div class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4 content_apartment">
                        <div class="card-header py-3 text-right">
                            <h4 class="m-0 font-weight-bold"> اضافة شقة</h4>
                        </div>
                        <form action="{{ route('apartment.store') }}" method="post" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="row" dir="rtl">
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group text-right">
                                            <label for="exampleFormControlSelect1">المجمع السكني <span
                                                    class="text-danger">*</span></label>
                                            <select onchange="updateBuilding()" id="selectCollTwo" required
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
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group text-right">
                                            <label for="exampleFormControlSelect1">وحدة سكنية <span
                                                    class="text-danger">*</span></label>
                                            <select id="selectBuilding" required name="buildingId"
                                                class="form-select form-control-md fares" dir="rtl">
                                                <option selected disabled>اختر الوحدة السكنية</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم الشقه <span
                                                        class="text-danger">*</span></label>
                                                <input required name="apartmentNum" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم الطابق <span
                                                        class="text-danger">*</span></label>
                                                <input required name="floorNum" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                                <span class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">عدد الحمامات</label>
                                                <input name="bathroomCount" type="number" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-6 col-md-12 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">عداد
                                                    الكهرباء</label>
                                                <input name="electricity" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 mb-3">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <label class="form-label" for="form3Example1">رقم الحساب </label>
                                                <input name="accountNum" type="text" id="form3Example1"
                                                    class="form-control" dir="rtl" />
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 d-flex align-items-end">
                                        <div class="d-none col-lg-6 mb-3 text-end d-flex justify-content-evenly align-items-center p-0 m-0"
                                            dir="ltr">
                                            <button type="button" class="btn btn-location btn-success mr-2"
                                                data-toggle="modal" data-target="#otherOne">
                                                <i class="fa-solid fa-ellipsis  mr-2"></i> اخري
                                            </button>
                                            <button type="button" class="btn btn-location btn-success text-right  "
                                                style="font-size: 14px;" data-toggle="modal" data-target="#price">
                                                <i class="fa-solid fa-coins mr-1"></i> الاستحقاقات
                                            </button>
                                        </div>
                                        <div class="col-lg-6 mb-4">
                                            <div class="form-check text-right">
                                                <label class="form-check-label mr-4" for="flexCheckDefault">
                                                    التفعيل
                                                </label>
                                                <input name="active" class="form-check-input mr-3" type="checkbox"
                                                    value="1" id="flexCheckDefault">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4 mt-4 ">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <textarea name="other" class="form-control d-none" id="TextareaOtherOne" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-12 mb-4 mt-4 d-none">
                                        <div class="form-group text-right">
                                            <div class="form-outline">
                                                <textarea name="attach" class="form-control d-none" id="TextareaPriceOne" rows="1"></textarea>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 d-flex justify-content-center mt-2 mb-3">
                                    <button type="submit" class="btn btn-save btn-success">
                                        حفظ
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="d-flex justify-content-between">
                        <a href="{{ route('room.create') }}" id="buildingShow"
                            class="btn btn-save btn-success mb-3 " style="color: #fff; max-width: fit-content;"><i
                                class="fa-solid fa-arrow-left"> الغرف </i></a>
                        <a href="{{ route('building.create') }}" id="buildingShow"
                            class="btn btn-save btn-success mb-3 " style="color: #fff; max-width: fit-content;"><i
                                dir="rtl" class="fa-solid fa-arrow-right"> الوحدات السكنية </i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="price" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: -112px;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: 148% !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="price">اشعارات المصروفات</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOfPrice" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodyPrice d-flex align-items-baseline">

                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                        <button type="button" class="btn btn-primary saveprice"data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary addPrice">اضافه استحقاق</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="position-relative">
        <!-- Modal -->
        <div class="modal fade" id="otherOne" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true" style="top: 20%;left: 0;">
            <div class="modal-dialog" role="document">
                <div class="modal-content" style="width: auto !important;">
                    <div class="modal-header">
                        <h5 class="modal-title" id="otherOne"> اخري </h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body  bodyOfOtherOne" style="max-height: 300px;   overflow-y: scroll;">
                        <div class="row parentBodyOtherOne d-flex align-items-baseline">
                            <div class="col-lg-1 col-2  text-center">
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
                        <button type="button" class="btn btn-primary saveOtherOne" data-dismiss="modal">حفظ</button>
                        <button type="button" class="btn btn-primary addOtherOne">اضف </button>
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
        const building = @json($building);
        @if (Auth::user()->type != 1)
            var currentRegion = @json($region);
            var k = document.getElementById('aska').value
            var y = JSON.parse(k);
            @if (Auth::user()->type == 2)
                var regionSelect = document.getElementById('selectCollTwo');
                for (let i = 0; i < y.length; i++) {
                    var findColl = coll.filter(coll => coll.region == y[i]);
                    if (findColl.length != 0) {
                        let newOption2 = document.createElement("option");
                        newOption2.value = findColl[0].id;
                        newOption2.text = findColl[0].name;
                        regionSelect.add(newOption2);
                    }
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


        function updateBuilding() {
            const selectCollTwo = document.getElementById("selectCollTwo").value;
            const selectBuilding = document.getElementById("selectBuilding");

            // Clear existing options in the cities dropdown
            selectBuilding.innerHTML = '<option selected disabled>اختر الوحدة السكنية</option>';

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
    </script>
@endsection
