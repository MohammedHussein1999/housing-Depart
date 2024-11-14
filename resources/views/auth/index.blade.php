@extends('layouts.app')

@section('content')
    <div class="Users-Acceibility dashboard">
        <div class="container d-flex align-items-center justify-content-center">
            <div class="col-lg-12 mt-5 mb-4">
                @if (Session::has('done'))
                    <div class="alert alert-success" role="alert" dir="rtl">
                        تمت العملية بنجاح
                    </div>
                @endif
                <div class="card">
                    <div class="card-header" dir="rtl">
                        صلاحيه المستخدمين
                    </div>
                    <div class="card-body">
                        <table id="tableOne" class="table table-striped  globalTableOne text-center" dir="rtl"
                            style="width:100%; border :1px solid #c8c8c8">
                            <thead class="text-center table-primary">
                                <tr>
                                    <th class="text-center">الاسم</th>
                                    <th class="text-center">اسم المتسخدم</th>
                                    <th class="text-center">النوع</th>
                                    <th class="text-center"> الاجراءات</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($user as $item)
                                    @if ($item->id != 1)
                                        <tr>
                                            <td>{{ $item->name }}</td>
                                            <td>{{ $item->email }}</td>
                                            <td>{{ $item->type }}</td>
                                            <td>
                                                <a href="{{ route('register.destroy', $item->id) }}"
                                                    style="text-decoration: none" onclick="return confirm('هل انت متاكد؟')">
                                                    <i class="fa-solid fa-trash"></i>
                                                </a>
                                                @if ($item->type != 1)
                                                    <a href="{{ route('register.edit',$item->id) }}">
                                                        <i class="fa-regular fa-pen-to-square"></i>
                                                    </a>
                                                @endif
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
    <script>
        const globalTableOne = document.querySelectorAll(".globalTableOne  tr ");

        document.addEventListener("DOMContentLoaded", function() {
            globalTableOne.forEach((row) => {

                const tds = row.querySelectorAll("td");

                if (tds.length) {
                    const tdOne = tds[2];
                    const idValueOne = tdOne.textContent.trim();

                    if (idValueOne == 1) {
                        tdOne.innerText = 'مدير التطبيق';
                    } else if (idValueOne == 2) {
                        tdOne.innerText = 'مدير منطقة';
                    } else {
                        tdOne.innerText = 'مدير مجمع سكني'
                    }
                }
            });
        });
    </script>
@endsection
