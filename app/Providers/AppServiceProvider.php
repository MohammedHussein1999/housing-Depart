<?php

namespace App\Providers;

use App\Models\Room;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('path.public', function () {
            return base_path('public_html');
        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {

        view()->composer('layouts.app', function ($view) {
                $coll = $building = $housing = $out = null; // تعيين قيم افتراضية

                // تحقق من تسجيل الدخول
                if (auth()->check()) {
                    $userType = auth()->user()->type;
                    $phpArray = json_decode(auth()->user()->attach, true);
                    $phpArray = is_array($phpArray) ? $phpArray : [];

                    // استنادًا إلى نوع المستخدم
                    switch ($userType) {
                        case 1: // المستخدم من النوع 1
                            $coll = DB::table('collections')->where('approve', 1)->count();
                            $building = DB::table('buildings')->where('approve', 2)->count();
                            $housing = DB::table('housings')->where('approve', 2)->count();
                            $out = DB::table('outs')->where('approve', 2)->count();
                            break;

                        case 2: // المستخدم من النوع 2
                            $building = $coll = $housing = $out = 0; // إعادة تعيين القيم
                            foreach ($phpArray as $regionId) {
                                $region = DB::table('region')->where('id', $regionId)->first();
                                if ($region) {
                                    $coll += DB::table('collections')->where('region', $regionId)->where('approve', 0)->count();
                                    $building += DB::table('buildings')->where('region', $regionId)->where('approve', 1)->count();
                                    $housing += DB::table('housings')->where('region', $regionId)->where('approve', 1)->count();
                                    $out += DB::table('outs')->where('region', $region->name)->where('approve', 1)->count();
                                }
                            }
                            break;

                        case 3: // المستخدم من النوع 3
                            $building = $housing = $out = 0; // إعادة تعيين القيم
                            foreach ($phpArray as $collectionId) {
                                $building += DB::table('buildings')->where('collectionId', $collectionId)->where('approve', 0)->count();
                                $housing += DB::table('housings')->where('collectionId', $collectionId)->where('approve', 0)->count();
                                $collection = DB::table('collections')->where('id', $collectionId)->first();
                                if ($collection) {
                                    $out += DB::table('outs')->where('collection', $collection->name)->where('approve', 0)->count();
                                }
                            }
                            break;
                    }
                }

                // تمرير البيانات إلى العرض
                $view->with(compact('coll', 'building', 'housing', 'out'));
            });

        // View Composer لـ 'home'

        view()->composer('home', function ($view) {
            $coll = DB::table('collections')->count();
            $building = DB::table('buildings')->count();
            $housing = DB::table('housings')->count();
            $rooms = Room::all();
            $room = 0;

            foreach ($rooms as $item) {
                $currentHousingRoom = DB::table('housings')->where('approve', 3)->where('roomId', $item->id)->count();
                if ($currentHousingRoom == 0) {
                    $room++;
                }
            }

            // حساب عدد الوحدات في المناطق المختلفة
            $regionsCount = [
                'riyadh' => DB::table('housings')->where('region', 1)->count(),
                'qassim' => DB::table('housings')->where('region', 4)->count(),
                'tabouk' => DB::table('housings')->where('region', 7)->count(),
                'sharqia' => DB::table('housings')->where('region', 5)->count(),
                'asir' => DB::table('housings')->where('region', 6)->count(),
                'mecca' => DB::table('housings')->where('region', 2)->count(),
                'NEOM' => DB::table('housings')->where('region', 9)->count(),
                'medina' => DB::table('housings')->where('region', 3)->count(),
            ];

            // تمرير البيانات إلى العرض
            $view->with(array_merge(compact('coll', 'building', 'housing', 'room'), $regionsCount));
        });
    }
}
