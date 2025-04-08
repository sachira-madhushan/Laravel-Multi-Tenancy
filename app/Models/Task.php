<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Task extends Model
{
    protected $fillable = [
        'name',
        'project_id',
    ];

    public function project(): BelongsTo
    {
        return $this->belongsTo(Project::class);

    }

    protected static function boot()
    {
        parent::boot();

        self::addGlobalScope(function(Builder $builder) {
            $builder->whereHas('project', function ($query) {
                $query->where('user_id', auth()->id());
            });
        });
    }
}
