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

                {{-- اضافه مجمع سكني --}}
                <div id="collDiv" class="col-xl-12 col-lg-12">
                    <div class="card shadow mb-4 history">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 text-right">
                            <h4 class="m-0 font-weight-bold">اضافة مجمع سكني</h4>
                        </div>
                        <!-- Card Body -->
                        <form method="POST" action="{{ route('collection.store') }}" enctype="multipart/form-data"
                            class="needs-validation" novalidate>
                            @csrf
                            <div class="card-body">
                                <div class="content_history">
                                    <div class="row" dir="rtl">
                                        <div class="col-lg-6 mb-3">
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
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group text-right">
                                                <label for="exampleFormControlSelect1">المدينة <span
                                                        class="text-danger">*</span></label>
                                                <select required name="city" class="form-select form-control-md fares"
                                                    id="citiesTwo" dir="rtl">
                                                    <option value="" selected disabled>أختر المدينة</option>
                                                </select>
                                                <div class="invalid-feedback">
                                                    يجب ادخال البيانات في هذا الحقل
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-12 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">اسم المجمع السكني <span
                                                            class="text-danger">*</span></label>
                                                    <input required name="name" type="text" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                    <span class="invalid-feedback">
                                                        يجب ادخال البيانات في هذا الحقل
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">العنوان التفصيلي <span
                                                            class="text-danger">*</span></label>
                                                    <input required name="location" type="text" id="form3Example1"
                                                        class="form-control" dir="rtl" />
                                                    <span class="invalid-feedback">
                                                        يجب ادخال البيانات في هذا الحقل
                                                    </span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-lg-6 mb-3" dir="ltr">
                                            <div class="form-group text-right">
                                                <div class="form-outline">
                                                    <label class="form-label" for="form3Example1">صور المجمع السكني </label>
                                                    <div class="input-group">
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
                                        <div class="d-flex align-items-end">
                                            <div class="col-lg-3 mb-3  d-flex justify-content-evenly align-items-center p-0 m-0"
                                                dir="ltr">
                                                <button type="button"
                                                    class="btn btn-location btn-success text-right"
                                                    data-toggle="modal" data-target="#location">
                                                    <i class="fa-solid fa-location-dot mr-2"></i>الموقع
                                                </button>
                                                <button type="button" class="btn btn-location btn-success"
                                                    data-toggle="modal" data-target="#place">
                                                    <i class="fa-solid fa-diagram-successor "></i> المرافق
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
                                                    <textarea name="attach" class="form-control d-none" id="TextareaTwo" rows="3"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 d-flex justify-content-center mt-5 mb-4 ">
                                <button type="submit" class="btn btn-save btn-success ">
                                    حفظ
                                </button>
                            </div>
                        </form>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <a href="{{ route('building.create') }}" id="buildingShow"
                                class="btn btn-save btn-success mb-3" style="color: #fff"><i
                                    class="fa-solid fa-arrow-left"> الوحدات السكنية </i></a>
                        </div>
                    </div>
                </div>
                <!-- مرفق المجمع السكني -->
                <div class="position-relative">
                    <!-- Modal -->
                    <div class="modal fade" id="place" tabindex="-1" role="dialog"
                        aria-labelledby="exampleModalLabel" aria-hidden="true" style="top: 20%; ">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="place">اضافه مرفق</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body  bodyOfplaceOne" style="max-height: 355px;   overflow-y: scroll;">
                                    <form action="" class="FormPlaceOne">
                                        <div class="row parentBodyPlace d-flex align-items-baseline">

                                        </div>
                                    </form>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="button"
                                        class="btn btn-primary savePlaces"data-dismiss="modal">حفظ</button>
                                    <button type="button" class="btn btn-primary choosePlaceOne">اضف مرفق</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- خريطه اضافه مجمع -->
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
                                        <iframe
                                            src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d13813.091354988612!2d31.182491950000003!3d30.057712849999994!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sar!2seg!4v1706551975147!5m2!1sar!2seg"
                                            width="600" height="450" style="border:0;" allowfullscreen=""
                                            loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                                    <button type="button" onclick="saveLocationOne()" class="btn btn-primary"
                                        data-dismiss="modal"> حفظ الموقع</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @if (Auth::user()->type == 2)
        <input type="text" id="aska" class="d-none" value="{{ Auth::user()->attach }}">
    @endif
    <script>
        var currentRegion = @json($region);
        @if (Auth::user()->type == 2)
            var k = document.getElementById('aska').value
            var y = JSON.parse(k);
            var regionSelect = document.getElementById('regionsTwo');
            for (let i = 0; i < y.length; i++) {
                var findRegion = currentRegion.filter(coll => coll.id == y[i]);
                let newOption2 = document.createElement("option");
                console.log(findRegion);
                newOption2.value = findRegion[0].id;
                newOption2.text = findRegion[0].name;
                regionSelect.add(newOption2);
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
