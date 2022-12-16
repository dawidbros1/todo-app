<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tasks';
    protected $dates = ['created_at', 'deadline', 'finished_at'];
    protected $fillable = ['name', 'description', 'deadline', 'category_id', 'finished_at', 'status'];

    public function getColorAttribute()
    {
        if ($this->finished_at === null) {
            if ($this->deadline->lessThanOrEqualTo(Carbon::now())) {
                return "text-warning fw-bold";
            }
        } else {
            if ($this->finished_at->lessThanOrEqualTo($this->deadline)) {
                return "text-success fw-bold";
            } else {
                return "text-danger fw-bold";
            }
        }

        return "";
    }

    public function getCanManageAttribute()
    {
        return Carbon::now()->lessThanOrEqualTo($this->deadline);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
