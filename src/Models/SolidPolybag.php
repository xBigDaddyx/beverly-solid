<?php

namespace Xbigdaddyx\BeverlySolid\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\SoftDeletes;
use Xbigdaddyx\Beverly\Models\CartonBox;
use Wildside\Userstamps\Userstamps;
use Xbigdaddyx\BeverlySolid\Enums\SolidPolybagStatus;

class SolidPolybag extends Model
{
    use HasFactory, SoftDeletes, HasUuids, Userstamps;
    protected $primaryKey = 'uuid';
    protected $table = 'beverly_solid_polybags';
    public function getRouteKeyName()
    {
        return 'uuid';
    }
    protected $fillable = [
        'polybag_code',
        'carton_box_id',
        'status',
        'additional',
    ];
    protected $casts = [
        'status' => SolidPolybagStatus::class,
    ];
    public function cartonBox()
    {
        return $this->belongsTo(CartonBox::class, 'carton_box_id', 'id');
    }
    public function box()
    {
        return $this->belongsTo(CartonBox::class, 'carton_box_id', 'id');
    }
}
