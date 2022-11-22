<?php namespace App\Models;

use CodeIgniter\Model;

class UserModel extends Model
{


    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id','title','first_name','last_name','email','image','username','headline','linkedin_id','pronouns','state','city','about_me','my_skills','free_time_act','dumbest_act','category','career_goals','privacy_status','gender','religion','politics','is_vaccinated','ethnicity','mbti','dietary','non_fav_food','fav_cuisine','sports_notso_good_at','sports_good_at','inspire_me','songs_in_head','countries_want_to_visit','countries_visited','fav_movies','movies_watching','hometown','location','status','token','created_at','updated_at'];
    protected $validationRules = [];
    protected $validationMessages = [];
    protected $skipValidation = false;
}