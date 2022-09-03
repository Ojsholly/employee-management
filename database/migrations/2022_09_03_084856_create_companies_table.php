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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->uuid();
            $table->foreignUuid('user_id');
            $table->string('name')->unique();
            $table->string('email')->unique()->nullable();
            $table->string('website')->unique()->nullable();
            $table->timestamps();
            $table->softDeletes();

            $table->index(['uuid', 'user_id', 'name', 'email', 'website']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('companies');
    }
};
