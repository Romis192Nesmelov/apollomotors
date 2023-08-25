<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use \App\Models\Mechanic;
use \App\Models\MissingMechanic;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('mechanic_missing_mechanic', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Mechanic::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(MissingMechanic::class)->constrained()->cascadeOnUpdate()->cascadeOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mechanic_missing_mechanic');
    }
};
