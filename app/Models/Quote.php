<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UUIDs;

class Quote extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDs;

    /**
     * Returns the Quote owner
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    /**
     * Returns the Quote Category
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    /**
     * Returns the Quote Construction
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function construction()
    {
        return $this->belongsTo(Construction::class, 'construction_id', 'id');
    }

}
