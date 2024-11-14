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
                ul li button {
                    color: #fff !important;
                    border-radius: 0 !important
                }

                ul li button.active {
                    color: #000 !important
                }

                .card-header {
                    border-radius: 0 !important
                }
            </style>
            <ul class="nav nav-tabs d-flex justify-content-evenly" background="" style="background-color:#285e61; color:#000"
                id="myTab" role="tablist" dir="rtl">
                <li class="nav-item" role="presentation">
                    <button class="nav-link active rounded-0" id="home-tab" data-bs-toggle="tab"
                        data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane"
                        aria-selected="true">التسكين</button>
                </li>
                <li class="nav-item" role="presentation">
                    <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane"
                        type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">
                        الاخلاء</button>
                </li>
            </ul>
            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab"
                    tabindex="0">
                    <div class="col-lg-12 mb-4 px-0">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                سجل العمالة التي تم تسكينها
                            </div>
                            <div class="card-body">
                                <table id="tableOne" class="table table-striped text-center globalTableOne" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center">الاسم</th>
                                            <th class="text-center">الرقم الوظيفي</th>
                                            <th class="text-center">المجمع السكني</th>
                                            <th class="text-center">الوحده السكنية</th>
                                            <th class="text-center">نوع السكن</th>
                                            <th class="text-center">تاريخ التسكين</th>
                                            <th class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->type == 1)
                                            @foreach ($housing as $item)
                                                <tr>
                                                    <td>{{ $item->empName }}</td>
                                                    <td>{{ $item->empId }}</td>
                                                    <td>{{ $item->collectionId }}</td>
                                                    <td>{{ $item->buildingId }}</td>
                                                    <td>{{ $item->type }}</td>
                                                    <td>{{ $item->date }}</td>
                                                    <td>
                                                        <a href="{{ route('housing.destroy', $item->id) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($housing as $item)
                                                <tr>
                                                    <td>{{ $item['empName'] }}</td>
                                                    <td>{{ $item['empId'] }}</td>
                                                    <td>{{ $item['collectionId'] }}</td>
                                                    <td>{{ $item['buildingId'] }}</td>
                                                    <td>{{ $item['type'] }}</td>
                                                    <td>{{ $item['date'] }}</td>
                                                    <td>
                                                        <a href="{{ route('housing.destroy', $item['id']) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
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
                <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab"
                    tabindex="0">
                    <div class="col-lg-12 mb-4 px-0">
                        <div class="card">
                            <div class="card-header" dir="rtl">
                                سجل الاخلاء
                            </div>
                            <div class="card-body">
                                <table id="tableTwo" class="table table-striped text-center" dir="rtl"
                                    style="width:100%; border :1px solid #c8c8c8">
                                    <thead class="text-center table-primary">
                                        <tr>
                                            <th class="text-center">الاسم</th>
                                            <th class="text-center">الرقم الوظيفي</th>
                                            <th class="text-center">تاريخ التسكين</th>
                                            <th class="text-center">تاريخ الاخلاء</th>
                                            <th class="text-center">سبب الاخلاء</th>
                                            <th class="text-center">حذف</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (Auth::user()->type == 1)
                                            @foreach ($out as $item)
                                                <tr>
                                                    <td>{{ $item->empName }}</td>
                                                    <td>{{ $item->empId }}</td>
                                                    <td>{{ $item->housingDate }}</td>
                                                    <td>{{ $item->outDate }}</td>
                                                    <td>{{ $item->reason }}</td>
                                                    <td>
                                                        <a href="{{ route('out.destroy', $item->id) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
                                                        </a>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        @else
                                            @foreach ($out as $item)
                                                <tr>
                                                    <td>{{ $item['empName'] }}</td>
                                                    <td>{{ $item['empId'] }}</td>
                                                    <td>{{ $item['housingDate'] }}</td>
                                                    <td>{{ $item['outDate'] }}</td>
                                                    <td>{{ $item['reason'] }}</td>
                                                    <td>
                                                        <a href="{{ route('out.destroy', $item['id']) }}"
                                                            style="text-decoration: none"
                                                            onclick="return confirm('هل انت متاكد؟')">
                                                            <i class="fa-solid fa-trash"></i>
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
        </div>
    </div>
    <script>
        var coll = @json($coll);
        var building = @json($building);
        const globalTableOne = document.querySelectorAll(".globalTableOne  tr ");
        document.addEventListener("DOMContentLoaded", function() {
            globalTableOne.forEach((row) => {

                const tds = row.querySelectorAll("td");

                if (tds.length) {
                    const tdOne = tds[2];
                    const idValueOne = tdOne.textContent.trim();

                    const FindRegion = coll.find((coll) => {
                        return coll.id == idValueOne;
                    });

                    if (FindRegion) {
                        tdOne.innerText = FindRegion.name;
                    }

                    const tdTwo = tds[3];
                    const idValueTwo = tdTwo.textContent.trim();

                    const FindCity = building.find((item) => {
                        return item.id == idValueTwo;
                    });

                    if (FindCity) {
                        tdTwo.innerText = FindCity.name;
                    }
                }
            });
        });
    </script>
@endsection
