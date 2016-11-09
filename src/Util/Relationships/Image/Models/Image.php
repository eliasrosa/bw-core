<?php

namespace BW\Util\Relationships\Image\Models;

use Illuminate\Database\Eloquent\Model;
use BW\Util\Relationships\RelationshipTrait;

class Image extends Model
{
    // Trait
    use RelationshipTrait;

    //
    protected $table = 'images';
    protected $fillable = [];

    //
    public function ref()
    {
        $relation = \BWAdmin::get('relationships')
            ->get($this->relation_id)
            ->first();

        //
        return $this->belongsTo($relation['model']);
    }

    //
    public function getFilename()
    {
        return $this->id . '.' . $this->type;
    }

    //
    public function getPath()
    {
        return storage_path('app/' . config('bw.images.storage')) . '/' . $this->getFilename();
    }

    //
    public function getUrl($template)
    {
        return route('images', [
            'template' => $template,
            'filename' => $this->getFilename(),
        ]);
    }
}
