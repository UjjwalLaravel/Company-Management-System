<?php
namespace App\Http\Controllers;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\JobDescription;
use App\Users;
use App\HrCandidate;
use App\HrJobApplication;
use App\Company;
use App\ListIndustry;
use App\ListFunctionalArea;
use App\RoleCategory;
use App\MasterRole;
use App\ListJobLocation;
use DB;
use Illuminate\Support\Facades\Auth;

class JobDescriptionController extends Controller {
    public function __construct() {
        $this->jd = new JobDescription;
    }

    public function get_projects(){
            $datap = \DB::table('master_zoho_project')->get();
            $data['locations'] = [];
            $data['client_name'] = [];
            foreach($datap as $d){
                array_push($data['locations'], $d->location.', '.$d->state);
                array_push($data['client_name'], $d->client_name);
                array_push($data['client_name'], $d->customer_name);

                }
            
            $arr_location = array_unique($data['locations']);
            $arr_client = array_unique($data['client_name']);
            dd($arr_location);
            return view('projects_data', compact('arr_location', 'arr_client'));
    }

    public function index(Request $request) {
        $jobs = JobDescription::where('status', 2)->orderBy('id', 'DESC')->paginate(18);
        //$jobs = JobDescription::all();
        $role_cat = ListIndustry::All();
        $locations = ListJobLocation::All();
        //$acc = $this->jd->get_data();
        return view('home', compact('jobs', 'role_cat', 'locations'));
    }

    public function job_vacancy($id) {
        $base_64 = $id . str_repeat('=', strlen($id) % 4);
        $ids = base64_decode($base_64);
        exit('sdfsdgdf');
    }

    public function fetch_job_id($jd, $id) {
        $job_details = JobDescription::where('id', $id)->get(); 
        if (count($job_details) > 0) {
            $hr_id = $job_details[0]['hr_id'];
            $hr_data = \DB::table('recruiter_users')->where('id', $hr_id)->get();
            $c_w_id = $job_details[0]['company'];
            $cwebsite = Company::where('id', $c_w_id)->get();
            $c_w_logo = $cwebsite[0]['logo'];
            $related = $job_details[0]->role_type;
            $relocate = $job_details[0]->location;
            if (Auth::check()) {
                $apply = HrJobApplication::where('candidate_id', Auth::user()->id)->where('vacancy_id', $id)->count();
            } else {
                $apply = 0;
            }
            $relatedjob = JobDescription::where('role_type', $related)->where('id', '!=',$id)->where('location', 'like', '%' . $relocate . '%')->where('status', 2)->get();
            $relatedjobs = json_decode(json_encode($relatedjob), true);
            return view('job1', compact('job_details', 'relatedjobs', 'apply', 'cwebsite', 'hr_data', 'c_w_logo'));
            } else {
                return view('error_job1');
            }
    }

    public function apply_job($job, $id) {
        if (!Auth::check()) {
            return redirect()->to('signin');
        } else {
            $user_id = Auth::user()->id;
            dd($user_id); 
            $user_email = Auth::user()->email;
            $hrcandidate = HrCandidate::updateOrCreate(['user_id' => $user_id,  'phone_number' => Auth::user()->contact, 'current_location' => Auth::user()->city]);
            $data = HrJobApplication::create(
                ['vacancy_id'=>$id,
                'candidate_id'=>$user_id]
                );
            // $data->vacancy_id = $id;
            // $data->candidate_id = $user_id;
            // $save = $data->save();
            $session_id = session()->getId();
            $app_history = \DB::table('recruiter_applications_status_history')->insert([
                'candidate_id' => $user_id,
                'vacancy_id' => $id,
                'status' =>0,
                'application_id'=>$data->id,
                'created_by' => $user_id,
                'created_at'=>Carbon::today()->toDateTimeString()
            ]);
            $name=JobDescription::where('id',$id)->get();
            $from = "hr@technitab.com";
            $subject="Successfully applied job";
//            $CC = 'soren.technitab@gmail.com';
            $CC = '';
            $BCC = '';
            $to = Auth::user()->email;
//            $to = 'audheshkr123@gmail.com';
            $from_name = 'Hunarlab.com';
            $nmessage = "Your are successfully applied to job ".$name[0]->requirement_name.' please visit https://hunarlab.com.jobs/';
            // header
            $header = "From: " . $from_name . " <" . $from . ">\r\n";
            $header .= "Cc: " . $CC . "\r\n";
            $header .= "Bcc: " . $BCC . "\r\n";
            // $header .= "Reply-To: ".$replyto."\\n";
            $header .= "MIME-Version: 1.0\r\n";
            $header .= "Content-Type: text/html; charset=iso-8859-1\r\n\r\n";
            $nmessage .= $nmessage . "\r\n\r\n";
            mail($to, $subject, $nmessage, $header);
            if ($app_history) {
                return redirect()->back()->with('success', 'You have successfully applied this job!');
            } else {
                echo "not";
            }
        }
    }





