<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Auth;

class Consolidated extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'consolidated';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];

    // protected static function boot()
    // {
    //     parent::boot();

    //     $user_id = backpack_user()->id;
    //     static::addGlobalScope('send_id', function ($builder) use ($user_id) {
    //         $builder->where('send_id', $user_id);
    //     });
    // }

    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

    public function rec()
    {
        return $this->belongsTo(User::class,'rec_id');
    }

    public function send()
    {
        return $this->belongsTo(User::class,'send_id');
    }


    public function result_all()
    {
        $summ = (int)$this->ex_06 + (int)$this->ex_09 + (int)$this->ex_40 + (int)$this->ex_41 + 
        (int)$this->ex_43 + (int)$this->ex_46 + (int)$this->ex_48 + (int)$this->ex_58 + 
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_69 + (int)$this->ex_69 + (int)$this->ex_79;
        return number_format($summ , 0, ' ', ' ');
    }

    public function result_all_int()
    {
        $summ = (int)$this->ex_06 + (int)$this->ex_09 + (int)$this->ex_40 + (int)$this->ex_41 + 
        (int)$this->ex_43 + (int)$this->ex_46 + (int)$this->ex_48 + (int)$this->ex_58 + 
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_69 + (int)$this->ex_69 + (int)$this->ex_79;
        return $summ;
    }

    /*
    |--------------------------------------------------------------------------
    | RELATIONS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | SCOPES
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | ACCESSORS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | MUTATORS
    |--------------------------------------------------------------------------
    */
}
