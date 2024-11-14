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
                            <h5 class="card-title text-right">تنبيهات الاخلاء @if (Auth::user()->type == 3)
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
                                        <th class="text-center">تاريخ التسكين</th>
                                        <th class="text-center">تاريخ الاخلاء</th>
                                        <th class="text-center">سبب الاخلاء</th>
                                        <th class="text-center">الاجراءات</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($out as $item)
                                        @if (Auth::user()->type == 1)
                                            <tr>
                                                <td>{{ $item->empName }}</td>
                                                <td>{{ $item->empId }}</td>
                                                <td>{{ $item->housingDate }}</td>
                                                <td>{{ $item->outDate }}</td>
                                                <td>{{ $item->reason }}</td>
                                                <td>
                                                    <a href="{{ route('out.approve', $item->id) }}"
                                                        class="btn btn-success py-0">موافقة</a>
                                                    <a href="{{ route('out.notApprove', $item->id) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">رفض</a>
                                                </td>
                                            </tr>
                                        @elseif (Auth::user()->type == 2)
                                            <tr>
                                                <td>{{ $item['empName'] }}</td>
                                                <td>{{ $item['empId'] }}</td>
                                                <td>{{ $item['housingDate'] }}</td>
                                                <td>{{ $item['outDate'] }}</td>
                                                <td>{{ $item['reason'] }}</td>
                                                <td>
                                                    <a href="{{ route('out.approve', $item['id']) }}"
                                                        class="btn btn-success py-0">موافقة</a>
                                                    <a href="{{ route('out.notApprove', $item['id']) }}"
                                                        onclick="return confirm('هل انت متاكد؟')"
                                                        class="btn btn-danger py-0">رفض</a>
                                                </td>
                                            </tr>
                                        @elseif (Auth::user()->type == 3)
                                            <tr>
                                                <td>{{ $item['empName'] }}</td>
                                                <td>{{ $item['empId'] }}</td>
                                                <td>{{ $item['housingDate'] }}</td>
                                                <td>{{ $item['outDate'] }}</td>
                                                <td>{{ $item['reason'] }}</td>
                                                <td>
                                                    <a href="{{ route('out.approve', $item['id']) }}"
                                                        class="btn btn-success py-0">اعادة ارسال</a>
                                                    <a href="{{ route('out.destroy', $item['id']) }}"
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
@endsection
