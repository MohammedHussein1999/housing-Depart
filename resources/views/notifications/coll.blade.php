@extends('layouts.app')

@section('content')
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
                            <h5 class="card-title text-right">تنبيهات المجمعات @if (Auth::user()->type == 2)
                                    التي تم رفضها
                                @endif
                            </h5>
                        </div>
                        <div class="card-body">
                            <table id="tableOne" class="table table-striped globalTableOne text-center " dir="rtl"
                                style="border :1px solid #c8c8c8">
                                <thead>
                                    <tr>
                                        <th class="text-center">اسم المجمع</th>
                                        <th class="text-center">المنطقة</th>
                                        <th class="text-center">المدينة</th>
                                        <th class="text-center">الاجرائات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($coll as $item)
                                        @if (Auth::user()->type == 1)
                                            <tr>
                                                <td>{{ $item->name }}</td>
                                                <td>{{ $item->region }}</td>
                                                <td>{{ $item->city }}</td>
                                                <td>
                                                    <a href="{{ route('collection.approve', $item->id) }}"
                                                        class="btn btn-success py-0">موافقة</a>
                                                    <a href="{{ route('collection.notApprove', $item->id) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">رفض</a>
                                                </td>
                                            </tr>
                                        @else
                                            <tr>
                                                <td>{{ $item['name'] }}</td>
                                                <td>{{ $item['region'] }}</td>
                                                <td>{{ $item['city'] }}</td>
                                                <td>{{ $item['count'] }}</td>
                                                <td>
                                                    <a href="{{ route('collection.again', $item['id']) }}"
                                                        class="btn btn-success py-0">اعادة ارسال</a>
                                                    <a href="{{ route('collection.destroy', $item['id']) }}"
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
    <script src="{{ asset('js/city.js') }}"></script>
    <script>
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
    </script>
@endsection
