<?php

namespace BW\Util\Relationships\Listing;

use BWAdmin;

trait ListingModelTrait
{
    //
    public function scopeOrderByRelationshipListingPosition($query, $name, $order = 'asc'){
        
        // 
        $model = get_class();
        $relationship_rel = $name . "_rel";
        $relationship = BWAdmin::get('relationships')
            ->get()
            ->where('name', $name)
            ->where('model', $model)
            ->first();

        //
        return $query->join('listings_rel AS ' . $relationship_rel, function($join) use($relationship_rel, $model){
                        $join->on($this->table . '.id', '=', $relationship_rel . '.listable_id')
                             ->where($relationship_rel . '.listable_type', '=', $model);
                    })
                    ->join('listings AS ' . $name, function($join) use($name, $relationship, $relationship_rel){
                        $join->on($name . '.id', '=', $relationship_rel.'.list_id')
                             ->where($name.'.relation_id', '=', $relationship['id']);
                    })
                    ->select($this->table . '.*')
                    ->orderBy($name.'.position', $order);
    }
}
