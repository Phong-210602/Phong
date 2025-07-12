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
       Schema::table('users', function (Blueprint $table){
        // $table->string('first_name', 30)->nullable();
        // $table->string('last_name', 30)->nullable();
        $table->string('email', 100)->change();
        $table->string('password', 255)->change();
        // $table->tinyInteger('status')->default(0);
       });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        //
    }
};
