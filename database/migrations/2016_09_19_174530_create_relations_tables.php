<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRelationsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('images', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('ref_id')->unsigned();
            $table->string('relation_id', 32);
            $table->string('type', 10);
            $table->string('name');
            $table->longtext('description');
            $table->integer('position')->unsigned();
            $table->timestamps();
        });

        Schema::create('listings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('relation_id', 32);
            $table->string('name');
            $table->longtext('description');
            $table->timestamps();
        });

        Schema::create('listings_rel', function (Blueprint $table) {
            $table->integer('list_id');
            $table->integer('listable_id');
            $table->string('listable_type');

            //
            $table->primary(['list_id', 'listable_id', 'listable_type']);
        });

        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('relation_id', 32);
            $table->string('name');
            $table->longtext('description');
            $table->timestamps();
        });

        Schema::create('tags_rel', function (Blueprint $table) {
            $table->integer('tag_id');
            $table->integer('taggable_id');
            $table->string('taggable_type');

            //
            $table->primary(['tag_id', 'taggable_id', 'taggable_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('images');
        Schema::drop('listings');
        Schema::drop('listings_rel');
        Schema::drop('tags');
        Schema::drop('tags_rel');
    }
}
