@extends('layouts.app')
@section('content')


<div class="card shadow mb-4 content_building">
    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
        <div class="dropdown no-arrow">
            <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
            </a>
        </div>
        <h6 class="m-0 font-weight-bold">التسكين</h6>
    </div>
    <div class="card-body" style=" height: auto">
        <div class="content_building">

            <form action="{{ route('test.update', ['id' => $id ]) }}" class="text-center" method="POST">

                <div class="col-md-12 mb-3 mt-5">
                </div>
                <div class="col-lg-12 text-right mt-5" dir="rtl">
                    <h5> <span class="text-danger">*</span> البيانات الشخصيه</h5>
                </div>
                @csrf
                <div class="col-md-12 mb-3 mt-5">
                    <div class="row" dir="rtl">
                        <div class="col-lg-4">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1">الاسم</label>
                                <input type="text" id="Name" readonly value="{{$data->name}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> الرقم الوظيفي</label>
                                <input type="text" id="NumberJop" readonly value="{{$data->numberOr}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-4">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> رقم الهويه / الاقامه</label>
                                <input type="text" id="NumberLocation" readonly value="{{$data->idNumber}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> المهنه</label>
                                <input type="text" id="WOrk" readonly value="{{$data->job}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> الجنسية</label>
                                <input type="text" id="nationality" readonly value="{{$data->gender}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> المنطقة</label>
                                <input type="text" id="Site" readonly value="{{$data->region}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> الموقع</label>
                                <input type="text" id="Location" readonly value="{{$data->lection}}"
                                    class="block select-none bg-[#eee] border-none form-control" dir="rtl" />
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-lg-12 text-right  mb-3" dir="rtl">
                    <h5> <span class="text-danger">*</span>تسجيل بيانات السكن </h5>
                </div>

                <div class="col-md-12 mb-3 mt-5">
                    <div class="row" dir="rtl">
                        <div class="col-md-3 mb-3 mb-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1">المنطقة</label>

                                <select class="max-w-60 block" onchange="getSelectedRegionId()"
                                    onclick="updateCityOptions()" id="region">
                                    <option selected disabled value="">اختار منطقة السكن</option>
                                    @foreach ($region as $reg )
                                    <option value="{{$reg->id}}">{{$reg->region_en}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-2 mb-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1">المدينه</label>

                                <select id="cities" onchange="getCities()" onclick="upCom()" class=" block">
                                    <option selected disabled value="">اختار منطقة السكن</option>



                                </select>
                            </div>
                        </div>

                        <div class="col-md-4 mb-3">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1">المجمع السكني</label>

                                <select id="com" class="block " onchange="getUnt()" onclick="upUnit()">
                                    <option selected disabled value="">اختار منطقة السكن</option>

                                </select>
                            </div>
                        </div>
                        <div class="col-md-3  mb-3">
                            <div class="form-group text-right">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1"> الوحده السكنيه</label>
                                    <select id="unit" class=" block " onchange="getRooms()" onclick="upRooms()">
                                        <option selected disabled value="">اختار الوحدة السنية</option>

                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-2">
                            <div class="form-group text-right">
                                <label for="exampleFormControlSelect1"> رقم الغرفة</label>
                                {{-- <input type="text" readonly class="block select-none bg-[#eee] border-none "
                                    value="" /> --}}
                                <select id="room" name="room_id" class="block">
                                    <option selected disabled value="">اختار رقم الغرفة</option>

                                </select>
                            </div>
                        </div>

                        <div class="col-md-3 mb-3">
                            <div class="form-group text-right">
                                <div class="form-outline">
                                    <label class="form-label" for="form3Example1">تاريخ التسكين</label>
                                    <input type="date" name="date" id="form3Example1" class="block form-control"
                                        dir="rtl" />
                                </div>
                            </div>
                        </div>

                    </div>

                </div>

                <input type="submit" value="حفظ" class="btn m-auto text-center btn-save btn-searsh btn-primary" />
            </form>
        </div>
    </div>
</div>
<script>
    const tt = @json($region);
    function getSelectedRegionId() {
    const selectElement = document.getElementById("region");
    const selectedId = selectElement.value;
    const region = tt.find(e => e.id == selectedId);


    if (region) {
    return region.cities;
    }
    return [];
    }
    function updateCityOptions() {
    // الحصول على المدن من خلال استدعاء دالة getSelectedRegionId
    const cities = getSelectedRegionId();

    const citySelect = document.getElementById("cities");





    cities.forEach(city => {
    const option = document.createElement("option");
    option.value = city.id;
    option.textContent = city.city_en;
    citySelect.appendChild(option);
    });
    }




    function getCities() {
    const selectElement = document.getElementById("cities");
    const selectedId = selectElement.value;
    const cities = getSelectedRegionId().find(e => e.id == selectedId);

if (cities) {
return cities.coms;
}
return [];
    }

    function upCom() {
        // الحصول على المدن من خلال استدعاء دالة getSelectedRegionId
        const cities = getCities();

        const citySelect = document.getElementById("com");


        cities.forEach(city => {
        const option = document.createElement("option");
        option.value = city.id;
        option.textContent = city.nameRegion;
        citySelect.appendChild(option);
        });

        }

   function getUnt() {
    const selectElement = document.getElementById("com");
    const selectedId = selectElement.value;
    const cities = getCities().find(e => e.id == selectedId);

if (cities) {
return cities.units;
}
return [];
    }
    function upUnit() {
        // الحصول على المدن من خلال استدعاء دالة getSelectedRegionId
        const cities = getUnt();

        const citySelect = document.getElementById("unit");



        cities.forEach(city => {
        const option = document.createElement("option");
        option.value = city.id;
        option.textContent = city.nameUnit;
        citySelect.appendChild(option);
        });

        }
   function getRooms() {
    const selectElement = document.getElementById("unit");
    const selectedId = selectElement.value;
    const cities = getUnt().find(e => e.id == selectedId);

if (cities) {
return cities.rooms;
}
return [];
    }
    function upRooms() {
        // الحصول على المدن من خلال استدعاء دالة getSelectedRegionId
        const cities = getRooms();

        const citySelect = document.getElementById("room");



        cities.forEach(city => {
        const option = document.createElement("option");
        option.value = city.id;
        option.textContent = city.numberOfRoom;
        citySelect.appendChild(option);
        });

        }
</script>
@endsection
