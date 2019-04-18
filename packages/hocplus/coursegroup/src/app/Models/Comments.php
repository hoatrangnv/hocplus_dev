<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Hocplus\Coursegroup\App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vne\Member\App\Models\Member;
class Comments extends Model
{
    use SoftDeletes;
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'comments';

    protected $primaryKey = 'id';

    protected $dates = ['deleted_at'];
    
    public function getUser(){
        $user = Member::find($this->user_id);
        if ($user) {
            return $user->name;
        }
        else {
            return null;
        }
    }
}