<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Housing</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('img/شبه_الجزيرة_العربية_أيقونة-removebg-preview (1).png') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/bootstrap-select.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link rel="stylesheet" href=" https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link rel="stylesheet" href="{{ asset('css/font-awesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
        integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Alexandria:wght@500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/select2.min.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />

    <script src="https://cdn.tailwindcss.com"></script>

</head>

<body>
    <script src="{{ asset('js/jquery-3.7.1.min.js') }}"></script>
    @auth

    <!-- header -->
    <header class="header" id="two">
        <div class="header-container">
            <nav class="navbar nav-board">

                <ul class="navbar-links align-items-center" id="navbarLinks">
                    <li class="nav-item  main-board">
                        <a href="/">
                            <img src="{{ asset('img/profile.png') }}" class="responsive-img ">
                        </a>
                    </li>
                    <li class="nav-item">
                        {{Auth::user()->name}}
                    </li>
                    @if (Auth::user()->type == 1)
                    <li class="nav-item main-board">
                        <div class="header__top__right__language d-inline ">
                            <a class="nav-link"><i class="fa-solid fa-gear sitting"></i></a>
                            <span class="arrow_carrot-down"></span>
                            <ul>
                                <li><a href="{{ route('setting.index') }}">الاعدادات</a></li>
                                <li><a href="{{ route('register') }}">المستخدمين</a></li>
                                <li><a href="{{ route('register.index') }}">صلاحيات المستخدمين</a></li>
                            </ul>
                        </div>
                    </li>
                    @endif
                    <li class="nav-item main-board">
                        <div class="header__top__right__language d-inline ">
                            <a class="nav-link"><i class="fa-solid fa-regular fa-bell"></i></a>
                            <span class="arrow_carrot-down"></span>
                            <ul class="text-nowrap">
                                @if (Auth::user()->type != 3)
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="badge text-bg-success">{{ $coll }}</span><a
                                        href="{{ route('notification.coll') }}"> طلبات المجمعات</a></li>
                                @endif
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="badge text-bg-success">{{ $building }}</span><a
                                        href="{{ route('notification.building') }}"> طلبات الوحدات</a></li>
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="badge text-bg-success">{{ $housing }}</span><a
                                        href="{{ route('notification.housing') }}"> طلبات التسكين</a></li>
                                <li class="d-flex justify-content-between align-items-center"><span
                                        class="badge text-bg-success">{{ $out }}</span><a
                                        href="{{ route('notification.out') }}"> طلبات الاخلاء</a></li>
                            </ul>
                        </div>
                    </li>
                    <li class="nav-item main-board d-none">
                        <a class="nav-link" href="#"><i class="fa-solid fa-headset"></i></a>
                    </li>
                </ul>
                <a class="navbar-logo navbar-logo-board d-flex align-items-center mr-3">
                    <div class=" navbar-toggle-board ml-4" id="navbarToggle">
                        <div class="bar"></div>
                        <div class="bar"></div>
                        <div class="bar"></div>
                    </div>
                </a>
            </nav>

        </div>
    </header>
    {{-- aside bar --}}
    <div class="aside_bar">
        <div class="menu-items">
            <ul class="nav-links">
                <li class="active"><a href="/" class="active">
                        <span class="link-name Dahsboard active ">الرئيسية</span>
                        <i class="fa-solid fa-house"></i>
                    </a></li>
                <li class="active"><a @if (Auth::user()->type != 3) href="{{ route('collection.create') }}" @else
                        href="{{ route('building.create') }}" @endif
                        style=" margin-left: -60px; " class="active">
                        <span class="link-name Dahsboard active ml-2 ">المجمعات السكنية </span>
                        <i class="fa-solid fa-house-user"></i>
                    </a></li>
                <li><a href="{{ route('housing.create') }}">
                        <span class="link-name Dahsboard active "> التسكين </span>
                        <i class="fa-solid fa-map-location"></i>
                    </a></li>
                <li><a href="{{ route('housing.index') }}" style="margin-left: -40px; ">
                        <span class="link-name ContentLi">عرض التسكين</span>
                        <i class="fa-solid fa-house-user"></i>
                    </a></li>
                <li><a href="{{ route('collection.index') }}" style="    margin-left: -40px; ">
                        <span class="link-name ContentLi">سجل الاسكان</span>
                        <i class="fa-solid fa-file-waveform"></i>
                    </a></li>
                <li><a href="{{ route('test') }}" style="    margin-left: -40px; ">
                        <span class="link-name ContentLi"> جدول الموظفين</span>
                        <i class="fa-solid fa-file-waveform"></i>
                    </a></li>
                <li><a href="{{ route('out.create') }}">
                        <span class="link-name ContentLi">اخلاء السكن</span>
                        <i class="fa-solid fa-person-shelter"></i>
                    </a></li>
                <li><a href="{{ route('mistake.create') }}">
                        <span class="link-name ContentLi">المخالفات</span>
                        <i class="fa-solid fa-gavel"></i>
                    </a></li>
                <li><a href="{{ route('data.index') }}">
                        <span class="link-name ContentLi">العاملين</span>
                        <i class="fa-solid fa-users"></i>
                    </a></li>
                <li><span class="position-relative MainReports text-right">
                        <i class="fa-solid fa-caret-down hideReport"></i>
                        <i class="fa-solid fa-caret-right ShowReport"></i>
                        <span class="link-name Reports ">التقارير</span>
                        <i class="fa-regular fa-clipboard"></i>
                    </span>
                    <div class="dropdown dropdown_Report ">
                        <span><a href="{{ route('report.full') }}"> تقرير شامل</a></span>
                        <span><a href="{{ route('report.out') }}"> تقرير اخلاء </a></span>
                        <span><a href="{{ route('report.nationality') }}"> تقرير حسب
                                الجنسية</a></span>
                        <span><a href="{{ route('report.location') }}">تقرير حسب المشروع </a></span>
                        <span><a href="{{ route('report.room') }}"> تقرير بالغرف الفارغة </a></span>
                    </div>
                </li>
                <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                    document.getElementById('logout-form').submit();">
                        <i class="fa-solid fa-arrow-right-to-bracket"></i>
                        <span class="link-name">تسجيل خروج</span>
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>
    @endauth

    {{-- content --}}
    <main class="page-wrapper" style="position: relative; margin-top:120px;">
        @yield('content')
    </main>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/jquery-ui.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/CityAndRegion.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src=" https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/select2.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>
