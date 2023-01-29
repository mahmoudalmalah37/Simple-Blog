<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('post_id')->constrained()->onDelete('cascade'); //foreign key
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); //user_id is the foreign key
            $table->text('comment'); //text is a string with no limit
            $table->foreignId('parent_id')->nullable()->constrained('comments')->onDelete('cascade'); //parent_id is the foreign key
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->softDeletes(); //soft delete
            $table->timestamps(); //created_at and updated_at
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
};
