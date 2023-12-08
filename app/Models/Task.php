<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'date',
        'user_id'
    ];

    /**
     * В дальнейшем можно организовать привязку дела к исполнителю
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function performer()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
