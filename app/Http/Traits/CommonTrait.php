<?php 
namespace App\Http\Traits;
use Illuminate\Http\Response;
use App\Models\Student;

trait CommonTrait{
    public function export_revenue()
    {
        $request = request();
        $students = Student::all();
        $headers = [
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=users.csv",
        ];
        $callback = function() use ($students) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['ID', 'Name', 'Email']);

            foreach ($students as $user) {
                fputcsv($file, [$user->id, $user->name, $user->email]);
            }

            fclose($file);
        };

        return Response::stream($callback, 200, $headers);

    }
}