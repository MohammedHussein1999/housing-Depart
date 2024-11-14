<select id="sersh"
    class=" my-4 text-2xl bg-white font-bold tracking-tight text-gray-900 p-2 rounded-lg focus:outline-none" name=""
    id="">
    <option disabled class="mb-2 text-2xl  bg-whitefont-bold tracking-tight text-gray-900" value="0" selected>All
    </option>
    @foreach ($regions as $region )


    <option class="mb-2  text-2xl font-bold tracking-tight bg-white text-gray-900" value="{{$region->id}}">
        {{$region->region_en}}</option>
    @endforeach
</select>


<div id="cards" class="w-5/6 flex flex-row flex-wrap justify-start m-auto items-start gap-5">
    @foreach ($rr as $city)
    @if($city->coms->isNotEmpty())
    <!-- تحقق إذا كانت هناك بيانات في coms -->
    @foreach ($city->coms as $com)
    @if($com->units->isNotEmpty())
    <!-- تحقق إذا كانت هناك بيانات في units -->
    @foreach ($com->units as $unit)
    @if($unit->rooms->isNotEmpty())
    <!-- تحقق إذا كانت هناك بيانات في rooms -->
    @foreach ($unit->rooms as $room)
    <button onclick="window.location.href='{{ route('collection.shows',  ['id' => $city->id]) }}'"
        class="h-72 hover:scale-105 w-max transform overflow-hidden duration-500 items-center shadow-[5px_5px_5px_-2px_#364253] rounded-lg auto-rows-auto flex flex-col justify- gap-5 flex-nowrap gap-y-2">

        <div class="flex gap-1 h-20 w-full p-3 bg-[#0F7070] items-center">
            <span class="bg-blue-800 w-12 h-12 text-2xl text-center p-2 rounded text-white">
                <i class="fa-regular fa-building"></i>
            </span>
            <span class="mb-2 text-2xl font-bold tracking-tight text-white">{{ $city->city_en ?? '0' }}</span>
        </div>

        <div class="flex flex-row justify-evenly w-full items-center gap-3">
            <div class="flex flex-col gap-3 flex-nowrap items-center justify-evenly">
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    TotalCamps: (<span class="text-blue-600">{{ count($city->coms) > 0 ? count($city->coms) : 0
                        }}</span>)
                </span>
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Housing Units: (<span class="text-blue-600">{{ count($com->units) > 0 ? count($com->units) : 0
                        }}</span>)
                </span>
            </div>
            <div class="flex gap-3 flex-col flex-nowrap items-center justify-evenly">
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Rooms: (<span class="text-blue-600">{{ count($unit->rooms) > 0 ? count($unit->rooms) : 0
                        }}</span>)
                </span>
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Beds: (<span class="text-blue-600">5</span>)
                </span>
            </div>
        </div>
    </button>
    @endforeach
    @else
    <!-- في حالة عدم وجود rooms -->
    <p>No rooms available</p>
    @endif
    @endforeach
    @else
    <!-- في حالة عدم وجود units -->
    <p>No housing units available</p>
    @endif
    @endforeach
    @else
    <!-- في حالة عدم وجود coms -->
    <button onclick="window.location.href='{{ route('collection.shows',  ['id' => $city->id]) }}'"
        class="h-72 hover:scale-105 w-max transform overflow-hidden duration-500 items-center shadow-[5px_5px_5px_-2px_#364253] rounded-lg auto-rows-auto flex flex-col justify- gap-5 flex-nowrap gap-y-2">

        <div class="flex gap-1 h-20 w-full p-3 bg-[#0F7070] items-center">
            <span class="bg-blue-800 w-12 h-12 text-2xl text-center p-2 rounded text-white">
                <i class="fa-regular fa-building"></i>
            </span>
            <span class="mb-2 text-2xl font-bold tracking-tight text-white">{{ $city->city_en ?? '0' }}</span>
        </div>

        <div class="flex flex-row justify-evenly w-full items-center gap-3">
            <div class="flex flex-col gap-3 flex-nowrap items-center justify-evenly">
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    TotalCamps: (<span class="text-blue-600">0</span>)
                </span>
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Housing Units: (<span class="text-blue-600">0
                    </span>)
                </span>
            </div>
            <div class="flex gap-3 flex-col flex-nowrap items-center justify-evenly">
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Rooms: (<span class="text-blue-600">0</span>)
                </span>
                <span class="cursor-pointer text-xl font-bold p-3 py-2 min-w-20 rounded">
                    Total Beds: (<span class="text-blue-600">0</span>)
                </span>
            </div>
        </div>
    </button>
    @endif
    @endforeach
</div>


</div>

<script>
    document.addEventListener("DOMContentLoaded", function() {
    const sersh = document.getElementById('sersh');
    const cards = document.getElementById('cards');
    console.log(sersh);
    if (sersh) { // تحقق مما إذا كان العنصر موجودًا
        sersh.onchange = (e) => {
            console.log(e.target.value);

            fetch("collection/show/" + e.target.value)
                .then((response) => {
                    if (!response.ok) {
                        throw new Error('Network response was not ok'); // تحقق من حالة الاستجابة
                    }
                    return response.json(); // استخدم response.json() لتحويل الاستجابة إلى JSON
                })
                .then((data) => {
                    console.log(data.cities); // معالجة البيانات
                    console.log(e.target.value);

                    // إظهار المدن داخل cards
                    cards.innerHTML = data.cities.map((e) => {
                        // استخدام القيم التي تم إرسالها من السيرفر لتضمين الـ ID و الـ name بشكل صحيح
                        return `<button onclick="window.location.href='collection/show/command/${e.id}'" class="h-72 hover:scale-105  transform overflow-hidden duration-500 items-center shadow-[5px_5px_5px_-2px_#364253] rounded-lg auto-rows-auto flex flex-col justify- gap-5 flex-nowrap gap-y-2">
                            <div class="flex gap-1 h-20 w-full p-3 bg-[#0F7070] items-center">
                                <span class=" bg-blue-800 w-12 h-12 text-2xl text-center p-2 rounded text-white">
                                    <i class="fa-regular fa-building"></i>
                                </span>
                                <span class="mb-2 text-2xl font-bold tracking-tight text-white">${e.city_en}</span>
                            </div>
                            <div class="flex flex-row justify-evenly w-full items-center gap-3">
                                <div class="flex flex-col gap-3 flex-nowrap items-center justify-evenly">
                                    <span class="cursor-pointer  text-xl font-bold p-3 py-2 min-w-20 rounded">Total Camps: (<span class="  text-blue-600">0</span>)</span>
                                    <span class="cursor-pointer  text-xl font-bold p-3 py-2 min-w-20 rounded">Total Housing Units: (<span class="  text-blue-600">0</span>)</span>
                                </div>
                                <div class="flex flex-col gap-3 flex-nowrap items-center justify-evenly">
                                    <span class="cursor-pointer  text-xl font-bold p-3 py-2 min-w-20 rounded">Total Rooms: (<span class="  text-blue-600">0</span>)</span>
                                    <span class="cursor-pointer  text-xl font-bold p-3 py-2 min-w-20 rounded">Total Beds: (<span class="text-blue-600">0</span>)</span>
                                </div>
                            </div>
                        </button>`;
                    }).join(''); // دمج النتائج المترابطة في داخل innerHTML
                })
                .catch((error) => {
                    console.log('There was a problem with the fetch operation:', error); // استخدم catch بشكل صحيح
                });
        };
    }
});

</script>
