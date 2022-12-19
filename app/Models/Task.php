<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

# php artisan make:model Task
class Task extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'tasks';
    protected $dates = ['created_at', 'deadline', 'finished_at'];
    protected $fillable = ['name', 'description', 'deadline', 'category_id', 'finished_at', 'status'];

    # Method returns color to view
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

    # WHEN [ now() > task->deadline ] or [ task is finished ] return false
    public function getCanManageAttribute()
    {
        if ($this->status === "finished") {
            return false;
        }

        return Carbon::now()->lessThanOrEqualTo($this->deadline);
    }

    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
