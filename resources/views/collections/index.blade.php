@extends('layouts.app')

@section('content')
    <div class="histiryHouses dashboard">
        <div class="container ">
            @if (Session::has('done'))
                <div class="alert alert-success" role="alert" dir="rtl">
                    تمت العملية بنجاح
                </div>
            @endif
            @if (Session::has('remove'))
                <div class="alert alert-danger" role="alert" dir="rtl">
                    لا يمكن الحذف
                </div>
            @endif
            <style>
                ul li button{
                    color: #fff !important;
                    border-radius: 0 !important
                }
                ul li button.active{
                    color: #000 !important
                }
                .card-header{
                    border-radius: 0 !important
                }
            </style>
                <ul class="nav nav-tabs d-flex justify-content-between" background="" style="background-color:#285e61; color:#000" id="myTab" role="tablist" dir="rtl">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active rounded-0" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane"
                            type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">المجمعات السكينة</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                            type="button" role="tab" aria-controls="profile-tab-pane"
                            aria-selected="false">الوحدات السكنية</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="contact-tab" data-bs-toggle="tab" data-bs-target="#contact-tab-pane"
                            type="button" role="tab" aria-controls="contact-tab-pane"
                            aria-selected="false">الشقق</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="disabled-tab" data-bs-toggle="tab" data-bs-target="#disabled-tab-pane"
                            type="button" role="tab" aria-controls="disabled-tab-pane"
                            aria-selected="false">الغرف</button>
                    </li>
                </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="col-lg-12 mb-4 px-0 ">
                        <div class="card">
                            <div class="card-header rounded-0" dir="rtl">
                                سجل المجمعات السكنيه
                            </div>
                            <div class="card-body">
                                <table id="tableOne" class="table table-striped text-center globalTableOne" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center"> اسم المجمع السكني </th>
                                            <th class="text-center">المنطقه</th>
                                            <th class="text-center">المدينه</th>
                                            <th class="text-center">عدد الساكنين</th>
                                            <th class="text-center">التفعيل</th>
                                            <th class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($colll as $item)
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['region'] }}</td>
                                                <td>{{ $item['city'] }}</td>
                                                <td>{{ $item['currentCount'] }}</td>
                                                @if ($item['active'] == 1)
                                                    <td>
                                                        <a href="{{ route('collection.active', $item['id']) }}">
                                                            <i class="fa-solid fa-check" id="availed"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('collection.active', $item['id']) }}">
                                                            <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('collection.destroy', $item['id']) }}"
                                                        style="text-decoration: none"
                                                        onclick="return confirm('هل انت متاكد؟')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('collection.edit', $item['id']) }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="col-lg-12 mb-4 px-0">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                سجل الوحدات السكنيه
                            </div>
                            <div class="card-body">
                                <table id="tableTwo" class="table table-striped table-hover text-center globalTableTwo"
                                    dir="rtl" style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center"> اسم الوحده السكنيه</th>
                                            <th class="text-center">المجمع السكني</th>
                                            <th class="text-center">المنطقه</th>
                                            <th class="text-center">المدينه</th>
                                            <th class="text-center"> نوع الوحدة السكنيه</th>
                                            <th class="text-center"> عدد الساكنين</th>
                                            <th class="text-center">التفعيل</th>
                                            <th class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($build as $item)
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['collectionId'] }}</td>
                                                <td>{{ $item['region'] }}</td>
                                                <td>{{ $item['city'] }}</td>
                                                <td>{{ $item['buildingType'] }}</td>
                                                <td>{{ $item['count'] }}</td>
                                                @if ($item['active'] == 1)
                                                    <td>
                                                        <a href="{{ route('building.active', $item['id']) }}">
                                                            <i class="fa-solid fa-check" id="availed"></i></a>
                                                    </td>
                                                @else
                                                    <td>
                                                        <a href="{{ route('building.active', $item['id']) }}">
                                                            <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                    </td>
                                                @endif
                                                <td>
                                                    <a href="{{ route('building.destroy', $item['id']) }}"
                                                        style="text-decoration: none"
                                                        onclick="return confirm('هل انت متاكد؟')">
                                                        <i class="fa-solid fa-trash"></i>
                                                    </a>
                                                    <a href="{{ route('building.edit', $item['id']) }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="contact-tab-pane" role="tabpanel" aria-labelledby="contact-tab"
                    tabindex="0">
                    <div class="col-lg-12 px-0 mb-4">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                سجل الشقق
                            </div>
                            <div class="card-body">
                                <table id="tableThree" class="table table-striped text-center" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center">رقم الشقه</th>
                                            <th class="text-center">المجمع السكني</th>
                                            <th class="text-center"> الوحدات السكنيه</th>
                                            <th class="text-center"> الطابق</th>
                                            <th class="text-center">التفعيل</th>
                                            <th class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->type == 1)
                                            @foreach ($apartment as $item)
                                                <tr>
                                                    <td>{{ $item->apartmentNum }}</td>
                                                    <td>{{ $item->collName }}</td>
                                                    <td>{{ $item->buildingName }}</td>
                                                    <td>{{ $item->floorNum }}</td>
                                                    @if ($item->active == 1)
                                                        <td>
                                                            <a href="{{ route('apartment.active', $item->id) }}">
                                                                <i class="fa-solid fa-check" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{ route('apartment.active', $item->id) }}">
                                                                <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('apartment.destroy', $item->id) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="{{ route('apartment.edit', $item->id) }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($apartment as $item)
                                                <tr>
                                                    <td>{{ $item['apartmentNum'] }}</td>
                                                    <td>{{ $item['collName'] }}</td>
                                                    <td>{{ $item['buildingName'] }}</td>
                                                    <td>{{ $item['floorNum'] }}</td>
                                                    @if ($item['active'] == 1)
                                                        <td>
                                                            <a href="{{ route('apartment.active', $item['id']) }}">
                                                                <i class="fa-solid fa-check" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{ route('apartment.active', $item['id']) }}">
                                                                <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('apartment.destroy', $item['id']) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="{{ route('apartment.edit', $item['id']) }}">
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
                <div class="tab-pane fade" id="disabled-tab-pane" role="tabpanel" aria-labelledby="disabled-tab"
                    tabindex="0">
                    <div class="col-lg-12 px-0 mb-4">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                سجل الغرف
                            </div>
                            <div class="card-body">
                                <table id="tableFour" class="table table-striped text-center" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center">رقم الغرفه</th>
                                            <th class="text-center">المجمع السكني</th>
                                            <th class="text-center">الوحده السكنيه</th>
                                            <th class="text-center">رقم الشقة</th>
                                            <th class="text-center">الطابق</th>
                                            <th class="text-center">التفعيل</th>
                                            <th class="text-center">الإجراءات</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->type == 1)
                                            @foreach ($room as $item)
                                                <tr>
                                                    <td>{{ $item->roomNum }}</td>
                                                    <td>{{ $item->collName }}</td>
                                                    <td>{{ $item->buildingName }}</td>
                                                    <td>{{ $item->apartmentNum }}</td>
                                                    <td>{{ $item->floorNum }}</td>
                                                    @if ($item->active == 1)
                                                        <td>
                                                            <a href="{{ route('room.active', $item->id) }}">
                                                                <i class="fa-solid fa-check" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{ route('room.active', $item->id) }}">
                                                                <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('room.destroy', $item->id) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="{{ route('room.edit', $item->id) }}">
                                                            <i class="fa-regular fa-pen-to-square"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($room as $item)
                                                <tr>
                                                    <td>{{ $item['roomNum'] }}</td>
                                                    <td>{{ $item['collName'] }}</td>
                                                    <td>{{ $item['buildingName'] }}</td>
                                                    <td>{{ $item['apartmentNum'] }}</td>
                                                    <td>{{ $item['floorNum'] }}</td>
                                                    @if ($item['active'] == 1)
                                                        <td>
                                                            <a href="{{ route('room.active', $item['id']) }}">
                                                                <i class="fa-solid fa-check" id="availed"></i></a>
                                                        </td>
                                                    @else
                                                        <td>
                                                            <a href="{{ route('room.active', $item['id']) }}">
                                                                <i class="fa-solid fa-xmark" id="availed"></i></a>
                                                        </td>
                                                    @endif
                                                    <td>
                                                        <a href="{{ route('room.destroy', $item['id']) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                        <a href="{{ route('room.edit', $item['id']) }}">
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
            <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
                integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
            </script>
            <div class="row">
                {{-- المجمع السكني --}}

                {{-- الوحدات السكنية --}}

                {{-- الشقق --}}

                {{-- الغرف --}}

            </div>
        </div>
    </div>
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
        // تغير المنطقه والمدينة ف المجمعات
        const globalTableOne = document.querySelectorAll(".globalTableOne  tr ");
        document.addEventListener("DOMContentLoaded", function() {
            globalTableOne.forEach((row) => {

                const tds = row.querySelectorAll("td");

                if (tds.length) {
                    const tdOne = tds[1];
                    const idValueOne = tdOne.textContent.trim();

                    const FindRegion = region.find((region) => {
                        return region.region_id == idValueOne;
                    });

                    if (FindRegion) {
                        tdOne.innerText = FindRegion.name_ar;
                    }

                    const tdTwo = tds[2];
                    const idValueTwo = tdTwo.textContent.trim();

                    const FindCity = city.find((item) => {
                        return item.city_id == idValueTwo;
                    });

                    if (FindCity) {
                        tdTwo.innerText = FindCity.name_ar;
                    }
                }
            });
        });
        // تغير المنطقه والمدينة في الوحدات
        var coll = @json($coll);
        const globalTableTwo = document.querySelectorAll(".globalTableTwo  tr ");
        document.addEventListener("DOMContentLoaded", function() {
            globalTableTwo.forEach((row) => {

                const tds = row.querySelectorAll("td");

                if (tds.length) {
                    const tdThree = tds[1];
                    const idValueThree = tdThree.textContent.trim();

                    const FindColl = coll.find((coll) => {
                        return coll.id == idValueThree;
                    });

                    if (FindColl) {
                        tdThree.innerText = FindColl.name;
                    }
                    const tdOne = tds[2];
                    const idValueOne = tdOne.textContent.trim();

                    const FindRegion = region.find((region) => {
                        return region.region_id == idValueOne;
                    });

                    if (FindRegion) {
                        tdOne.innerText = FindRegion.name_ar;
                    }

                    const tdTwo = tds[3];
                    const idValueTwo = tdTwo.textContent.trim();

                    const FindCity = city.find((item) => {
                        return item.city_id == idValueTwo;
                    });

                    if (FindCity) {
                        tdTwo.innerText = FindCity.name_ar;
                    }
                }
            });
        });
    </script>
@endsection
