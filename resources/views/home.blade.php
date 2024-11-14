@extends('layouts.app')

@section('content')
    <div class="Main_dashboard dashboard">
        <div class="container ">
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-right">
                        <span class="text">لوحة الكامب الجديد طريق الدمام</span>
                        <i class="fa-solid fa-gauge ml-3"></i>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="overview text-center mt-5">
                        <div class="boxes" dir="rtl">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <i class="fa-solid fa-ethernet"></i>
                                        <span class="text">عدد المجمعات</span>
                                        <span class="number">{{ $coll }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <i class="fa-solid fa-building-flag"></i>
                                        <span class="text">عدد الوحدات</span>
                                        <span class="number">{{ $building }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <i class="fa-solid fa-door-open"></i>
                                        <span class="text">عدد الغرف الفارغه</span>
                                        <span class="number">{{ $room }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <i class="fa-solid fa-person"></i>
                                        <span class="text">عدد الساكنين</span>
                                        <span class="number">{{ $housing }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="title text-right">
                        <span class="text">عدد الساكنين بالمناطق</span>
                        <i class="fa-solid fa-gauge ml-3"></i>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="overview text-center mt-5">
                        <div class="boxes" dir="rtl">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <span class="text"> الرياض </span>
                                        <span class="number">{{ $riyadh }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <span class="text"> القصيم</span>
                                        <span class="number">{{ $qassim }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <span class="text"> المدينة المنورة</span>
                                        <span class="number">{{ $medina }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <span class="text">تبوك</span>
                                        <span class="number">{{ $tabouk }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 mt-2">
                    <div class="overview text-center mt-5">
                        <div class="boxes" dir="rtl">
                            <div class="row mb-3">
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <span class="text"> نيوم </span>
                                        <span class="number">{{ $NEOM }}</span>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <span class="text"> الشرقيه</span>
                                        <span class="number">{{ $sharqia }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box2 mb-3">
                                        <span class="text"> عسير</span>
                                        <span class="number">{{ $asir }}</span>
                                    </div>
                                </div>
                                <div class="col-lg-3">
                                    <div class="box box3 mb-3">
                                        <span class="text">جدة</span>
                                        <span class="number">{{ $mecca }}</span>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-5">
                <div class="col-lg-6 ">
                    <div class="card shadow mb-4 content_building">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h6 class="m-0 font-weight-bold"> الاسكان </h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="content_building">
                                <div id="chatOne"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6 ">
                    <div class="card shadow mb-4 content_building">
                        <!-- Card Header - Dropdown -->
                        <div class="card-header py-3 d-flex flex-row align-items-center justify-content-center">

                            <h6 class="m-0 font-weight-bold"> الجنسيات </h6>
                        </div>
                        <!-- Card Body -->
                        <div class="card-body">
                            <div class="content_building">
                                <div id="chatTwo"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.highcharts.com/highcharts.js"></script>
    <script>
        Highcharts.chart('chatOne', {
            chart: {
                type: 'spline'
            },
            title: {
                text: ' المجمعات والوحدات و الغرف',
                align: 'center'
            },

            xAxis: {
                type: 'datetime',
                dateTimeLabelFormats: {
                    // don't display the year
                    month: '%e. %b',
                    year: '%b'
                },
                title: {
                    text: 'Date'
                }
            },
            yAxis: {
                title: {
                    text: 'عدد المجمعات والوحدات والغرف'
                },
                min: 0
            },
            tooltip: {
                headerFormat: '<b>{series.name}</b><br>',
                pointFormat: '{point.x:%e. %b}: {point.y:.2f} m'
            },

            plotOptions: {
                series: {
                    marker: {
                        symbol: 'circle',
                        fillColor: '#FFFFFF',
                        enabled: true,
                        radius: 2.5,
                        lineWidth: 1,
                        lineColor: null
                    }
                }
            },

            colors: ['#6CF', '#39F', '#06C', '#036', '#000'],


            series: [{
                    name: 'المجمعات-2020',
                    data: [
                        [Date.UTC(1970, 9, 24), 0],
                        [Date.UTC(1970, 9, 27), 0.12],
                        [Date.UTC(1970, 9, 30), 0.09],
                        [Date.UTC(1970, 10, 3), 0.13],
                        [Date.UTC(1970, 10, 6), 0.12],
                        [Date.UTC(1970, 10, 9), 0.13],
                        [Date.UTC(1970, 10, 12), 0.13],
                        [Date.UTC(1970, 10, 15), 0.16],
                        [Date.UTC(1970, 10, 18), 0.19],
                        [Date.UTC(1970, 10, 21), 0.25],
                        [Date.UTC(1970, 10, 24), 0.26],
                        [Date.UTC(1970, 10, 27), 0.24],
                        [Date.UTC(1970, 10, 30), 0.25],
                        [Date.UTC(1970, 11, 3), 0.26],
                        [Date.UTC(1970, 11, 6), 0.36],
                        [Date.UTC(1970, 11, 9), 0.43],
                        [Date.UTC(1970, 11, 12), 0.32],
                        [Date.UTC(1970, 11, 15), 0.48],
                        [Date.UTC(1970, 11, 18), 0.5],
                        [Date.UTC(1970, 11, 21), 0.44],
                        [Date.UTC(1970, 11, 24), 0.43],
                        [Date.UTC(1970, 11, 27), 0.45],
                        [Date.UTC(1970, 11, 30), 0.4],
                        [Date.UTC(1971, 0, 3), 0.39],
                        [Date.UTC(1971, 0, 6), 0.56],
                        [Date.UTC(1971, 0, 9), 0.57],
                        [Date.UTC(1971, 0, 12), 0.68],
                        [Date.UTC(1971, 0, 15), 0.93],
                        [Date.UTC(1971, 0, 18), 1.11],
                        [Date.UTC(1971, 0, 21), 1.01],
                        [Date.UTC(1971, 0, 24), 0.99],
                        [Date.UTC(1971, 0, 27), 1.17],
                        [Date.UTC(1971, 0, 30), 1.24],
                        [Date.UTC(1971, 1, 3), 1.41],
                        [Date.UTC(1971, 1, 6), 1.47],
                        [Date.UTC(1971, 1, 9), 1.4],
                        [Date.UTC(1971, 1, 12), 1.92],
                        [Date.UTC(1971, 1, 15), 2.03],
                        [Date.UTC(1971, 1, 18), 2.46],
                        [Date.UTC(1971, 1, 21), 2.53],
                        [Date.UTC(1971, 1, 24), 2.73],
                        [Date.UTC(1971, 1, 27), 2.67],
                        [Date.UTC(1971, 2, 3), 2.65],
                        [Date.UTC(1971, 2, 6), 2.62],
                        [Date.UTC(1971, 2, 9), 2.79],
                        [Date.UTC(1971, 2, 13), 2.93],
                        [Date.UTC(1971, 2, 20), 3.09],
                        [Date.UTC(1971, 2, 27), 2.76],
                        [Date.UTC(1971, 2, 30), 2.73],
                        [Date.UTC(1971, 3, 4), 2.9],
                        [Date.UTC(1971, 3, 9), 2.77],
                        [Date.UTC(1971, 3, 12), 2.78],
                        [Date.UTC(1971, 3, 15), 2.76],
                        [Date.UTC(1971, 3, 18), 2.76],
                        [Date.UTC(1971, 3, 21), 2.7],
                        [Date.UTC(1971, 3, 24), 2.61],
                        [Date.UTC(1971, 3, 27), 2.52],
                        [Date.UTC(1971, 3, 30), 2.53],
                        [Date.UTC(1971, 4, 3), 2.55],
                        [Date.UTC(1971, 4, 6), 2.52],
                        [Date.UTC(1971, 4, 9), 2.44],
                        [Date.UTC(1971, 4, 12), 2.43],
                        [Date.UTC(1971, 4, 15), 2.43],
                        [Date.UTC(1971, 4, 18), 2.48],
                        [Date.UTC(1971, 4, 21), 2.41],
                        [Date.UTC(1971, 4, 24), 2.16],
                        [Date.UTC(1971, 4, 27), 2.01],
                        [Date.UTC(1971, 4, 30), 1.88],
                        [Date.UTC(1971, 5, 2), 1.62],
                        [Date.UTC(1971, 5, 6), 1.43],
                        [Date.UTC(1971, 5, 9), 1.3],
                        [Date.UTC(1971, 5, 12), 1.11],
                        [Date.UTC(1971, 5, 15), 0.84],
                        [Date.UTC(1971, 5, 18), 0.54],
                        [Date.UTC(1971, 5, 21), 0.19],
                        [Date.UTC(1971, 5, 23), 0]
                    ]
                },
                {
                    name: 'الوحدات -2020',
                    data: [
                        [Date.UTC(1970, 10, 14), 0],
                        [Date.UTC(1970, 11, 6), 0.35],
                        [Date.UTC(1970, 11, 13), 0.35],
                        [Date.UTC(1970, 11, 20), 0.33],
                        [Date.UTC(1970, 11, 30), 0.53],
                        [Date.UTC(1971, 0, 13), 0.62],
                        [Date.UTC(1971, 0, 20), 0.6],
                        [Date.UTC(1971, 1, 2), 0.69],
                        [Date.UTC(1971, 1, 18), 0.67],
                        [Date.UTC(1971, 1, 21), 0.65],
                        [Date.UTC(1971, 1, 24), 0.66],
                        [Date.UTC(1971, 1, 27), 0.66],
                        [Date.UTC(1971, 2, 3), 0.61],
                        [Date.UTC(1971, 2, 6), 0.6],
                        [Date.UTC(1971, 2, 9), 0.69],
                        [Date.UTC(1971, 2, 12), 0.66],
                        [Date.UTC(1971, 2, 15), 0.75],
                        [Date.UTC(1971, 2, 18), 0.76],
                        [Date.UTC(1971, 2, 21), 0.75],
                        [Date.UTC(1971, 2, 24), 0.69],
                        [Date.UTC(1971, 2, 27), 0.82],
                        [Date.UTC(1971, 2, 30), 0.86],
                        [Date.UTC(1971, 3, 3), 0.81],
                        [Date.UTC(1971, 3, 6), 1],
                        [Date.UTC(1971, 3, 9), 1.15],
                        [Date.UTC(1971, 3, 10), 1.35],
                        [Date.UTC(1971, 3, 12), 1.26],
                        [Date.UTC(1971, 3, 15), 1.18],
                        [Date.UTC(1971, 3, 18), 1.14],
                        [Date.UTC(1971, 3, 21), 1.04],
                        [Date.UTC(1971, 3, 24), 1.06],
                        [Date.UTC(1971, 3, 27), 1.05],
                        [Date.UTC(1971, 3, 30), 1.03],
                        [Date.UTC(1971, 4, 3), 1.01],
                        [Date.UTC(1971, 4, 6), 0.98],
                        [Date.UTC(1971, 4, 9), 0.94],
                        [Date.UTC(1971, 4, 12), 0.8],
                        [Date.UTC(1971, 4, 15), 0.61],
                        [Date.UTC(1971, 4, 18), 0.43],
                        [Date.UTC(1971, 4, 21), 0.29],
                        [Date.UTC(1971, 4, 24), 0.1],
                        [Date.UTC(1971, 4, 26), 0]
                    ]
                },
                {
                    name: 'الغرف -2020',
                    data: [
                        [Date.UTC(1970, 10, 5), 0],
                        [Date.UTC(1970, 10, 12), 0.1],
                        [Date.UTC(1970, 10, 21), 0.15],
                        [Date.UTC(1970, 10, 22), 0.19],
                        [Date.UTC(1970, 10, 27), 0.17],
                        [Date.UTC(1970, 10, 30), 0.27],
                        [Date.UTC(1970, 11, 2), 0.25],
                        [Date.UTC(1970, 11, 4), 0.27],
                        [Date.UTC(1970, 11, 5), 0.26],
                        [Date.UTC(1970, 11, 6), 0.25],
                        [Date.UTC(1970, 11, 7), 0.26],
                        [Date.UTC(1970, 11, 8), 0.26],
                        [Date.UTC(1970, 11, 9), 0.25],
                        [Date.UTC(1970, 11, 10), 0.25],
                        [Date.UTC(1970, 11, 11), 0.25],
                        [Date.UTC(1970, 11, 12), 0.26],
                        [Date.UTC(1970, 11, 22), 0.22],
                        [Date.UTC(1970, 11, 23), 0.22],
                        [Date.UTC(1970, 11, 24), 0.22],
                        [Date.UTC(1970, 11, 25), 0.24],
                        [Date.UTC(1970, 11, 26), 0.24],
                        [Date.UTC(1970, 11, 27), 0.24],
                        [Date.UTC(1970, 11, 28), 0.24],
                        [Date.UTC(1970, 11, 29), 0.24],
                        [Date.UTC(1970, 11, 30), 0.22],
                        [Date.UTC(1970, 11, 31), 0.18],
                        [Date.UTC(1971, 0, 1), 0.17],
                        [Date.UTC(1971, 0, 2), 0.23],
                        [Date.UTC(1971, 0, 9), 0.5],
                        [Date.UTC(1971, 0, 10), 0.5],
                        [Date.UTC(1971, 0, 11), 0.53],
                        [Date.UTC(1971, 0, 12), 0.48],
                        [Date.UTC(1971, 0, 13), 0.4],
                        [Date.UTC(1971, 0, 17), 0.36],
                        [Date.UTC(1971, 0, 22), 0.69],
                        [Date.UTC(1971, 0, 23), 0.62],
                        [Date.UTC(1971, 0, 29), 0.72],
                        [Date.UTC(1971, 1, 2), 0.95],
                        [Date.UTC(1971, 1, 10), 1.73],
                        [Date.UTC(1971, 1, 15), 1.76],
                        [Date.UTC(1971, 1, 26), 2.18],
                        [Date.UTC(1971, 2, 2), 2.22],
                        [Date.UTC(1971, 2, 6), 2.13],
                        [Date.UTC(1971, 2, 8), 2.11],
                        [Date.UTC(1971, 2, 9), 2.12],
                        [Date.UTC(1971, 2, 10), 2.11],
                        [Date.UTC(1971, 2, 11), 2.09],
                        [Date.UTC(1971, 2, 12), 2.08],
                        [Date.UTC(1971, 2, 13), 2.08],
                        [Date.UTC(1971, 2, 14), 2.07],
                        [Date.UTC(1971, 2, 15), 2.08],
                        [Date.UTC(1971, 2, 17), 2.12],
                        [Date.UTC(1971, 2, 18), 2.19],
                        [Date.UTC(1971, 2, 21), 2.11],
                        [Date.UTC(1971, 2, 24), 2.1],
                        [Date.UTC(1971, 2, 27), 1.89],
                        [Date.UTC(1971, 2, 30), 1.92],
                        [Date.UTC(1971, 3, 3), 1.9],
                        [Date.UTC(1971, 3, 6), 1.95],
                        [Date.UTC(1971, 3, 9), 1.94],
                        [Date.UTC(1971, 3, 12), 2],
                        [Date.UTC(1971, 3, 15), 1.9],
                        [Date.UTC(1971, 3, 18), 1.84],
                        [Date.UTC(1971, 3, 21), 1.75],
                        [Date.UTC(1971, 3, 24), 1.69],
                        [Date.UTC(1971, 3, 27), 1.64],
                        [Date.UTC(1971, 3, 30), 1.64],
                        [Date.UTC(1971, 4, 3), 1.58],
                        [Date.UTC(1971, 4, 6), 1.52],
                        [Date.UTC(1971, 4, 9), 1.43],
                        [Date.UTC(1971, 4, 12), 1.42],
                        [Date.UTC(1971, 4, 15), 1.37],
                        [Date.UTC(1971, 4, 18), 1.26],
                        [Date.UTC(1971, 4, 21), 1.11],
                        [Date.UTC(1971, 4, 24), 0.92],
                        [Date.UTC(1971, 4, 27), 0.75],
                        [Date.UTC(1971, 4, 30), 0.55],
                        [Date.UTC(1971, 5, 3), 0.35],
                        [Date.UTC(1971, 5, 6), 0.21],
                        [Date.UTC(1971, 5, 9), 0]
                    ]
                }
            ]
        });



        //  chart at

        Highcharts.chart('chatTwo', {
            chart: {
                type: 'spline'
            },
            title: {
                text: 'اكثر جنسيه ساكنه '
            },
            xAxis: {
                categories: ['', "American",
                    "British",
                    "Canadian",
                    "Chinese",
                    "French",
                    "German",
                    "Indian",
                    "Italian",
                    "Japanese",
                    "Mexican",
                ]
            },
            yAxis: {
                title: {
                    text: 'الساكنين'
                },
                labels: {
                    format: '{value}°'
                }
            },
            tooltip: {
                crosshairs: true,
                shared: true
            },
            plotOptions: {
                spline: {
                    marker: {
                        radius: 4,
                        lineColor: '#666666',
                        lineWidth: 1
                    }
                }
            },
            series: [{
                name: '',
                marker: {
                    symbol: 'square'
                },
                data: [5.2, 5.7, 8.7, 13.9, 18.2, 21.4, 25.0, {
                    y: 26.4,
                    marker: {
                        symbol: 'url(https://www.highcharts.com/samples/graphics/sun.png)'
                    },
                    accessibility: {
                        description: 'Sunny symbol, this is the warmest point in the chart.'
                    }
                }, 22.8, 17.5, 12.1, 7.6]

            }, {
                name: '',
                marker: {
                    symbol: 'diamond'
                },
                data: [{
                    y: 1.5,

                    accessibility: {
                        description: 'Snowy symbol, this is the coldest point in the chart.'
                    }
                }, 1.6, 3.3, 5.9, 10.5, 13.5, 14.5, 14.4, 11.5, 8.7, 4.7, 2.6]
            }]
        });

    </script>
@endsection
