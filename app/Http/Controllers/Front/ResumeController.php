<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\BasicInfo;
use App\Models\Education;
use App\Models\Reference;
use App\Models\Skill;
use App\Models\WorkDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Validator;

class ResumeController extends Controller
{
    public function __construct()
    {
        $this->basicInfoModel = new BasicInfo();
        $this->workDetailModel = new WorkDetail();
        $this->educationModel = new Education();
        $this->skillModel = new Skill();
        $this->referenceModel = new Reference();
        $this->pagePath = 'front.resume';
        $this->pageTitle = 'Build resume';
    }

    public function chooseTemplate(Request $request)
    {
        if ($request->isMethod('get')) {
            /**
             * show choose template page
             */
            $data['pageTitle'] = $this->pageTitle;
            return view($this->pagePath . '.choose-template', $data);
        } else {
            if (!$request->ajax()) return; //return if not ajax request

            try {
                $template = $request->get('template');
                if (!$template) throw new \Exception('No template selected');

                //store template in session
                $request->session()->put('template', $template);

                // return next page(resume details) page url 
                return response()->json([
                    'resp' => 1,
                    'message' => 'Template value stored in session',
                    'next_page_url' => route('resume.resume_details')
                ]);
            } catch (\Exception $e) {
                return response()->json([
                    'resp' => 0,
                    'message' => $e->getMessage(),
                ]);
            }
        }
    }


    public function resumeDetails(Request $request)
    {
        if ($request->isMethod('get')) {
            //redirect to tempalte selection page if tempalte value is not in session
            $template = $request->session()->get('template');
            if (!$template) return redirect()->route('resume.choose_template');

            //show resume details page 
            $data['pageTitle'] = $this->pageTitle;
            $data['countries'] = json_decode(file_get_contents(storage_path('json/countries.json')), true);
            $data['skills_levels'] = config('resume.skills_level');

            return view($this->pagePath . '.resume-details', $data);
        } else {

            if (!$request->ajax()) return; //return if not ajax request

            $attributes = $request->all(); //get all data

            //validate form data
            $validator = $this->validateResumeDetaills($attributes);
            if ($validator->fails()) {
                return response()->json(['resp' => 0, 'message' => 'Validation Error', 'errors' => $validator->errors()]);
            }

            // store resume details data in session
            $request->session()->put('resume_details', $request->all()); //store resume details in session

            return response()->json([
                'resp' => 1,
                'message' => 'Resume Details Stored in session',
                'next_page_url' => route('resume.resume_preview')
            ]);
        }
    }

    public function resumePreview(Request $request)
    {
        $data['pageTitle'] = 'Resume Preview';

        //fetch template from session & redirect back if no template is stored in session
        $choosenTemplate = $request->session()->get('template');
        if (!$choosenTemplate) return redirect()->route('resume.choose_template');

        //fetch resume details from session
        $resumeDetails = $request->session()->get('resume_details');
        if (!$resumeDetails) return redirect()->route('resume.resume_details');

        //get skills, experience, references , work from resume details
        $skills = $resumeDetails['skill'];
        $work = $resumeDetails['work'];
        $references = $resumeDetails['reference'];
        $education = $resumeDetails['education'];

        //get templates form config to decide which view should be used to parse resume details
        $templates = config('resume.templates');
        $view = !empty($templates[$choosenTemplate]) ? $templates[$choosenTemplate]['view'] : null;

        $data['templates'] = $templates;
        $data['choosenTemplate'] = $choosenTemplate;
        $data['parsedView'] = view($view, [
            'data' => $resumeDetails,
            'skills' => $skills,
            'work' => $work,
            'references' => $references,
            'education' => $education
        ])->render();

        return view($this->pagePath . '.resume-preview', $data);
    }

    public function fetchTemplateParsedView(Request $request)
    {
        $template = $request->get('template');

        //return 0 if template is not selected 
        if (!$template) return response()->json(['resp' => 0, 'message' => 'Please select a template']);
        //else store template in session
        $request->session()->put('template', $template);

        //get templates from config to decide which view should be used to parse resume details
        $templates = config('resume.templates');
        $view = !empty($templates[$template]) ? $templates[$template]['view'] : null;

        //fetch resume details from session
        $resumeDetails = $request->session()->get('resume_details');
        if (!$resumeDetails) return response()->json(['resp' => 0, 'message' => 'Error no resume data found']);

        //get skills, experience, references , work from resume details
        $skills = $resumeDetails['skill'];
        $work = $resumeDetails['work'];
        $references = $resumeDetails['reference'];
        $education = $resumeDetails['education'];


        $parsedView = view($view, [
            'data' => $resumeDetails,
            'skills' => $skills,
            'work' => $work,
            'references' => $references,
            'education' => $education
        ])->render();;

        return response()->json(['resp' => 1, 'parsedView' => $parsedView]);
    }


