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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('meta_title')->nullable();
            $table->string('meta_keywords')->nullable();
            $table->string('slug')->unique();
            $table->string('short_description');
            $table->text('key_benefits')->nullable();
            $table->text('description');
            $table->text('ingredient')->nullable();
            $table->decimal('price', 10, 2);
              $table->decimal('mrp_price', 10, 2)->nullable()->after('price');
                 $table->string('qnty')->nullable();
        $table->decimal('discount', 5, 2)->nullable()->after('mrp_price');
             $table->integer('best_product')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
