@extends('layouts.app')

@section('content')
    <div class="Sitting dashboard">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
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
                    <div class="card shadow mb-4 content_building">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-end">
                            <h6 class="m-0 font-weight-bold">الاعدادات</h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="row" dir="rtl">
                                <div class="col-lg-4 mb-4">
                                    <div class="list-group" id="list-tab" role="tablist">
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                            href="{{ route('setting.index') }}" role="tab">حاله الغرفة</a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                            href="{{ route('clientStatus.create') }}" role="tab">حاله الساكن</a>
                                        <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                            href="{{ route('buildingType.create') }}" role="tab"> نوع الوحده السكنيه</a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                            href="{{ route('mistake-type.create') }}" role="tab"> انواع المخالفات</a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                            href="{{ route('value.create') }}" role="tab"> ضبط التكلفه</a>
                                        <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                            href="{{ route('data.create') }}" role="tab"> قاعده البيانات </a>
                                    </div>
                                </div>
                                <div class="col-lg-8 ">
                                    <div class="tab-content">
                                        {{-- building type --}}
                                        <div class="tab-pane active" id="listFive" role="tabpanel">
                                            <div class="row">
                                                <div class="col-lg-12">
                                                    <div class="row border p-3"
                                                        style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;"
                                                        dir="rtl">
                                                        <form action="{{ route('buildingType.store') }}" method="post">
                                                            @csrf
                                                            <div class="col-lg-8">
                                                                <div class="form-group text-right">
                                                                    <label for="exampleFormControlSelect1">الاسم</label>
                                                                    <input name="name" type="text"
                                                                        id="form3Example1" class="form-control"
                                                                        dir="rtl" />
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-12 d-flex justify-content-center mt-5 mb-3">
                                                                <button type="submit" class="btn btn-save btn-success">
                                                                    اضافه
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12">
                                                    <div class="col-lg-12 mt-5 mb-4">
                                                        <div class="card" dir="ltr">
                                                            <div class="card-body">
                                                                <table id="tableSitting-Three"
                                                                    class="table table-striped text-center" dir="rtl"
                                                                    style="width:100%; border :1px solid #c8c8c8">
                                                                    <thead class="text-center">
                                                                        <tr>
                                                                            <th class="text-center">الاسم </th>
                                                                            <th class="text-center">التسكين متاح</th>>
                                                                            <th class="text-center">حذف</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($buildingType as $item)
                                                                            <tr>
                                                                                <td>{{ $item->name }}</td>
                                                                                @if ($item->status == 1)
                                                                                    <td>
                                                                                        <a
                                                                                            href="{{ route('buildingType.status', $item->id) }}">
                                                                                            <i class="fa-solid fa-check"
                                                                                                id="availed"></i></a>
                                                                                    </td>
                                                                                @else
                                                                                    <td>
                                                                                        <a
                                                                                            href="{{ route('buildingType.status', $item->id) }}">
                                                                                            <i class="fa-solid fa-xmark"
                                                                                                id="availed"></i></a>
                                                                                    </td>
                                                                                @endif
                                                                                <td>
                                                                                    <a href="{{ route('buildingType.destroy', $item->id) }}"
                                                                                        onclick="return confirm('هل انت متاكد؟')">
                                                                                        <i class="fa-solid fa-trash"></i>
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
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