    public function resumeDownload(Request $request)
    {
        //ensure user is authenticated
        if (!Auth::check()) return redirect()->route('login');

        //redirect back if no template or resume details in session
        $resumeDetails = $request->session()->get('resume_details');
        $template = $request->session()->get('template');
        if (!$resumeDetails || !$template) return redirect()->back();

        try {
            //store resume data in database before donwloading resume
            $user = Auth::user();
            // $this->insertResumeDetails($resumeDetails, $user); //insert resume details

            $type = $request->type ? $request->type : 'pdf';
            if ($type == 'word')  return $this->downloadWord($template, $resumeDetails);
            return $this->downloadPdf($template, $resumeDetails);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function downloadPdf($template, $resumeDetails)
    {
        //decide which view should be used to parse resume details
        $templates = config('resume.templates');
        $view = !empty($templates[$template]) ? $templates[$template]['view'] : null;

        //get skills, experience, references , work from resume details
        $skills = $resumeDetails['skill'];
        $work = $resumeDetails['work'];
        $references = $resumeDetails['reference'];
        $education = $resumeDetails['education'];

        $pdf = \PDF::loadView($view, [
            'data' => $resumeDetails,
            'skills' => $skills,
            'work' => $work,
            'references' => $references,
            'education' => $education
        ]);

        return $pdf->download('resume.pdf');
    }

    public function downloadWord($template, $resumeDetails)
    {
        //decide which view should be used to parse resume details
        $templates = config('resume.templates');
        $view = !empty($templates[$template]) ? $templates[$template]['view'] : null;

        //get skills, experience, references , work from resume details
        $skills = $resumeDetails['skill'];
        $work = $resumeDetails['work'];
        $references = $resumeDetails['reference'];
        $education = $resumeDetails['education'];

        $html = view($view, [
            'data' => $resumeDetails,
            'skills' => $skills,
            'work' => $work,
            'references' => $references,
            'education' => $education
        ])->render();

        $headers = array(
            "Content-type" => "text/html",
            "Content-Disposition" => "attachment;Filename=resume.doc"
        );

        return \Response::make($html, 200, $headers);
    }

    public function insertResumeDetails($resumeData, $user)
    {
        $this->insertBasciInfo($resumeData, $user);
        $this->insertEducation($resumeData, $user);
        $this->insertWorkDetails($resumeData, $user);
        $this->insertReferences($resumeData, $user);
        $this->insertSkills($resumeData, $user);
    }

    public function insertBasciInfo($resumeData, $user)
    {
        $data = [
            'first_name' => $resumeData['first_name'],
            'last_name'  => $resumeData['last_name'],
            'email' => $resumeData['email'],
            'phone' => $resumeData['phone'],
            'postal_code' => $resumeData['postal_code'],
            'street' => $resumeData['street'],
            'city' => $resumeData['city'],
            'country' => $resumeData['country'],
            'profession_title' => $resumeData['professsion_title'],
            'profession_summary' => $resumeData['profession_summary'],
            'user_id' => $user->id
        ];

        //update record is user has basic info else create new record
        if (!empty($user->basicInfo)) $user->basicInfo->update($data);
        else $this->basicInfoModel->create($data);
    }

    public function insertEducation($resumeData, $user)
    {
        $educationArr = $resumeData['education'];

        //delete previous records if any
        if ($user->education->isNotEmpty()) {
            foreach ($user->education as $each) {
                $each->delete();
            }
        }

        //ensure educationArr is array with legth > 1
        if (!is_array($educationArr) || !count($educationArr) > 0) return;

        for ($i = 0; $i < count($educationArr); $i++) {
            if (empty($educationArr[$i]['institution'])) continue;

            $data['user_id'] = $user->id;
            $data['institution'] = isset($educationArr[$i]['institution']) ? $educationArr[$i]['institution'] : null;
            $data['area'] = isset($educationArr[$i]['area']) ? $educationArr[$i]['area'] : null;
            $data['study_type'] = isset($educationArr[$i]['study_type']) ? $educationArr[$i]['study_type'] : null;
            $data['gpa'] = isset($educationArr[$i]['gpa']) ? $educationArr[$i]['gpa'] : null;
            $data['start_date'] = isset($educationArr[$i]['start_date']) ? $educationArr[$i]['start_date'] : null;
            $data['end_date'] = isset($educationArr[$i]['end_date']) ? $educationArr[$i]['end_date'] : null;

            $this->educationModel->create($data);
        }
    }

    public function insertWorkDetails($resumeData, $user)
    {
        $workArr = $resumeData['work'];

        //ensure workArr is array with legth > 1
        if (!is_array($workArr) || !count($workArr) > 0) return;

        //delete previous records if any
        if ($user->workDetails->isNotEmpty()) {
            foreach ($user->workDetails as $each) {
                $each->delete();
            }
        }

        for ($i = 0; $i < count($workArr); $i++) {
            if (empty($workArr[$i]['company'])) continue;

            $data['user_id'] = $user->id;
            $data['company'] = isset($workArr[$i]['company']) ? $workArr[$i]['company'] : null;
            $data['position'] = isset($workArr[$i]['position']) ? $workArr[$i]['position'] : null;
            $data['summary'] = isset($workArr[$i]['summary']) ? $workArr[$i]['summary'] : null;
            $data['highlights'] = isset($workArr[$i]['highlights']) ? $workArr[$i]['highlights'] : null;
            $data['start_date'] = isset($workArr[$i]['start_date']) ? $workArr[$i]['start_date'] : null;
            $data['end_date'] = isset($workArr[$i]['end_date']) ? $workArr[$i]['end_date'] : null;

            $this->workDetailModel->create($data);
        }
    }

    public function insertReferences($resumeData, $user)
    {
        $referenceArr = $resumeData['reference'];

        //ensure refArr is array with legth > 1
        if (!is_array($referenceArr) || !count($referenceArr) > 0) return;

        //delete previous records if any
        if ($user->references->isNotEmpty()) {
            foreach ($user->references as $each) {
                $each->delete();
            }
        }

        for ($i = 0; $i < count($referenceArr); $i++) {
            if (empty($referenceArr[$i]['name'])) continue;

            $data['user_id'] = $user->id;
            $data['name'] = isset($referenceArr[$i]['name']) ? $referenceArr[$i]['name'] : null;
            $data['reference'] = isset($referenceArr[$i]['reference']) ? $referenceArr[$i]['reference'] : null;

            $this->referenceModel->create($data);
        }
    }

    public function insertSkills($resumeData, $user)
    {
        $skillsArr = $resumeData['skill'];

        //ensure skillArr is array with legth > 1
        if (!is_array($skillsArr) || !count($skillsArr) > 0) return;

        //delete previous records if any
        if ($user->skills->isNotEmpty()) {
            foreach ($user->skills as $each) {
                $each->delete();
            }
        }

        for ($i = 0; $i < count($skillsArr); $i++) {
            if (empty($skillsArr[$i]['name'])) continue;

            $data['user_id'] = $user->id;
            $data['name'] = isset($skillsArr[$i]['name']) ? $skillsArr[$i]['name'] : null;
            $data['label'] = isset($skillsArr[$i]['label']) ? $skillsArr[$i]['label'] : null;

            $this->skillModel->create($data);
        }
    }

    public function validateResumeDetaills($data)
    {
        $rules = $this->rules();
        $messages = $this->messages();
        return Validator::make($data, $rules, $messages);
    }

    public function rules()
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'work.*.start_date' => 'nullable|date_format:Y-m-d',
            'work.*.end_date' => 'nullable|date_format:Y-m-d',
            'education.*.start_date' => 'nullable|date_format:Y-m-d',
            'education.*.end_date' => 'nullable|date_format:Y-m-d',
        ];
    }

    public function messages()
    {
        return [
            'required' => ':attribute is requried',
            'date_format' => ':attribute must match format Y-m-d',
            // 'work.*.start_date.*' => 'Enter valid date of format Y-m-d',
            // 'education.*.start_date.*' => 'Enter valid date of format Y-m-d',
            // 'work.*.end_date.*' => 'Enter valid date of format Y-m-d',
            // 'education.*.end_date.*' => 'Enter valid date of format Y-m-d',
        ];
    }
}
