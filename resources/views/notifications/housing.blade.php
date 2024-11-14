@extends('layouts.app')

@section('content')
@dd($cmd)
    <div class="histiryHouses dashboard">
        <div class="container ">
            @if (Session::has('done'))
                <div class="alert alert-success" role="alert" dir="rtl">
                    تمت العملية بنجاح
                </div>
            @endif
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="card card-plain ">
                        <div class="card-header">
                            <h5 class="card-title text-right">تنبيهات التسكين @if (Auth::user()->type == 3)
                                    التي تم رفضها
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="tableOne" class="table table-striped globalTableOne text-center " dir="rtl"
                                style="border :1px solid #c8c8c8">
                                <thead>
                                    <tr>
                                        <th class="text-center">الاسم</th>
                                        <th class="text-center">الرقم الوظيفي</th>
                                        <th class="text-center">المجمع السكني</th>
                                        <th class="text-center">الوحدة السكنية</th>
                                        <th class="text-center">نوع السكن</th>
                                        <th class="text-center">تاريخ التسكين</th>
                                        <th class="text-center">الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($housing as $item)
                                        @if (Auth::user()->type == 1)
                                            <tr>
                                                <td>{{ $item->empName }}</td>
                                                <td>{{ $item->empId }}</td>
                                                <td>{{ $item->collectionId }}</td>
                                                <td>{{ $item->buildingId }}</td>
                                                <td>{{ $item->type }}</td>
                                                <td>{{ $item->date }}</td>
                                                <td>
                                                    <a href="{{ route('housing.approve', $item->id) }}"
                                                        class="btn btn-success py-0">موافقة</a>
                                                    <a href="{{ route('housing.notApprove', $item->id) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">رفض</a>
                                                </td>
                                            </tr>
                                        @elseif (Auth::user()->type == 2)
                                            <tr>
                                                <td>{{ $item['empName'] }}</td>
                                                <td>{{ $item['empId'] }}</td>
                                                <td>{{ $item['collectionId'] }}</td>
                                                <td>{{ $item['buildingId'] }}</td>
                                                <td>{{ $item['type'] }}</td>
                                                <td>{{ $item['date'] }}</td>
                                                <td>
                                                    <a href="{{ route('housing.approve', $item['id']) }}"
                                                        class="btn btn-success py-0">موافقة</a>
                                                    <a href="{{ route('housing.notApprove', $item['id']) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">رفض</a>
                                                </td>
                                            </tr>
                                        @elseif (Auth::user()->type == 3)
                                            <tr>
                                                <td>{{ $item['empName'] }}</td>
                                                <td>{{ $item['empId'] }}</td>
                                                <td>{{ $item['collectionId'] }}</td>
                                                <td>{{ $item['buildingId'] }}</td>
                                                <td>{{ $item['type'] }}</td>
                                                <td>{{ $item['date'] }}</td>
                                                <td>
                                                    <a href="{{ route('housing.approve', $item['id']) }}"
                                                        class="btn btn-success py-0">اعادة ارسال</a>
                                                    <a href="{{ route('housing.destroy', $item['id']) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">حذف</a>
                                                </td>
                                            </tr>
                                        @endif
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
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
