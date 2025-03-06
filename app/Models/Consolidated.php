<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

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
        'ex_83' => 'integer',
        'file'  => 'string',
    ];


    public function rec(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rec_id');
    }

    public function send(): BelongsTo
    {
        return $this->belongsTo(User::class, 'send_id');
    }

    public function setFileAttribute($value)
    {
        $attribute_name = "file";
        $disk = "public";
        $destination_path = "consolidate/files";

        $this->uploadFileToDisk($value, $attribute_name, $disk, $destination_path);
    }

    public function getFilePathAttribute($value): ?string
    {
        return $value ? Storage::disk('public')->url($value) : null;
    }

    public function result()
    {
        return abs((int)$this->ex_06) + abs((int)$this->ex_09) + abs((int)$this->ex_40) + abs((int)$this->ex_41) +
            abs((int)$this->ex_43) + abs((int)$this->ex_46) + abs((int)$this->ex_48) + abs((int)$this->ex_58) -
            abs((int)$this->ex_60) - abs((int)$this->ex_61) - abs((int)$this->ex_63) - abs((int)$this->ex_66) -
            abs((int)$this->ex_68) - abs((int)$this->ex_69) - abs((int)$this->ex_78) - abs((int)$this->ex_79) -
            abs((int)$this->ex_83);
    }

    public function resultFormatted(): string
    {
        return number_format($this->result(), 0, ' ', ' ');
    }

    public function allResult()
    {
        return $this->result();
    }


    public function setEx06Attribute($value)
    {
        $this->attributes['ex_06'] = $value ?? 0;
    }

    public function setEx09Attribute($value)
    {
        $this->attributes['ex_09'] = $value ?? 0;
    }

    public function setEx40Attribute($value)
    {
        $this->attributes['ex_40'] = $value ?? 0;
    }

    public function setEx41Attribute($value)
    {
        $this->attributes['ex_41'] = $value ?? 0;
    }

    public function setEx43Attribute($value)
    {
        $this->attributes['ex_43'] = $value ?? 0;
    }

    public function setEx46Attribute($value)
    {
        $this->attributes['ex_46'] = $value ?? 0;
    }

    public function setEx48Attribute($value)
    {
        $this->attributes['ex_48'] = $value ?? 0;
    }

    public function setEx58Attribute($value)
    {
        $this->attributes['ex_58'] = $value ?? 0;
    }

    public function setEx60Attribute($value)
    {
        $this->attributes['ex_60'] = $value ?? 0;
    }

    public function setEx61Attribute($value)
    {
        $this->attributes['ex_61'] = $value ?? 0;
    }

    public function setEx63Attribute($value)
    {
        $this->attributes['ex_63'] = $value ?? 0;
    }

    public function setEx66Attribute($value)
    {
        $this->attributes['ex_66'] = $value ?? 0;
    }

    public function setEx68Attribute($value)
    {
        $this->attributes['ex_68'] = $value ?? 0;
    }

    public function setEx69Attribute($value)
    {
        $this->attributes['ex_69'] = $value ?? 0;
    }

    public function setEx78Attribute($value)
    {
        $this->attributes['ex_78'] = $value ?? 0;
    }

    public function setEx79Attribute($value)
    {
        $this->attributes['ex_79'] = $value ?? 0;
    }

    public function setEx83Attribute($value)
    {
        $this->attributes['ex_83'] = $value ?? 0;
    }
}
