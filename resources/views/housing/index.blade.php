@extends('layouts.app')

@section('content')
<div class="EmployeeData dashboard">
    <div class="container ">
        <div class="row">
            <div class="col-lg-4">
                <div class="card shadow mb-4 content_building">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-center p-2"> المنطقه </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="height: 450px; overflow: scroll;">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3" id="basic-text1"><i
                                        class="fas fa-search text-grey" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control inPutFilter my-0 py-1 red-border " dir="rtl" type="text"
                                oninput="filterLocations()" placeholder="ابحث عن المنظقه">
                        </div>
                        <div class="location mt-4">
                            <ul class="menu-Location menu-Location-region">
                                @foreach ( $region as $reg )
                                <li class="item-Location" value="{{$reg->id}}">{{$reg->region_en}}</li>
                                @endforeach
                            </ul>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4 content_building">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-center p-2"> المجمعات السكنيه </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="height: 450px; overflow: scroll;">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3" id="basic-text1"><i
                                        class="fas fa-search text-grey" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control inPutFilter my-0 py-1 red-border " dir="rtl" type="text"
                                oninput="filterLocations()" placeholder="ابحث عن المجمعات السكنيه">
                        </div>
                        <div class="location mt-4">
                            <ul class="menu-Location-collection  menu-Location"></ul>
                        </div>

                    </div>


                </div>
            </div>
            <div class="col-lg-4">
                <div class="card shadow mb-4 content_building">
                    <!-- Card Header - Dropdown -->
                    <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">
                        <h6 class="m-0 font-weight-bold text-center p-2"> الوحدات السكنيه </h6>
                    </div>
                    <!-- Card Body -->
                    <div class="card-body" style="height: 450px; overflow: scroll;">
                        <div class="input-group md-form form-sm form-2 pl-0">
                            <div class="input-group-append">
                                <span class="input-group-text red lighten-3" id="basic-text1"><i
                                        class="fas fa-search text-grey" aria-hidden="true"></i></span>
                            </div>
                            <input class="form-control inPutFilter my-0 py-1 red-border " dir="rtl" type="text"
                                oninput="filterLocations()" placeholder="ابحث عن الوحدات السكنيه">
                        </div>
                        <div class="location mt-4">
                            <ul class="menu-Location menu-Location-unit">

                            </ul>
                        </div>

                    </div>


                </div>
            </div>

            <div class="position-relative">
                <!-- Modal -->
                <div class="modal fade" id="infoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" style="top: 10%; left: -0;">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content  modal-lg">
                            <div class="modal-header">
                                <h5 class="modal-title" id="infoModal">الغرف</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height: 28pc;">
                                <div class="row  d-flex align-items-baseline">
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            <table class="table text-center">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">الغرف</th>
                                                        <th scope="col">الطابق</th>
                                                        <th scope="col">الشقه</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="table-info BodyPartment">

                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="position-relative">

                <div class="modal fade" id="Rooms" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                    aria-hidden="true" style="top: 12%; left: 0;">
                    <div class="modal-dialog  modal-lg" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="EDIT">تعديل بيانات الغرفه</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" style="max-height: 28pc;">
                                <div class="row  d-flex align-items-baseline" dir="rtl">
                                    <div class="card card-body table-container-card">
                                        <table class="table text-center  red-border" dir="rtl">
                                            <thead class="table-primary">
                                                <tr>
                                                    <th scope="col"> رقم الغرفه</th>
                                                    <th scope="col"> رقم الطابق</th>
                                                    <th scope="col">السكان</th>
                                                    <th scope="col">العاملين</th>
                                                </tr>
                                            </thead>
                                            <tbody class="BodyRooms">

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="position-relative">

                <div class="modal" id="people" aria-hidden="true" style="top: 12%; left: 0;">
                    <div class="modal-dialog modal-fullscreen">
                        <div class="modal-content">


                            <div class="modal-header">
                                <button type="button" class="close mx-0" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                                <h5 class="modal-title" id="people">السكان</h5>
                            </div>

                            <div class="modal-body" style="    max-height: 30pc; overflow: scroll;">
                                <div class="row  d-flex align-items-baseline" dir="rtl">
                                    <div class="col-lg-12">
                                        <div class="table-container">
                                            <table class="table text-center">
                                                <thead class="table-primary">
                                                    <tr>
                                                        <th scope="col">الرقم الوظيفي</th>
                                                        <th scope="col">الاسم</th>
                                                        <th scope="col">الجنسية</th>
                                                        <th scope="col">المهنة</th>
                                                        <th scope="col">المنطقة</th>
                                                        <th scope="col"> المشروع</th>

                                                    </tr>
                                                </thead>
                                                <tbody class="table-info BodyWorker">

                                                </tbody>
                                            </table>
                                        </div>
                                    </div>

                                </div>
                            </div>


                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">اغلاق</button>
                            </div>

                        </div>
                    </div>
                </div>




            </div>

        </div>
    </div>
