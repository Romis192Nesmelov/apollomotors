<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Car;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('repairs', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->integer('price');
            $table->integer('old_price')->nullable();
            $table->boolean('price_from');
            $table->decimal('work_time',5,2);
            $table->tinyInteger('upon_reaching_years');
            $table->integer('upon_reaching_mileage');
            $table->boolean('upon_reaching_conditions');
            $table->boolean('free_diagnostics');
            $table->decimal('warranty_years',2,1);
            $table->string('head');
            $table->longText('text')->nullable();
            $table->foreignIdFor(Car::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->boolean('active');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('repairs');
    }
};
