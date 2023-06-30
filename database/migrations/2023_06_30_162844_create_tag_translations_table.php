<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tag_translations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('tag_id');
            $table->string('locale');
            $table->string('name');
            $table->foreign('tag_id')->references('id')->on('tags')->onDelete('cascade');
       });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tag_translations');
    }
};
