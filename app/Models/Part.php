<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Part extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function source() {
        return $this->belongsTo(Source::class);
    }

    public function parts() {
        return $this->belongsToMany(self::class, 'parent_parts', 'parent_id', 'part_id', 'id', 'id')->withPivot('qty');
    }

    public function compounds() {
        return $this->hasMany(ParentPart::class, 'part_id', 'id');
    }
}
