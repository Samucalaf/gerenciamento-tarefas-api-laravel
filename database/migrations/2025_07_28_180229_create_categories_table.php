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
        Schema::create('categories', function (Blueprint $table) {
            $table->id('category_id');
            $table->string('name', 20);
            $table->index('name', 'name_idx');
            $table->foreignId('user_id')->constrained('users', 'user_id')->cascadeOnDelete();
            $table->string('description', 500)->nullable();
            $table->index('description', 'description_idx');
            $table->foreignId('created_by')->nullable()->constrained('users', 'user_id');
            $table->foreignId('updated_by')->nullable()->constrained('users', 'user_id');
            $table->index('created_by', 'created_by_idx');
            $table->index('updated_by', 'updated_by_idx');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};
