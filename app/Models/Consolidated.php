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

    protected $casts = [
        'ex_06' => 'integer',
        'ex_09' => 'integer',
        'ex_40' => 'integer',
        'ex_41' => 'integer',
        'ex_43' => 'integer',
        'ex_46' => 'integer',
        'ex_48' => 'integer',
        'ex_58' => 'integer',
        'ex_60' => 'integer',
        'ex_61' => 'integer',
        'ex_63' => 'integer',
        'ex_66' => 'integer',
        'ex_68' => 'integer',
        'ex_69' => 'integer',
        'ex_79' => 'integer',
        'ex_83' => 'integer'
    ];
    

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
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_68 + (int)$this->ex_69 + (int)$this->ex_78 +  (int)$this->ex_79 + (int)$this->ex_83;
        return number_format($summ , 0, ' ', ' ');
    }

    public function result_integer()
    {
        $summ = (int)$this->ex_06 + (int)$this->ex_09 + (int)$this->ex_40 + (int)$this->ex_41 + 
        (int)$this->ex_43 + (int)$this->ex_46 + (int)$this->ex_48 + (int)$this->ex_58 + 
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_68 + (int)$this->ex_69 + (int)$this->ex_78 +  (int)$this->ex_79 + (int)$this->ex_83;
        
        // return number_format($summ , 2, '.', ' ');
        return $summ;
    }

    public function result_integer_pr()
    {
        $summ = (int)$this->ex_06 + (int)$this->ex_09 + (int)$this->ex_40 + (int)$this->ex_41 + 
        (int)$this->ex_43 + (int)$this->ex_46 + (int)$this->ex_48 + (int)$this->ex_58 + 
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_68 + (int)$this->ex_69 + (int)$this->ex_78 +  (int)$this->ex_79 + (int)$this->ex_83;
        
        if($summ == 0) 
            return 0; 
        else
            return $summ;
    }

    public function result_all_int()
    {
        $summ = (int)$this->ex_06 + (int)$this->ex_09 + (int)$this->ex_40 + (int)$this->ex_41 + 
        (int)$this->ex_43 + (int)$this->ex_46 + (int)$this->ex_48 + (int)$this->ex_58 + 
        (int)$this->ex_60 + (int)$this->ex_61 + (int)$this->ex_63 + (int)$this->ex_66 + (int)$this->ex_68 + (int)$this->ex_69 + (int)$this->ex_78 + (int)$this->ex_79 + (int)$this->ex_83;
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