    public function listjob() {
        if (Auth::check()) {
            if (Auth::user()->role_type_id == 1) {
                $initiate = JobDescription::where('status', '1')->get();
                $publish = JobDescription::where('status', '2')->get();
                $closed = JobDescription::where('status', '3')->get();
                return view('list_job', compact('initiate', 'publish', 'closed'));
            } else {
                return redirect()->to('/');
            }
        } else {
            return redirect()->to('login');
        }
    }







    public function apprrove_job(Request $request) {







        JobDescription::where('id', $request->id)->update(['status' => 2]);



        return "success";



    }







    public function viewjob($desig, $entrycompany, $id) {







        $jobdata = JobDescription::where('id', $id)->get();







        return view('adminjob', compact('jobdata'));



    }







    public function editjob($id) {







        $editdata = JobDescription::where('id', $id)->get();







        $com_id = $editdata[0]['company'];







        $company_data = Company::get()->all();



        $list_industry = ListIndustry::get()->all();



        $list_functional_area = ListFunctionalArea::get()->all();



        $role_category = RoleCategory::get()->all();



        $master_role = MasterRole::get()->all();







        return view('editjob', compact('editdata', 'company', 'company_data', 'list_industry', 'list_functional_area', 'role_category', 'master_role', 'id'));



    }







    public function update_job(Request $request) {



        // JobDescription::where('id',$request->id)->update(['status'=>2]);



        $w = $request->ex_from;



        $w1 = $request->ex_to;



        $workexp = $w . "-" . $w1;







        $b = $request->budget_from;



        $b1 = $request->budget_to;



        $bud = $b . "-" . $b1;















        $update = JobDescription::where('id', $request->id)->update(['job_post_headline' => $request->job_post_headline, 'designation' => $request->designation, 'heading_details' => $request->job_brief, 'employement_type' => $request->employement_type, 'job_description' => $request->job_description, 'job_responsibilities' => $request->job_responsibilities, 'preferable_candidate' => $request->preferable_candidate, 'skills_required' => $request->countries, 'experience' => $workexp, 'budget' => $bud, 'location' => $request->location, 'industry_type' => $request->industry_type, 'functional_area' => $request->functional_area, 'role_type' => $request->role_type, 'role_category' => $request->role_category, 'education' => $request->educationee, 'no_of_postion' => $request->no_of_postion, 'timeline' => $request->timeline, 'company_overview' => $request->company_profile]);



    }







    public function close_job(Request $request) {



        JobDescription::where('id', $request->id)->update(['status' => 3]);



        return "success";



    }







    public function rollback(Request $request) {







        JobDescription::where('id', $request->id)->update(['status' => 2]);



        return "success";



    }







//    public function company_all_jobs($id) {



//



//        $company_info = Company::where('id', $id)->get();



//



//        $alljobs = JobDescription::where('company', $id)->where('status', 2)->get()->all();



//



//        return view('companyalljobs', compact('alljobs', 'company_info'));



//    }







    public function company_all_jobs($id) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();







        $company_info = Company::where('id', $id)->get();







        $alljobs = JobDescription::where('company', $id)->where('status', 2)->Paginate(10);  



