<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    // Modify the existing foreign key constraint
    Schema::table('comments', function (Blueprint $table) {
        $table->dropForeign(['post_id']); // Remove the existing constraint
        $table->foreign('post_id')
              ->references('id')
              ->on('posts')
              ->onDelete('cascade'); // Add the new cascading delete action
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('comments', function (Blueprint $table) {
            //
        });
    }
};
