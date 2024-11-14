@extends('layouts.app')
@section('content')
<div class="mb-6 p-5 bg-white min-h-screen">
    <div id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab"
        class="block transition-opacity duration-150 ease-linear">
        <div class="container">
            <!-- Button to open form -->
            <button id="bit" type="button" onclick="toggleForm('form1')"
                class="inline-block rounded m-5 bg-green-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out   motion-reduce:transition-none  ">
                NEW CAMPS <i class="fa-solid fa-plus"></i>
            </button>
            @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
            @endif
            <!-- Hidden Form -->

            <div id="form1"
                class="hidden con-hid fixed top-0 left-0 flex items-center justify-center w-full h-full z-10 bg-gray-500 bg-opacity-50">
                <form dir="rtl" method="POST" action="{{ route('collection.shows.create', ['id' => $id]) }}"
                    class="text-center bg-white p-5 w-max h-max border border-black text-black space-y-5 px-10 mt-32 rounded-lg">
                    @csrf
                    <div class="flex flex-row justify-evenly w-full space-x-4">
                        <!-- Region Display -->
                        <label class="block text-sm font-medium text-gray-900">
                            <span class="block mb-2 text-2xl font-bold">المنطقة</span>
                            <input type="text" readonly name="nameRegion"
                                class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg"
                                value="{{ $City->regions->region_en }}" />
                        </label>
                        <!-- City Display -->
                        <label class="block text-sm font-medium text-gray-900">
                            <span class="block mb-2 text-2xl font-bold">المدينة</span>
                            <input type="text" readonly name="nameCity"
                                class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg"
                                value="{{ $City->city_en }}" />
                        </label>
                    </div>
                    <!-- Complex Name Input -->
                    <label class="text-2xl font-bold text-gray-900 flex items-center gap-4">
                        <span>اسم المجمع</span>
                        <input type="text" name="nameComplex"
                            class="bg-gray-200 text-center text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                    </label>
                    @error('nameComplex')
                    <div class="text-red-500  mt-1 text-bold text-2xl">{{ $message }}</div>
                    @enderror
                    <input type="hidden" name="city_id" value="{{ $id }}">
                    <!-- Submit Button -->
                    <input
                        class="font-bold text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5"
                        type="submit" value="Create" />
                    <button type="button" onclick="toggleForm('form1')"
                        class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">Close</button>
                </form>
            </div>
        </div>
    </div>
    <!-- Data Table -->
    {{-- الوحدات --}}
    <div id="accordion-collapse" class=" space-y-3 p-10 min-w-min" data-accordion="collapse">
        @foreach ($City->coms as $compaoend )
        <h2 id="accordion-collapse-heading-1">
            <button type="button"
                class="flex items-center bg-green-700 justify-between w-full p-5 font-medium rtl:text-right text-gray-500 border border-b-0 border-gray-200 rounded-t-xl focus:ring-4 focus:ring-green-800   hover:bg-green-80000  gap-3"
                data-accordion-target="#accordion-collapse-body-{{$compaoend->id}}" aria-expanded="false"
                aria-controls="accordion-collapse-body-{{$compaoend->id}}">
                <span class=" text-4xl text-white font-bold">{{$compaoend->nameComplex}}</span>

                <svg data-accordion-icon class="w-3  h-3 rotate-180 text-white shrink-0" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M9 5 5 1 1 5" />
                </svg>
            </button>
        </h2>
        <div id="accordion-collapse-body-{{$compaoend->id}}" class="hidden m-0 shadow-[5px_5px_5px_-2px_#364253]"
            aria-labelledby="accordion-collapse-heading-{{$compaoend->id}}">
            <div class="px-5 border  border-gray-200 space-y-3 ">
                <div class=" flex flex-row items-center justify-between">
                    <div id="tabs-home" role="tabpanel" aria-labelledby="tabs-home-tab"
                        class="block transition-opacity duration-150 ease-linear">
                        <div class="container">
                            <!-- Button to open form -->
                            <button id="bit" type="button" onclick="toggleForm({{$compaoend->id+2}})"
                                class="inline-block rounded my-3 bg-green-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out   motion-reduce:transition-none  ">
                                NEW Compone <i class="fa-solid fa-plus"></i>
                            </button>
                            <!-- Hidden Form -->
                            {{-- compone --}}
                            <div id="{{$compaoend->id+2}}"
                                class="hidden  con-hid fixed top-0 left-0 flex items-center justify-center w-full h-full z-10 bg-gray-500 bg-opacity-50">
                                <form dir="rtl" method="POST"
                                    action="{{ route('collection.create.unit', ['id' => $id]) }}"
                                    class="text-center bg-white p-5 w-max h-max border border-black text-black space-y-5 px-10 mt-32 rounded-lg">
                                    @csrf
                                    <div class="flex flex-col items-baseline gap-3  w-full space-x-4">
                                        <!-- Region Display -->
                                        <!-- حقل "اسم الوحدة السكنية" -->
                                        <label class="text-2xl font-bold text-gray-900 flex items-center gap-4">
                                            <span>اسم الوحدة السكنية</span>
                                            <input type="text" name="nameUnit"
                                                class="bg-gray-200 text-center text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label>
                                        @error('nameUnit')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                        <!-- City Display -->
                                        <label
                                            class="  text-sm flex flex-row gap-2 justify-between font-medium text-gray-900">
                                            <span class="block mb-2 text-2xl font-bold">نوع الوحدة السكنية</span>
                                            <input type="text" name="typeHousing"
                                                class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label>
                                        @error('typeHousing')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                        <!-- حقل "عدد الطوابق" -->
                                        <label class="text-2xl font-bold text-gray-900 flex items-center gap-4">
                                            <span>عدد الطوابق</span>
                                            <input type="text" name="numberOfFloors"
                                                class="bg-gray-200 text-center text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label>
                                        @error('numberOfFloors')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="compon_id" value="{{ $compaoend->id }}">
                                    <!-- Submit Button -->
                                    <input
                                        class="font-bold text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5"
                                        type="submit" value="Create" />
                                    <button type="button" onclick="toggleForm({{$compaoend->id+2}})"
                                        class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">Close</button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div>
                        <h2 class="text-2xl font-bold">الوحدات السكنية </h2>
                    </div>
                </div>
                <table dir="rtl" class="table    text-3x1 font-bold ">
                    <tr class="space-y-2 " for="">
                        <th class="text-white">اسم الوحدة الكنية </th>
                        <th class="text-white">نوع الوحدة السكنية</th>
                        <th class="text-white">عدد الطوابق</th>
                        <th class="text-white">اضافة غرفة</th>
                        <th class="text-white">عرض البينات</th>
                        <th class="text-white">حذف</th>
                    </tr>
                    @foreach ( $compaoend->units as $unit)
                    <tr class="space-y-2" for="">
                        <td>{{$unit->nameUnit}}</td>
                        <td>{{$unit->typeHousing}}</td>
                        <td>{{$unit->numberOfFloors}}</td>
                        <td class=" h-full flex justify-center items-center">
                            <!-- إضافة زر الحذف للوحدة السكنية -->
                            <form action="{{ route('collection.delete.unit', ['id' => $unit->id]) }}" class="h-full"
                                method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit"
                                    class="font-bold text-white  bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">حذف</button>
                            </form>
                        </td>
                        <td>{{-- room --}}
                            <button id="bit" type="button" onclick="toggleForm({{$unit->id}})"
                                class="inline-block rounded my-3 bg-green-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out   motion-reduce:transition-none  ">
                                اضافة غرفة <i class="fa-solid fa-plus"></i>
                            </button>
                            <div id="{{$unit->id}}"
                                class="hidden  con-hid fixed top-0 left-0 flex items-center justify-center w-full h-full z-10 bg-gray-500 bg-opacity-50">
                                <form dir="rtl" method="POST" action="{{ route('collection.create.rooms') }}"
                                    class="text-center bg-white p-5 w-max h-max border border-black text-black space-y-5 px-10 mt-32 rounded-lg">
                                    @csrf
                                    {{-- @dd($compaoend->units[]) --}}
                                    <div class="flex flex-col items-baseline gap-3  w-full space-x-4">
                                        <label for="underline_select" class="sr-only"> اختيار الوحدة</label>
                                        <label
                                            class="text-center w-full select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg">{{$unit->nameUnit}}</label>
                                        <input type="hidden" readonly name="unit_id"
                                            class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg"
                                            value={{$unit->id}} />
                                        <label for="underline_select" class="sr-only"> اختيار الوحدة</label>
                                        <select name="numberFloor" id="underline_select"
                                            class="text-center w-full select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg">
                                            {{-- $unit->firstWhere('id', $) --}}
                                            <option selected disabled value="">اختر رقم الطابق
                                            </option>
                                            @for($i = 1; $i <= $unit->numberOfFloors; $i++)
                                                <option value="{{$i}}">{{$i}}
                                                </option>
                                                @endfor
                                        </select>
                                        @error('numberFloor')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                        <label for="underline_select" class="sr-only"> اختيار رقم الطابق</label>
                                        <!-- Region Display -->
                                        <label
                                            class=" text-sm flex flex-row gap-2 justify-between font-medium text-gray-900">
                                            <span class="block mb-2 text-2xl font-bold"> رقم الغرة</span>
                                            <input type="text" name="numberOfRoom"
                                                class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label>
                                        @error('numberOfRoom')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                        <!-- City Display -->
                                        <!-- حقل "السعة" -->
                                        <label class="text-2xl font-bold text-gray-900 flex items-center gap-4">
                                            <span>السعة</span>
                                            <input type="text" name="numberPeople"
                                                class="bg-gray-200 text-center text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label>
                                        @error('numberPeople')
                                        <div class="text-red-500 text-bold text-2xl mt-1">{{ $message }}</div>
                                        @enderror
                                        {{-- <label
                                            class="  text-sm flex flex-row gap-2 justify-between font-medium text-gray-900">
                                            <span class="block mb-2 text-2xl font-bold"> رقم الطابق </span>
                                            <input type="text" name="numberFloor"
                                                class="text-center select-none bg-white text-2xl font-bold text-gray-900 p-2 rounded-lg" />
                                        </label> --}}
                                    </div>
                                    <!-- Submit Button -->
                                    <input
                                        class="font-bold text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 rounded-lg text-sm px-5 py-2.5"
                                        type="submit" value="Create" />
                                    <button type="button" onclick="toggleForm({{$unit->id}})"
                                        class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">Close</button>
                                </form>
                            </div>
                        </td>
                        <td>
                            <!-- Modal toggle -->
                            <button id="bit" type="button" onclick="toggleForm({{$unit->id+5555}})"
                                class="inline-block rounded my-3 bg-green-700 px-6 pb-2 pt-2.5 text-xs font-medium uppercase leading-normal text-white shadow-primary-3 transition duration-150 ease-in-out   motion-reduce:transition-none  ">
                                تفاصيل
                            </button>
                            <!-- Main modal -->
                            <div id="{{$unit->id+5555}}" tabindex="-1" aria-hidden="true"
                                class="hidden overflow-y-auto flex justify-cnter item-cnter w-max bg-white overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center m-auto h-max md:inset-0  rounded shadow-[0px_0px_25px_0px_#364253] max-h-full">
                                <div class="relative p-4 w-full max-w-2xl max-h-full">
                                    <!-- Modal content -->
                                    {{-- < class="relative bg-white rounded-lg shadow dark:bg-gray-700"> --}}
                                        <!-- Modal header -->
                                        <div
                                            class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                            <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                                {{$unit->nameUnit}}
                                            </h3>

                                            <button type="button"
                                                class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                                                data-modal-hide="default-modal">
                                                {{-- <svg class="w-3 h-3" aria-hidden="true"
                                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                    <path stroke="currentColor" stroke-linecap="round"
                                                        stroke-linejoin="round" stroke-width="2"
                                                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                                </svg> --}}
                                                <span class="sr-only">Close modal</span>
                                            </button>
                                        </div>
                                        <!-- Modal body -->
                                        {{-- @dd($unit->id) --}}
                                        <div class="flex justify-center  w-full items-center">
                                            <div class="p-4 md:p-5 max-h-96 overflow-auto " id="{{$unit->id+5555}}">
                                                <div>
                                                    <table
                                                        class=" table  text-white flex flex-row gap-5 text-center justify-stretch">
                                                        <tr class="text-white">
                                                            <th class=" text-white">رقم الغرفه</th>
                                                            <th class=" text-white">السعه</th>
                                                            <th class=" text-white">رقم الطابق</th>
                                                            <th class="text-white"> التسكين</th>
                                                            <th class="text-white"> حذف الغرفة</th>
                                                        </tr>
                                                        @foreach ($unit->rooms as $room )
                                                        <tr>
                                                            <td>{{$room->numberOfRoom}}</td>
                                                            <td>{{$room->numberPeople}}</td>
                                                            <td>{{$room->numberFloor}}</td>
                                                            <td>
                                                                <!-- إضافة زر الحذف للغرفة -->
                                                                <form
                                                                    action="{{ route('collection.delete.room', ['id' => $room->id]) }}"
                                                                    method="POST" style="display:inline;">
                                                                    @csrf
                                                                    @method('DELETE')
                                                                    <button type="submit"
                                                                        class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">حذف</button>
                                                                </form>
                                                            </td>
                                                            <td>
                                                                <a href="{{ route('notification.housingNew', ['id'=>$room->id]) }}">
                                                                <button type="button"
                                                                    class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">

                                                                        تسكين
                                                                    </button>
                                                                </a>
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- Modal footer -->
                                        <div
                                            class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                                            <button type="button" onclick="toggleForm({{$unit->id+5555}})"
                                                class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">أ
                                                غلاق</button>
                                        </div>
                                </div>
                            </div>
            </div>
            </td>
            </tr>
            @endforeach
            <label class="space-y-2" for="">
            </label>
            </table>
        </div>
    </div>
    <!-- إضافة زر الحذف للمجمع -->
    <form action="{{ route('collection.shows.delete', ['id' => $compaoend->id]) }}" method="POST"
        style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="submit"
            class="font-bold text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 rounded-lg text-sm px-5 py-2.5">حذف</button>
    </form>
    @endforeach
</div>

</div>
<script>
    function toggleForm(formId) {
    const formContainer = document.getElementById(formId);
    formContainer.classList.toggle('hidden');
  }
</script>
@endsection
