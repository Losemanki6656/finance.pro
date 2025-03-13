<?php

namespace App\Models;

use Backpack\CRUD\app\Models\Traits\CrudTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Organization extends Model
{
    use CrudTrait;

    /*
    |--------------------------------------------------------------------------
    | GLOBAL VARIABLES
    |--------------------------------------------------------------------------
    */

    protected $table = 'organizations';
    // protected $primaryKey = 'id';
    // public $timestamps = false;
    protected $guarded = ['id'];
    // protected $fillable = [];
    // protected $hidden = [];
    // protected $dates = [];


    public function management(): BelongsTo
    {
        return $this->belongsTo(Management::class);
    }

    public function railway()
    {
        return $this->belongsTo(Railway::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function send_orgs()
    {

        $year = ConsolYear::where('status', false)->first()->year_consol;

        return $this->hasMany(Consolidated::class, 'send_id', 'user_id')->where('ex_year', $year)->whereNotNull('rec_id');
    }

    public function send_oborot_orgs()
    {
        $year = ConsolOborotYear::where('status', false)->first()->year_consol;
        return $this->hasMany(ConsolidateOboroti::class, 'send_id', 'user_id')->where('ex_year', $year)->whereNotNull('rec_id');
    }

    public function recs()
    {
        return $this->hasMany(Consolidated::class, 'rec_id', 'user_id');
    }

    public function send_organizations(): HasMany
    {
        return $this->hasMany(Consolidated::class, 'send_id', 'user_id')
            ->where('ex_year', request('year_consolidate', ConsolYear::query()->where('status', false)->first()?->year_consol));
    }

    public function send_rev_organizations(): HasMany
    {
        return $this->hasMany(ConsolidateOboroti::class, 'send_id', 'user_id')
            ->where('ex_year', request('year_rev', ConsolOborotYear::query()->where('status', false)->first()->year_consol));
    }

    public function rec_orgs()
    {
        return $this->hasMany(Consolidated::class, 'rec_inn', 'inn');
    }


    /*
    |--------------------------------------------------------------------------
    | FUNCTIONS
    |--------------------------------------------------------------------------
    */

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
