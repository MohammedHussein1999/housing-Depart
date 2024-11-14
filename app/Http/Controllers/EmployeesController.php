<?php

namespace App\Http\Controllers;

use App\Models\Employees;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Reader\Xlsx;

class EmployeesController extends Controller
{
    public function index(Request $request)
    {
        // استرجاع البيانات بناءً على البحث
        $query = Employees::query();

        // التحقق إذا كان هناك مدخل في خانة البحث
        if ($request->has('search') && $request->search != '') {
            // تطبيق البحث بناءً على الحقول المختلفة مثل 'name', 'numberOr', 'region', وغيرها
            $query->where('numberOr', 'like', '%' . $request->search . '%')
                ->orWhere('name', 'like', '%' . $request->search . '%')
                ->orWhere('gender', 'like', '%' . $request->search . '%')
                ->orWhere('job', 'like', '%' . $request->search . '%')
                ->orWhere('idNumber', 'like', '%' . $request->search . '%')
                ->orWhere('region', 'like', '%' . $request->search . '%')
                ->orWhere('lection', 'like', '%' . $request->search . '%');
        }

        // جلب البيانات مع التصفح عبر الصفحات
        $data = $query->with('room.unit.compon.city.regions')->paginate(20); // جلب 10 سجلات لكل صفحة

        return view('notifications.tebel', compact('data'));
    }

    public function search(Request $request)
    {
        // الحصول على كلمة البحث من الطلب
        $search = $request->input('search');

        // التحقق من إذا كانت الكلمة فارغة
        if (empty($search)) {
            // إذا كانت كلمة البحث فارغة، نعيد العرض مع رسالة خطأ
            return view('notifications.tebel', ['search' => $search])
                ->with('error', 'يرجى إدخال كلمة البحث');
        }

        // البحث في جدول الموظفين
        $data = Employees::where('numberOr', 'LIKE', "%{$search}%")
            ->orWhere('name', 'LIKE', "%{$search}%")
            ->orWhere('gender', 'LIKE', "%{$search}%")
            ->orWhere('job', 'LIKE', "%{$search}%")
            ->orWhere('idNumber', 'LIKE', "%{$search}%")
            ->orWhere('region', 'LIKE', "%{$search}%")
            ->orWhere('lection', 'LIKE', "%{$search}%")
            ->paginate(20); // تفعيل التصفح للنتائج بحد أقصى 20 عنصر لكل صفحة

        // إعادة العرض مع البيانات التي تم العثور عليها
        return view('notifications.tebel', compact('data', 'search'));
    }

    public function importExcel(Request $request)
    {
        // التحقق من وجود الملف في الطلب
        if ($request->hasFile('xlsx_file')) {
            $file = $request->file('xlsx_file');

            $data = [];
            $reader = new Xlsx();

            // جعل البيانات للقراءة فقط لتحسين الأداء
            $reader->setReadDataOnly(true);

            // تحميل ملف Excel
            $spreadsheet = $reader->load($file);

            DB::beginTransaction(); // بداية عملية قاعدة البيانات

            try {
                // المرور على كل ورقة في الملف (يمكنك الاكتفاء بالورقة الأولى إذا أردت)
                foreach ($spreadsheet->getAllSheets() as $sheet) {
                    foreach ($sheet->getRowIterator() as $index => $row) {



                        $rowData = [];

                        // قراءة بيانات كل خلية في الصف
                        foreach ($row->getCellIterator() as $cell) {
                            if ($cell !== null && $cell->getValue() !== null) {
                                $rowData[] = $cell->getValue();
                            }
                        }

                        // تحقق من أن الصف يحتوي على بيانات كافية قبل الإدخال في قاعدة البيانات
                        if (count($rowData) >= 7) {
                            Employees::create([
                                'numberOr' => $rowData[0] ?? null,
                                'name' => $rowData[1] ?? null,
                                'gender' => $rowData[2] ?? null,
                                'job' => $rowData[3] ?? null,
                                'idNumber' => $rowData[4] ?? null,
                                'region' => $rowData[5] ?? null,
                                'lection' => $rowData[6] ?? null,
                            ]);
                        }
                    }
                }

                DB::commit(); // تأكيد التغييرات في قاعدة البيانات
                return redirect()->back()->with('done', 'تمت العملية بنجاح ');
            } catch (\Exception $e) {
                DB::rollBack(); // استرجاع التغييرات إذا حدث خطأ
                return redirect()->back()->with('error', 'حدث خطأ أثناء استيراد البيانات: ' . $e->getMessage());
            }
        } else {
            return redirect()->back()->with('error', 'لم يتم تحميل أي ملف');
        }
    }
    public function updateRoom(Request $request, $id)
    {
        Employees::find($id)->update(['room_id' => $request->room_id, 'date' => $request->date]);
        // return $request;
        return redirect()->route('test');
    }
    public function destroy($id)
    {
        $employee = Employees::find($id);

        if (!$employee) {

            return redirect()->back()->with('error', 'لم يتم العثور على السجل المطلوب');
        }

        $employee->delete();

        return redirect()->back()->with('success', 'تم حذف السجل بنجاح');
    }
}
