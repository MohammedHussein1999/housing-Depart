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
                                    <a class="list-group-item list-group-item-action " data-bs-toggle="list"
                                        href="{{ route('setting.index') }}" role="tab">حاله الغرفة</a>
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="{{ route('clientStatus.create') }}" role="tab">حاله الساكن</a>
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="{{ route('buildingType.create') }}" role="tab"> نوع الوحده السكنيه</a>
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="{{ route('mistake-type.create') }}" role="tab"> انواع المخالفات</a>
                                    <a class="list-group-item list-group-item-action" data-bs-toggle="list"
                                        href="{{ route('value.create') }}" role="tab"> ضبط التكلفه</a>
                                    <a class="list-group-item list-group-item-action active" data-bs-toggle="list"
                                        href="{{ route('data.create') }}" role="tab"> قاعده البيانات </a>
                                </div>
                            </div>
                            <div class="col-lg-8 ">
                                <div class="tab-content">
                                    {{-- data import --}}
                                    <div class="tab-pane active" id="listSiven" role="tabpanel">
                                        <div class="row">
                                            <div class="col-lg-12">
                                                <div class="col-lg-12 mt-5 mb-4">
                                                    <div class="card" dir="ltr">
                                                        <div class="card-body">
                                                            <form action="{{ route('data.import') }}" method="post"
                                                                enctype="multipart/form-data">
                                                                @csrf
                                                                <div class="col-md-12 mb-3">
                                                                    <div class="input-group mt-4">
                                                                        <input type="file" name="file"
                                                                            class="form-control" id="customFile">
                                                                    </div>
                                                                </div>

                                                                <div class="col-md-12 mb-3">
                                                                    <div class="d-grid gap-2">
                                                                        <button class="btn btn-save btn-success py-1"
                                                                            style="font-size: 1rem"
                                                                            type="submit">تسجيل</button>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                            <div>

                                                                <label for="" class=" w-full">
                                                                    <span
                                                                        class=" text-2xl font-bold text-center w-full">رفع
                                                                        ملف لقاعدة البينات</span>
                                                                    <form action="{{ route('test.name') }}"
                                                                        method="POST" enctype="multipart/form-data">
                                                                        @csrf
                                                                        <input type="file" class=" " name="xlsx_file"
                                                                            accept=".xls,.xlsx">
                                                                        <button
                                                                            class="bg-[#0F7070] text-white rounded p-3"
                                                                            type="submit">رفع الملف</button>
                                                                    </form>
                                                                </label>
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
</div>
@endsection
