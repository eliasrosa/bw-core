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
    protected $appends = ['filename'];

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
    public static function boot () {
        parent::boot();
        
        // delete file
        self::deleting(function ($value) {
            if(file_exists($value->getPath())){
                unlink($value->getPath());
            }
        });
    }

    //
    public function getPath()
    {
        return storage_path('app/' . config('bw.images.storage')) . '/' . $this->filename;
    }

    //
    public function getUrl($template)
    {
        return route('images', [
            'template' => $template,
            'filename' => $this->filename,
        ]);
    }

    //
    public function getFilenameAttribute($value)
    {
        return $this->id . '.' . $this->type;
    }
}
