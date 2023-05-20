<?php

namespace App\Http\Controllers;
use App\Mail\JobTestMail;
use App\Http\Controllers\Controller;
use App\Http\Traits\CommonTrait;
use App\Jobs\CalculateDataJob;
use App\Jobs\ExportCsv;
use App\Jobs\TestJob;
use App\Models\Student;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;
use App\TestRepo\MyStudentRepositoryInterface;
use App\Mail\MailableName;
use App\Mail\ExportUsersMail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\File;


class StudentController extends Controller
{
    use CommonTrait;
    protected $studentRepository;

    public function __construct(MyStudentRepositoryInterface $studentRepository)
    {
        $this->studentRepository = $studentRepository;
    }
    public function index()
    {
        $details = [
            'title' => 'Mail from ItSolutionStuff.com',
            'body' => 'This is for testing email using smtp'
        ];
       
        Mail::to('rajdeeprangra@gmail.com')->send(new MailableName($details));
       
        dd("Email is Sent.");
        return response()->json($this->studentRepository->all(),200);
    }

    public function create(Request $request)
    {
     
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "contact"=>$request->contact,
            "pincode"=>$request->pincode,
            "address"=>$request->address,
            "password"=>Hash::make($request->password)
        ];
        return response()->json($this->studentRepository->create($data),200);
    }

    public function update(Request $request,$id)
    {
        
        $data = [
            "name"=>$request->name,
            "email"=>$request->email,
            "contact"=>$request->contact,
            "pincode"=>$request->pincode,
            "address"=>$request->address,
            "password"=>Hash::make($request->password)
        ];

        return response()->json($this->studentRepository->update($id,$data),200);

    }

    public function delete($id)
    {
        return response()->json($this->studentRepository->deleteById($id));
    }

    public function job()
    {
        // $emailJobs = new CalculateDataJob();
        // $this->dispatch($emailJobs);

        CalculateDataJob::dispatch();
        return "success";
        
    }

    public function insertJob()
    {
        
        $request = request();
       
        foreach ($request['users'] as $recordData) {
            $record = new Student;
            $record->name = $recordData['name'];
            $record->email = $recordData['email'];
            $record->password = Hash::make($recordData['password']);
            $record->save();
            $record->assignRole('user');
            $record->givePermissionTo('edit articles', 'create articles');
        }
    
        foreach($request['users'] as $emails)
        {
            $details['email'] =  $emails['email'];
            dispatch(new TestJob($details));
        }

        return "success";
    }
   
    public function updateJob()
    {
          
       $request = request();
       
       foreach($request['data'] as $update)
       {
           $users = Student::where('email',$update['email'])->get();
           
            foreach($users as $user)
            {
                $user->name = $update['name'];
                $user->email = $update['email'];
                $user->password = Hash::make($update['password']);
                $user->save();
            }
           
       }

            foreach($request['data'] as $emails)
            {
                $details['email'] =  $emails['email'];
                dispatch(new CalculateDataJob($details));
            }

       return "success";
    }

    
    public function exportFunction()
    {
        $request = request();

        ExportCsv::dispatch(
            $request?->all()
        );

        return 'Revenue Csv file exporting started';
  
    }

    public function importFunction()
    {
        $csvData = fopen(base_path('storage/app/public/student-16800933331234.csv'),'r');
        $transationRow = true;
   
        // Open and read the contents of the CSV file
       
            while (($data = fgetcsv($csvData, 1000, ',')) !== false) {
                if(! $transationRow){
                    Student::create([
                       
                        'name'=>$data[0],
                        'email'=>$data[1],
                        'password'=>$data[2],
                        'status'=>1,
                        'pincode'=>176110,
                        'address'=>'',
                      
                    ]);
                }
                $transationRow =false;
            }
            fclose($csvData);
            return "successfully Updloaded in database";
    }
}
