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
        Schema::create('witnesses', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->text('description')->nullable()->default(null);
            $table->text('notes')->nullable()->default(null);
            $table->boolean('active')->default(false);
            $table->datetime('created_datetime')->nullable()->default(null);
            $table->datetime('updated_datetime')->nullable()->default(null);
            $table->unsignedBigInteger('created_by_uid')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by_uid')->nullable()->default(null);
            $table->foreign('created_by_uid')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_uid')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('witnesses');
    }
};
