<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->text('content')->nullable()->after('description');
            $table->string('video_url')->nullable()->after('content');
            $table->integer('duration')->nullable()->after('video_url');
            $table->string('file')->nullable()->after('duration');
            $table->boolean('is_published')->default(false)->after('file');
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down() : void
    {
        Schema::table('lesson', function (Blueprint $table) {
            //
        });
    }
};
