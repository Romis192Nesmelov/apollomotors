<?php

use App\Models\Content;
//use App\Models\Action;
use \App\Models\Article;
use \App\Models\BrandRepair;
use \App\Models\CarRepair;
use \App\Models\BrandMaintenance;
use \App\Models\CarMaintenance;
use \App\Models\BrandSpare;
use \App\Models\CarSpare;
use \App\Models\Repair;
use \App\Models\Spare;
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
        Schema::create('seos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('keywords')->nullable();
            $table->text('description')->nullable();
            $table->foreignIdFor(Content::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
//            $table->foreignIdFor(Action::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Article::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignIdFor(BrandRepair::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarRepair::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignIdFor(BrandMaintenance::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarMaintenance::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignIdFor(BrandSpare::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(CarSpare::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();

            $table->foreignIdFor(Repair::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreignIdFor(Spare::class)->nullable()->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('seos');
    }
};
