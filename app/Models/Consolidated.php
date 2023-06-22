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
        return $this->belongsTo(User::class, 'rec_id');
    }

    public function send()
    {
        return $this->belongsTo(User::class, 'send_id');
    }


    public function result_all()
    {
        $summ = (int) $this->ex_06 + (int) $this->ex_09 + (int) $this->ex_40 + (int) $this->ex_41 +
            (int) $this->ex_43 + (int) $this->ex_46 + (int) $this->ex_48 + (int) $this->ex_58 +
            (int) $this->ex_60 + (int) $this->ex_61 + (int) $this->ex_63 + (int) $this->ex_66 + (int) $this->ex_68 + (int) $this->ex_69 + (int) $this->ex_78 + (int) $this->ex_79 + (int) $this->ex_83;

        return number_format($summ, 0, ' ', ' ');
    }

    public function allResult()
    {
        $summ = (int) $this->ex_06 + (int) $this->ex_09 + (int) $this->ex_40 + (int) $this->ex_41 +
            (int) $this->ex_43 + (int) $this->ex_46 + (int) $this->ex_48 + (int) $this->ex_58 +
            (int) $this->ex_60 + (int) $this->ex_61 + (int) $this->ex_63 + (int) $this->ex_66 + (int) $this->ex_68 + (int) $this->ex_69 + (int) $this->ex_78 + (int) $this->ex_79 + (int) $this->ex_83;
        return $summ;
    }


    public function setEx06Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_06'] = 0;
        else
            $this->attributes['ex_06'] = $value;
    }

    public function setEx09Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_09'] = 0;
        else
            $this->attributes['ex_09'] = $value;
    }

    public function setEx40Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_40'] = 0;
        else
            $this->attributes['ex_40'] = $value;
    }

    public function setEx41Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_41'] = 0;
        else
            $this->attributes['ex_41'] = $value;
    }
    public function setEx43Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_43'] = 0;
        else
            $this->attributes['ex_43'] = $value;
    }
    public function setEx46Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_46'] = 0;
        else
            $this->attributes['ex_46'] = $value;
    }
    public function setEx48Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_48'] = 0;
        else
            $this->attributes['ex_48'] = $value;
    }
    public function setEx58Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_58'] = 0;
        else
            $this->attributes['ex_58'] = $value;
    }
    public function setEx60Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_60'] = 0;
        else
            $this->attributes['ex_60'] = $value;
    }
    public function setEx61Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_61'] = 0;
        else
            $this->attributes['ex_61'] = $value;
    }
    public function setEx63Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_63'] = 0;
        else
            $this->attributes['ex_63'] = $value;
    }
    public function setEx66Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_66'] = 0;
        else
            $this->attributes['ex_66'] = $value;
    }

    public function setEx68Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_68'] = 0;
        else
            $this->attributes['ex_68'] = $value;
    }

    public function setEx69Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_69'] = 0;
        else
            $this->attributes['ex_69'] = $value;
    }

    public function setEx78Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_78'] = 0;
        else
            $this->attributes['ex_78'] = $value;
    }

    public function setEx79Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_79'] = 0;
        else
            $this->attributes['ex_79'] = $value;
    }

    public function setEx83Attribute($value)
    {
        if ($value == null)
            $this->attributes['ex_83'] = 0;
        else
            $this->attributes['ex_83'] = $value;
    }
}