        return view('companyalljobs', compact('alljobs', 'company_info','locations'));



    }







    public function company_iframe_jobs($id) {



        $alljobs = JobDescription::where('company', $id)->where('status', 2)->Paginate(10);  



        return view('company_iframe', compact('alljobs'));



   }







   public function user_iframe_jobs($id){



       $alljobs = \DB::table('recruiter_assign_vacancies')->select('recruiter_assign_vacancies.*','recruiter_vacancies.*')



       ->join('recruiter_vacancies','recruiter_vacancies.id','=','recruiter_assign_vacancies.vacancy_id')



       ->where('recruiter_assign_vacancies.user_id',$id)->Paginate(10);



    // $alljobs = JobDescription::where('hr_id',$id)->where('status',2)->Paginate(10);



    return view('user_iframe',compact('alljobs'));



   }







    public function desig_all_jobs($id) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



       



        //echo $desigTypeN;



        $desigTypeN = str_replace("-", " ", $id);



        $alljobs = JobDescription::where('designation', $desigTypeN)->where('status', 2)->Paginate(10);











        return view('companyalljobs', compact('alljobs','locations'));



    }







//    public function skill_all_jobs($skill) {



//



//



//        $skilldata = JobDescription::where('skills_required', 'like', '%' . $skill . '%')->where('status', 2)->get();



//        $alljobs = $skilldata;



//



//        return view('companyalljobs', compact('alljobs'));



