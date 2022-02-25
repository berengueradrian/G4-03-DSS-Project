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
            $table->boolean('exclusive');
            $table->date('limit_date');
            $table->boolean('available');
            $table->float('actual_price');
            $table->foreignId('collection_id')->constrained('collections');
            $table->foreignId('user_id')->nullable()->constrained('users');
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
