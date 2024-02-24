<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('name');
            $table->unsignedBigInteger('price');
            $table->foreignId('sub_category_id')
                ->constrained('sub_categories', 'id')
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('brand_id')
                ->nullable()
                ->constrained('brands', 'id')
                ->nullOnDelete()
                ->cascadeOnUpdate();
            $table->text('descriptions')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products');
    }
};
