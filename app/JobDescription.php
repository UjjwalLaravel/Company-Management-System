<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class JobDescription extends Model {

protected $table = 'recruiter_vacancies';

    protected $fillable = ['industry_id', 'functional_area_id', 'vacancy_name', 'job_description', 'job_responsibilities', 'benefits', 'role', 'industry_type', 'functional_area', 'role_category', 'ug', 'pg', 'doctorate', 'skills_required', 'preferable_candidate', 'company_overview', 'experience', 'budget', 'reporting_to', 'no_of_postion', 'timeline', 'company'];

    public function get_data($industry, $location, $skill_company) {
        $sk = $skill_company;

//         if (!empty($industry) && !empty($location) && !empty($skill_company)) {
//             return JobDescription::where('industry_type', $industry)->where('location', 'like', '%' . $location . '%')->where('skills_required', 'like', '%' . $skill_company . '%')->where('status', 2)->paginate(10);
//         } else if (!empty($industry) && empty($location) && empty($skill_company)) {
//             return JobDescription::where('industry_type', $industry)->where('status', 2)->paginate(10);
//         } else if (empty($industry) && !empty($location) && empty($skill_company)) {
//             return JobDescription::where('location', 'like', '%' . $location . '%')->where('status', 2)->paginate(10);
//         } else if (empty($industry) && empty($location) && !empty($skill_company)) {
//             //exit('gsd');
//             return JobDescription::where('skills_required', 'like', '%' . $skill_company . '%')->where('status', 2)->paginate(10);
//         } else if (!empty($industry) && !empty($location) && empty($skill_company)) {
//             return JobDescription::where('industry_type', $industry)->where('location', 'like', '%' . $location . '%')->where('status', 2)->paginate(10);
//         } else if (!empty($industry) && empty($location) && !empty($skill_company)) {
//             return JobDescription::where('industry_type', $industry)->where('skills_required', 'like', '%' . $skill_company . '%')->where('status', 2)->paginate(10);
//         } else if (empty($industry) && !empty($location) && !empty($skill_company)) {
//             return JobDescription::where('location', 'like', '%' . $location . '%')->where('skills_required', 'like', '%' . $skill_company . '%')->where('status', 2)->paginate(10);
//         } else {
// //            exit('dflkgvjdf');
//            return array();
//         }
    }

public static function getQueryWithBindings($query): string
        {
           return vsprintf(str_replace('?', '%s', $query->toSql()), collect($query->getBindings())->map(function ($binding) {
                $binding = addslashes($binding);
                return is_numeric($binding) ? $binding : "'{$binding}'";
            }));
        }
}
