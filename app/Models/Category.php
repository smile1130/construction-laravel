<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Traits\UUIDs;

class Category extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, UUIDs;

    /**
     * Get parent
     *
     * @return Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function parent()
    {
        return $this->belongsTo(Category::class, 'parent_id', 'id');
    }

    public function rootCategory()
    {
        return $this->parent->parent->parent();
    }

    public static function rootCategories()
    {
        return Category::where('parent_id', null)->get();
    }

    public function subcategories()
    {
        return Category::where('parent_id', $this->id)->get();
    }

    public function item()
    {
        return $this->parent();
    }

}