//    }







    public function skill_all_jobs($skilled) {
        $skillss=str_replace("-",' ',$skilled);
        $skill=str_replace("-"," ",$skillss);
        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();
        $skilldata = JobDescription::where('skills_required', 'like', '%' . $skill . '%')->where('status', 2)->Paginate(10);
        $jobs = $skilldata;
        return view('filter', compact('jobs','locations', 'skilled'));
    }



    



    public function searched(Request $request) { 
        $role_cat = ListIndustry::All();
        $industry = $request->search_category;
        $location = $request->serch_area;
        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();
        $skill_company = $request->skill_company;
        $industries = ListIndustry::All();
        if(is_null($location) && is_null($skill_company) && is_null($industry)){
            $jobs = JobDescription::all();
        }else{
            $searchQuery = JobDescription::query();
            if(!empty($industry)){
                $searchQuery->where('industry_type', $request->search_category);
            }
            if(!empty($location)){
                $searchQuery->where('location', 'like', '%' . $request->serch_area . '%');
            }
            if(!empty($skill_company)){
                $searchQuery->where('skills_required', 'like', '%'.$request->skill_company.'%');
            }
            if(!empty($skill_company)){
                $searchQuery->where('company_name', 'like', '%'.$request->skill_company.'%');
            }
        $jobs = $searchQuery->get();
        }
            return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));
    }







    public function searched_data($a) {



        $location = explode($a, "?");







        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();







        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $jobs = JobDescription::where('location', 'like', '%' . $a . '%')->paginate(10);







        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries', 'a'));



    }







    public function searched_salary($a) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::where('budget', 'like', '%' . $a . '%')->paginate(10);



        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));



    }







    public function searched_type($a) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::where('employement_type', $a)->paginate(10);







        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));



    }







    public function searched_exp($a) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::where('experience', 'like', '%' . $a . '%')->paginate(10);







        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));



    }







    public function searched_indus($a) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::where('industry_type', 'like', '%' . $a . '%')->paginate(10);



        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));



    }







    public function searched_edu($a) {



        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::where('education', 'like', '%' . $a . '%')->paginate(10);







        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries'));



    }



    public function searchquerytest(Request $request){
            $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->distinct()->get();
            $role_cat = ListIndustry::All();
            $industries = ListIndustry::All();
            $jobTypes = [];
            $searchSalary = [];
            $searchExperience = [];
            $searchLocations = [];
            $searchEducations = [];
            $jobQuery = JobDescription::query();
// To check for location
            if($request->get('location')!=''){
                $searchLocations = explode(',',$request->get('location'));
                $searchLocations = array_unique($searchLocations);
                $jobQuery->Where(function ($query) use($searchLocations) {
                    for ($i = 0; $i < count($searchLocations); $i++){
                        $query->orwhere('location', 'like',  '%' . $searchLocations[$i] .'%');
                    }      
                });
                
            }
            // To check for skills
            if($request->get('skill')!=''){
                $skill = $request->get('skill');
                $jobQuery->where('skills_required', 'like', '%'.$skill.'%');
                
            }
// To check for salary
             if($request->get('salary')!=''){
                $searchSalary = explode(',',$request->get('salary'));
                $searchSalary = array_unique($searchSalary);
                $jobQuery->Where(function ($query) use($searchSalary) {
                    for ($i = 0; $i < count($searchSalary); $i++){
                        $salary = explode('-',$searchSalary[$i]);
                        $query->orwhere('budget', 'like',  '%' . $salary[0] .'%');
                        $query->orwhere('budget', 'like',  '%' . $salary[1] .'%');
                    }      
                });
                
            }
            // To check for experience
             if($request->get('experience')!=''){
                $searchExperience = explode(',',$request->get('experience'));
                $searchExperience = array_unique($searchExperience);
                $jobQuery->Where(function ($query) use($searchExperience) {
                    for ($i = 0; $i < count($searchExperience); $i++){
                        $experience = explode('-',$searchExperience[$i]);
                        $query->orwhere('experience', 'like',  '%' . $experience[0] .'%');
                        $query->orwhere('experience', 'like',  '%' . $experience[1] .'%');
                    }      
                });
                
            }
             // To check for education
             if($request->get('education')!=''){
                $searchEducations = explode(',',$request->get('education'));
                $searchEducations = array_unique($searchEducations);
                $jobQuery->Where(function ($query) use($searchEducations) {
                    for ($i = 0; $i < count($searchEducations); $i++){
                        if($i == 0){
                        $query->where('education', 'like',  '%' . $searchEducations[$i] .'%');

                        }else{

                        $query->orwhere('education', 'like',  '%' . $searchEducations[$i] .'%');
                        }
                    }      
                });
                
            }
             // To check for industry
             if($request->get('industry')!=''){
                $searchIndustry = explode(',',$request->get('industry'));
                $searchIndustry = array_unique($searchIndustry);
                $jobQuery->Where(function ($query) use($searchIndustry) {
                    for ($i = 0; $i < count($searchIndustry); $i++){
                        if($i == 0){
                        $query->where('industry_type', 'like',  '%' . $searchIndustry[$i] .'%');
                        }else{
                        $query->orwhere('industry_type', 'like',  '%' . $searchIndustry[$i] .'%');
                        }
                    }      
                });
                
            }


            // To check for job type
            if($request->get('job_type')!=''){
                $jobTypes = explode(',',$request->get('job_type'));
                $jobTypes = array_unique($jobTypes);
                $jobQuery->WhereIn('employement_type',$jobTypes);
            }


            // Get Final Reult
            $jobs =$jobQuery->get();
            $previous_query['location'][]=$request->get('location');
            $previous_query['job_type'][]=$request->get('job_type');
            $previous_query['salary'][]=$request->get('salary');
            $previous_query['experience'][]=$request->get('experience');
            $previous_query['education'][]=$request->get('education');
            $previous_query['industry'][]=$request->get('industry');
            return view('filter', compact('jobs', 'role_cat', 'locations', 'industries', 'previous_query'));
    }



    public function searchquery($query){

       $searchLocations = explode(',',$query);

        $searchLocations = array_unique($searchLocations);

        $query = implode(',', $searchLocations);

       $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();



        $role_cat = ListIndustry::All();



        $industries = ListIndustry::All();



        $jobs = JobDescription::wherein('location',$searchLocations)->paginate(10);





        // $jobs = DB::Table('recruiter_vacancies')

        // ->select('*')                

        // ->Where(function ($query) use($searchLocations) {

        //      for ($i = 0; $i < count($searchLocations); $i++){

        //         $query->orwhere('location', 'like',  '%' . $searchLocations[$i] .'%');

        //      }      

        // })->get()->paginate(10);

        // $jobs = $jobs->toArray();



        // $jobs = JobDescription::where('location', 'like', '%' . $query . '%')->paginate(10);



        $previous_query['location'][]=$query;



        return view('filter', compact('jobs', 'role_cat', 'locations', 'industries', 'previous_query'));



    }







    public function check_apply(Request $request) {



        # code...



        $jd_check = HrJobApplication::where('candidate_id', $request->id)->where('vacancy_id', $request->job_id)->count();



        return $jd_check;



    }

    public function job_show(Request $request){
        $id = $request->id;
        $locations = \DB::table('recruiter_vacancies')->select('recruiter_vacancies.location')->where('location', '!=', '')->where('recruiter_vacancies.status', 2)->groupBy('location')->get();
        $role_cat = ListIndustry::All();
        $industries = ListIndustry::All();
        $jobs = JobDescription::where('hr_id', $id)->get();
        $educations = \DB::table('master_education')->select('*')->get();
        return view('filter', compact('jobs','educations', 'role_cat', 'locations', 'industries'));
    }







}



