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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('service_id');
            $table->unsignedBigInteger('officer_id')->nullable(true);
            $table->unsignedBigInteger('partner_id')->nullable(true);
            $table->date('date');
            $table->date('closed_date')->nullable();
            $table->string('description', 200);
            $table->string('deed_number')->default('');
            $table->string('file_number')->default('');
            $table->string('deed_properties')->default('');
            $table->decimal('total', 12);
            $table->decimal('total_paid', 12)->default(0.);
            $table->text('notes');
            $table->unsignedTinyInteger('status')->default(0);

            $table->datetime('created_datetime')->nullable()->default(null);
            $table->datetime('updated_datetime')->nullable()->default(null);
            $table->unsignedBigInteger('created_by_uid')->nullable()->default(null);
            $table->unsignedBigInteger('updated_by_uid')->nullable()->default(null);

            $table->foreign('created_by_uid')->references('id')->on('users')->onDelete('set null');
            $table->foreign('updated_by_uid')->references('id')->on('users')->onDelete('set null');
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('restrict');
            $table->foreign('service_id')->references('id')->on('services')->onDelete('restrict');
            $table->foreign('officer_id')->references('id')->on('officers')->onDelete('restrict');
            $table->foreign('partner_id')->references('id')->on('partners')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
