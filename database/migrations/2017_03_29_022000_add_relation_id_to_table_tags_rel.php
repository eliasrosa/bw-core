<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddRelationIdToTableTagsRel extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tags_rel', function (Blueprint $table) {
            $table->string('relation_id');
            $table->dropPrimary('PRIMARY'); 
            $table->primary([
                'tag_id', 
                'taggable_id', 
                'taggable_type', 
                'relation_id'
            ]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tags_rel', function (Blueprint $table) {
            $table->dropColumn('relation_id');
        });
    }
}
