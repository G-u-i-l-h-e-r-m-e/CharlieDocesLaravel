<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPasswordToUsuarioTable extends Migration
{
    public function up()
    {
        Schema::table('USUARIO', function (Blueprint $table) {
            $table->string('password')->nullable();
        });
    }

    public function down()
    {
        Schema::table('USUARIO', function (Blueprint $table) {
            $table->dropColumn('password');
        });
    }
}