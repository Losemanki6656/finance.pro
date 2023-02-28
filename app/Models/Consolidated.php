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
        'ex_06' => 'double',
        'ex_09' => 'double',
        'ex_40' => 'double',
        'ex_41' => 'double',
        'ex_43' => 'double',
        'ex_46' => 'double',
        'ex_48' => 'double',
        'ex_58' => 'double',
        'ex_60' => 'double',
        'ex_61' => 'double',
        'ex_63' => 'double',
        'ex_66' => 'double',
        'ex_68' => 'double',
        'ex_69' => 'double',
        'ex_79' => 'double',
        'ex_83' => 'double'
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

    public function result_double()
    {
        $summ = (double)$this->ex_06 + (double)$this->ex_09 + (double)$this->ex_40 + (double)$this->ex_41 + 
        (double)$this->ex_43 + (double)$this->ex_46 + (double)$this->ex_48 + (double)$this->ex_58 + 
        (double)$this->ex_60 + (double)$this->ex_61 + (double)$this->ex_63 + (double)$this->ex_66 + (double)$this->ex_68 + (double)$this->ex_69 + (double)$this->ex_78 +  (double)$this->ex_79 + (double)$this->ex_83;
        
        return number_format($summ , 2, '.', ' ');
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
