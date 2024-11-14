@extends('layouts.app')

@section('content')
<div class="p-10 overflow-auto" dir="rtl">

    <!-- نموذج البحث -->
    <form method="GET" action="{{ url('test/a') }}" class="mb-5">
        <input type="text" name="search" value="{{ request()->search }}" class="p-2 border rounded"
            placeholder="ابحث هنا...">
        <button type="submit" class="p-2 bg-blue-500 text-white rounded">بحث</button>
    </form>

    <!-- عرض رسالة إذا كانت موجودة -->
    @if(session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
    @endif

    <!-- زر لإعادة تحميل الجدول كما كان -->
    <form method="GET" action="{{ url('test') }}" class="mb-5">
        <button type="submit" class="p-2 bg-gray-500 text-white rounded">إعادة تحميل البيانات</button>
    </form>

    <!-- الجدول الذي يعرض البيانات -->
    <table class="table p-3  overflow-auto rounded-xl">



        <tbody>
            {{-- @dd($data[2]->room->unit->compon->city->id) --}}
            @forelse ($data as $a)


            <tr>
                <td>{{ $a->id }}</td>
                <td>{{ $a->numberOr }}</td>
                <td>{{ $a->name }}</td>
                <td>{{ $a->gender }}</td>
                <td>{{ $a->job }}</td>
                <td>{{ $a->idNumber }}</td>
                <td>{{ $a->region }}</td>
                <td>{{ $a->lection }}</td>
                <td>
                    
                    <a
                    class=" text-green-600"
                        href="{{ isset($a->room->unit->compon->city->id) ? route('collection.shows', $a->room->unit->compon->city->id) : '#' }}">{{
                        $a->room->numberOfRoom ?? 'لم يسكن
                        بعد' }}</a>
                </td>
                <td>
                    <form action="{{ route('test.delete', ['id' => $a->id]) }}" method="POST" style="display:inline;">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                            class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">حذف</button>
                    </form>
                </td>
                <td>
                    <form action="{{ route('notification.housingNew', ['id' => $a->id]) }}" method="POST"
                        style="display:inline;">
                        @csrf

                        <button type="submit"
                            class="font-bold text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">تسكين</button>
                    </form>
                </td>
            </tr>

            @empty
            <tr>
                <td colspan="7" class="text-center">لا توجد نتائج للبحث</td>
            </tr>
            @endforelse
        </tbody>
    </table>

    <!-- روابط التنقل بين الصفحات -->
    <div class="pagination">
        {{ $data->links() }}
    </div>

</div>
@endsection