</div>
<script>
    function filterLocations() {
            var input, filter, ul, li, a, i, txtValue;
            input = document.querySelector('.inPutFilter');
            filter = input.value.toUpperCase();
            ul = document.querySelector('.menu-Location');
            li = ul.querySelectorAll('.item-Location');

            for (i = 0; i < li.length; i++) {
                a = li[i]
                txtValue = a.textContent || innerText;
                if (txtValue.toUpperCase().indexOf(filter) > -1) {
                    li[i].style.display = "";
                } else {
                    li[i].style.display = "none";
                }
            }

        }

        const FilterClick = (e) => {
            const allItems = document.querySelectorAll(".item-Location");
            allItems.forEach(item => {
                item.classList.remove("activeList");
            });

            e.target.classList.add("activeList");

            let menuLocation = document.querySelector(".menu-Location-city");
            menuLocation.innerHTML = "";

            for (let i = 0; i < city.length; i++) {
                let itemLocation = document.createElement("li");
                itemLocation.classList.add("item-Location");
                itemLocation.classList.add("Cllection-item");
                itemLocation.innerHTML = city[i];
                menuLocation.append(itemLocation);


                itemLocation.addEventListener("click", CollectionClick);
            }
        };

        const CollectionClick = (e) => {

            const allItems = document.querySelectorAll(".Cllection-item");
            allItems.forEach(item => {
                item.classList.remove("activeList");
            });


            e.target.classList.add("activeList");

            let Collection = ["A1", " A2 ", " A3", "A4 ", " A5"];

            // Clear existing items in the menu
            let menuCollection = document.querySelector(".menu-Location-collection");
            menuCollection.innerHTML = "";

            for (let i = 0; i < Collection.length; i++) {
                let MainCollection = document.createElement("li");
                MainCollection.classList.add("item-Location");
                let itemCollection = document.createElement("span");
                // itemCollection.classList.add("item-Location");
                itemCollection.style.width = "90%";
                itemCollection.innerHTML = Collection[i];
                let infoCollection = document.createElement("i");
                infoCollection.classList.add("fas");
                infoCollection.classList.add("fa-info-circle");
                infoCollection.setAttribute('data-toggle', 'modal');
                infoCollection.setAttribute('data-target', '#infoModal');
                infoCollection.style.width = "10%";
                MainCollection.append(infoCollection)
                MainCollection.append(itemCollection);
                menuCollection.append(MainCollection)
            }
        };


        var locationItems2 = document.querySelectorAll(".item-Location");

        locationItems2.forEach(item => {
            item.addEventListener("click", FilterClick);
        });


        var region = [{
                "region_id": 1,
                "capital_city_id": 3,
                "code": "RD",
                "name_ar": "منطقة الرياض",
                "name_en": "Riyadh",
                "population": 6777146
            },
            {
                "region_id": 2,
                "capital_city_id": 6,
                "code": "MQ",
                "name_ar": "منطقة مكة المكرمة",
                "name_en": "Makkah",
                "population": 6915006
            },
            {
                "region_id": 3,
                "capital_city_id": 14,
                "code": "MN",
                "name_ar": "منطقة المدينة المنورة",
                "name_en": "Madinah",
                "population": 1777933
            },
            {
                "region_id": 4,
                "capital_city_id": 11,
                "code": "QA",
                "name_ar": "منطقة القصيم",
                "name_en": "Qassim",
                "population": 1215858
            },
            {
                "region_id": 5,
                "capital_city_id": 13,
                "code": "SQ",
                "name_ar": "المنطقة الشرقية",
                "name_en": "Eastern Province",
                "population": 4105780
            },
            {
                "region_id": 6,
                "capital_city_id": 15,
                "code": "AS",
                "name_ar": "منطقة عسير",
                "name_en": "Asir",
                "population": 1913392
            },
            {
                "region_id": 7,
                "capital_city_id": 1,
                "code": "TB",
                "name_ar": "منطقة تبوك",
                "name_en": "Tabuk",
                "population": 791535
            },
            {
                "region_id": 8,
                "capital_city_id": 10,
                "code": "HA",
                "name_ar": "منطقة حائل",
                "name_en": "Hail",
                "population": 597144
            },
            {
                "region_id": 9,
                "capital_city_id": 2213,
                "code": "SH",
                "name_ar": "منطقة الحدود الشمالية",
                "name_en": "Northern Borders",
                "population": 320524
            },
            {
                "region_id": 10,
                "capital_city_id": 17,
                "code": "GA",
                "name_ar": "منطقة جازان",
                "name_en": "Jazan",
                "population": 1365110
            },
            {
                "region_id": 11,
                "capital_city_id": 3417,
                "code": "NG",
                "name_ar": "منطقة نجران",
                "name_en": "Najran",
                "population": 505652
            },
            {
                "region_id": 12,
                "capital_city_id": 1542,
                "code": "BA",
                "name_ar": "منطقة الباحة",
                "name_en": "Bahah",
                "population": 411888
            },
            {
                "region_id": 13,
                "capital_city_id": 2237,
                "code": "GO",
                "name_ar": "منطقة الجوف",
                "name_en": "Jawf",
                "population": 440009
            }
        ];


        var collection = @json($region);
        var units = @json($units);
        var apartment = @json($apartment);
        var room = @json($rooms);
        var workers = @json($cittes);




        const colllectClick = (e) => {
            const allItemsLocation = document.querySelectorAll(".item-Location");
            const allItemsunit = document.querySelectorAll(".Cllection-item");
            const allItemsPartement = document.querySelectorAll(".Partement-item");
            allItemsLocation.forEach(item => {
                item.classList.remove("activeList");
            });
            allItemsunit.forEach(item => {
                item.classList.remove("activeList");
            });
            allItemsPartement.forEach(item => {
                item.classList.remove("activeList");
            });
            e.target.classList.add("activeList");

            let menuLocationcollection = document.querySelector(".menu-Location-collection");

            if (!menuLocationcollection) {
                console.error("عنصر .menu-Location-city غير موجود في الصفحة.");
                return;
            }

            menuLocationcollection.innerHTML = "";

            const menuLocationRegion = e.target.value;

            const colllectFiltering = collection.filter(colllect => colllect.region_id == menuLocationRegion);
            colllectFiltering.forEach(colllect => {
                let itemLocation = document.createElement("li");
                itemLocation.classList.add("item-Location");
                itemLocation.classList.add("Cllection-item");
                itemLocation.value = colllect.id;
                itemLocation.textContent = colllect.name;

                menuLocationcollection.appendChild(itemLocation);

                itemLocation.addEventListener("click", unitClick);
            });
        };


        const unitClick = (e) => {
            const allItemsunit = document.querySelectorAll(".Cllection-item");
            const allItemsPartement = document.querySelectorAll(".Partement-item");
            allItemsunit.forEach(item => {
                item.classList.remove("activeList");
            });
            allItemsPartement.forEach(item => {
                item.classList.remove("activeList");
            });

            e.target.classList.add("activeList");

            let menuunit = document.querySelector(".menu-Location-unit");
            menuunit.innerHTML = "";

            const collectionId = e.target.value;

            const UnitFiltering = units.filter(unit => unit.collection_id == collectionId);
            UnitFiltering.forEach(unit => {
                console.log(unit);
                if (unit.buildingType == "كبينة") {
                    let itemUnit = document.createElement("li");
                    itemUnit.classList.add("item-Location");
                    itemUnit.classList.add("Partement-item");
                    itemUnit.setAttribute('data-toggle', 'modal');
                    itemUnit.setAttribute('data-target', '#people');
                    itemUnit.value = unit.id;
                    itemUnit.textContent = unit.name;
                    menuunit.appendChild(itemUnit);
                    itemUnit.addEventListener("click", WorkerClick2);
                } else {
                    let itemUnit = document.createElement("li");
                    itemUnit.classList.add("item-Location");
                    itemUnit.classList.add("Partement-item");
                    itemUnit.setAttribute('data-toggle', 'modal');
                    itemUnit.setAttribute('data-target', '#infoModal');
                    itemUnit.value = unit.id;
                    itemUnit.textContent = unit.name;
                    menuunit.appendChild(itemUnit);
                    itemUnit.addEventListener("click", PartementClick);
                }
            });
        };

        const PartementClick = (e) => {
            const allItems = document.querySelectorAll(".Partement-item");
            allItems.forEach(item => {
                item.classList.remove("activeList");
            });

            e.target.classList.add("activeList");

            let partment = document.querySelector(".BodyPartment");
            partment.innerHTML = "";

            const partmentId = e.target.value;
            const PartmentFiltering = apartment.filter(part => part.apartment_id == partmentId);
            console.log(PartmentFiltering);
            PartmentFiltering.forEach(part => {
                let NewRow = document.createElement("tr");
                let itemPaermentOne = document.createElement("td");
                let itemPaermentTwo = document.createElement("td");
                let itemPaermentThree = document.createElement("td");

                NewRow.classList.add("Room-item");


                let infoIcon = document.createElement("i");
                infoIcon.classList.add("fas");
                infoIcon.classList.add("fa-info-circle");
                infoIcon.setAttribute('data-toggle', 'modal');
                infoIcon.setAttribute('data-target', '#Rooms');
                infoIcon.value = part.id
                itemPaermentOne.textContent = part.name;
                itemPaermentTwo.textContent = part.floor_number;

                itemPaermentThree.classList.add("Room-item");
                itemPaermentThree.appendChild(infoIcon);


                NewRow.appendChild(itemPaermentThree);
                NewRow.appendChild(itemPaermentTwo);
                NewRow.appendChild(itemPaermentOne);

                partment.appendChild(NewRow);

                itemPaermentThree.addEventListener("click", RoomsClick);
            });
        };


        const RoomsClick = (e) => {
            let partment = document.querySelector(".BodyRooms");
            partment.innerHTML = "";

            const roomId = e.target.value;

            const RoomFiltering = room.filter(Room => Room.room_id == roomId);
            RoomFiltering.forEach(room => {
                let NewRow = document.createElement("tr");
                let itemPaermentOne = document.createElement("td");
                let itemPaermentTwo = document.createElement("td");
                let itemPaermentThree = document.createElement("td");
                let itemPaermentFour = document.createElement("td");

                NewRow.classList.add("Room-item");

                let infoIcon = document.createElement("i");
                infoIcon.classList.add("fas");
                infoIcon.classList.add("fa-info-circle");
                infoIcon.setAttribute('data-toggle', 'modal');
                infoIcon.setAttribute('data-target', '#people');
                infoIcon.setAttribute("value", room.id);
                itemPaermentOne.textContent = room.room_name;
                itemPaermentTwo.textContent = room.Floor_number;
                itemPaermentThree.textContent = room.people_number;
                itemPaermentFour.classList.add("Room-item");

                itemPaermentFour.appendChild(infoIcon);

                NewRow.appendChild(itemPaermentOne);
                NewRow.appendChild(itemPaermentTwo);
                NewRow.appendChild(itemPaermentThree);
                NewRow.appendChild(itemPaermentFour);

                partment.appendChild(NewRow);

                infoIcon.addEventListener("click", WorkerClick);
            });
        };

        const WorkerClick = (e) => {
            let Worker = document.querySelector(".BodyWorker");
            Worker.innerHTML = "";

            const workeId = e.target.getAttribute("value");

            const workerFiltering = workers.filter(worker => worker.room_id == workeId);
            workerFiltering.forEach(worker => {
                let NewRow = document.createElement("tr");

                let itemworkerTwo = document.createElement("td");
                itemworkerTwo.textContent = worker.worker_name;

                let itemworkerThree = document.createElement("td");
                itemworkerThree.textContent = worker.worker_national;

                let itemworkerFour = document.createElement("td");
                itemworkerFour.textContent = worker.worker_name_job;

                let itemworkerSix = document.createElement("td");
                itemworkerSix.textContent = worker.worker_site;

                let itemworkerProject = document.createElement("td");
                itemworkerProject.textContent = worker.worker_project;

                let itemworkerNumber = document.createElement("td");
                itemworkerNumber.textContent = worker.worker_number;

                NewRow.appendChild(itemworkerNumber);
                NewRow.appendChild(itemworkerTwo);
                NewRow.appendChild(itemworkerThree);
                NewRow.appendChild(itemworkerFour);
                NewRow.appendChild(itemworkerSix);
                NewRow.appendChild(itemworkerProject);

                Worker.appendChild(NewRow);
            });
        }
        const WorkerClick2 = (e) => {
            let Worker = document.querySelector(".BodyWorker");
            Worker.innerHTML = "";

            const workeId = e.target.getAttribute("value");

            const workerFiltering = workers.filter(worker => worker.unit_id == workeId);
            workerFiltering.forEach(worker => {
                let NewRow = document.createElement("tr");

                let itemworkerTwo = document.createElement("td");
                itemworkerTwo.textContent = worker.worker_name;

                let itemworkerThree = document.createElement("td");
                itemworkerThree.textContent = worker.worker_national;

                let itemworkerFour = document.createElement("td");
                itemworkerFour.textContent = worker.worker_name_job;

                let itemworkerSix = document.createElement("td");
                itemworkerSix.textContent = worker.worker_site;

                let itemworkerProject = document.createElement("td");
                itemworkerProject.textContent = worker.worker_project;

                let itemworkerNumber = document.createElement("td");
                itemworkerNumber.textContent = worker.worker_number;

                NewRow.appendChild(itemworkerNumber);
                NewRow.appendChild(itemworkerTwo);
                NewRow.appendChild(itemworkerThree);
                NewRow.appendChild(itemworkerFour);
                NewRow.appendChild(itemworkerSix);
                NewRow.appendChild(itemworkerProject);

                Worker.appendChild(NewRow);
            });
        }




        const locationItems = document.querySelectorAll(".item-Location");

        locationItems.forEach(item => {
            item.addEventListener("click", colllectClick);
        });
        document.addEventListener("DOMContentLoaded", colllectClick);



        const UnitItems = document.querySelectorAll(".Cllection-item");

        UnitItems.forEach(item => {
            item.addEventListener("click", unitClick);
        });
        document.addEventListener("DOMContentLoaded", unitClick);



        const Partments = document.querySelectorAll(".Partement-item");

        Partments.forEach(item => {
            item.addEventListener("click", unitClick);
        });
        document.addEventListener("DOMContentLoaded", PartementClick);



        const Rooms = document.querySelectorAll(".Room-item");

        Rooms.forEach(item => {
            item.addEventListener("click", unitClick);
        });
        document.addEventListener("DOMContentLoaded", RoomsClick);


        const WOrkers = document.querySelectorAll(".Room-item");

        WOrkers.forEach(item => {
            item.addEventListener("click", unitClick);
        });
        document.addEventListener("DOMContentLoaded", WorkerClick);
</script>
@endsection