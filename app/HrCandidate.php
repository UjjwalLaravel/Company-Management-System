<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class HrCandidate extends Model {
    protected $table='candidate_profiles';
    protected $fillable = ['name', 'email', 'phone_number', 'current_location', 'preferred_location', 'total_experience', 'current_company_name', 'current_company_designation', 'functional_area', 'role', 'industry', 'key_skills', 'annual_salary', 'notice_period', 'resume_headline', 'summary', 'under_graduation_degree', 'ug_specialization', 'ug_university_institute_name', 'ug_graduation_year', 'post_graduation_degree', 'pg_specialization', 'pg_university_institute_name', 'pg_graduation_year', 'doctorate_degree', 'doctorate_specialization', 'doctorate_university_institute_name', 'doctorate_graduation_year', 'gender', 'marital_status', 'home_town_city', 'pin_code', 'work_permit_for_usa', 'date_of_birth', 'permanent_address', 'email1', 'email2', 'mobile1', 'mobile2', 'state', 'gross_salary', 'issue_date', 'appointment_date', 'user_id'];

}
