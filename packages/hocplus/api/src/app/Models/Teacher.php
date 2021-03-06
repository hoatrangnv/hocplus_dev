<?php

namespace Hocplus\Api\App\Models;

use Illuminate\Database\Eloquent\Model;
use Vne\Classes\App\Models\Classes;
use Vne\Teacher\App\Models\TeacherClassSubject;

class Teacher extends Model
{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'vne_teachers';

    protected $primaryKey = 'teacher_id';

    protected $fillable = ['name'];

    protected $hidden = ['password', 'remember_token'];

    protected $dates = ['deleted_at'];

    public function getClasses(){
        return $this->belongsToMany(Classes::class, 'vne_teacher_class_subject', 'teacher_id', 'classes_id')->with('getSubject')->select('vne_classes.classes_id', 'name')->distinct();
    }

    public function getSubject(){
        return $this->hasMany(TeacherClassSubject::class, 'teacher_id');
    }
}
