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
        Schema::create('blogs', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('writer_id');
        $table->string('title');
        $table->string('slug')->unique();
        $table->text('content');
        $table->unsignedBigInteger('category_id');
        $table->string('cover_image')->nullable();
        $table->integer('views')->default(0);
        $table->timestamp('published_at')->nullable();
        $table->timestamps();

        $table->foreign('category_id')->references('id')->on('blog_categories')->onDelete('cascade');
        $table->foreign('writer_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
