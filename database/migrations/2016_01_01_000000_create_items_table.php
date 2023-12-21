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
        Schema::create('items', function (Blueprint $table) {
            $table->uuid('id');
            $table->uuid('construction_id');
            $table->uuid('category_id');
            $table->uuid('quote_id');
            $table->double('quantity');
            $table->timestamps();

            $table->primary('id');
            $table
                ->foreign('construction_id')
                ->references('id')
                ->on('constructions')
                ->onDelete('CASCADE');
            $table
                ->foreign('category_id')
                ->references('id')
                ->on('categories')
                ->onDelete('CASCADE');
            $table
                ->foreign('quote_id')
                ->references('id')
                ->on('quotes')
                ->onDelete('CASCADE');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('items');
    }
};
