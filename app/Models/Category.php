<?php

namespace App\Models;

use App\Models\Task; // <- Import pliku z klasą Task
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $table = 'categories';

    protected $fillable = [
        'name',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tasks()
    {
        $activeTasks = $this->activeTasks;
        $finishedTasks = $this->finishedTasks;
        return $activeTasks->concat($finishedTasks);
    }

    public function activeTasks()
    {
        return $this->hasMany(Task::class)
            ->where('status', 'active')
            ->orderBy('deadline');
    }

    public function finishedTasks()
    {
        return $this->hasMany(Task::class)
            ->where('status', 'finished')
            ->orderBy('finished_at');
    }
}
