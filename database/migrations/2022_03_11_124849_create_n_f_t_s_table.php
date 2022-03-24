<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNFTSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('n_f_t_s', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->float('base_price');
            $table->date('limit_date')->nullable();
            $table->boolean('available');
            $table->float('actual_price');
            $table->foreignId('collection_id')->constrained('collections')->onDelete('cascade');
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('cascade');
            $table->foreignId('type_id')->constrained('types')->onDelete('cascade');
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
        Schema::dropIfExists('n_f_t_s');
    }
}
