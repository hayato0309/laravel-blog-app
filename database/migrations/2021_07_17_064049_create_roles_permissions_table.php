<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesPermissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_role', function (Blueprint $table) {
            $table->primary(['permission_id', 'role_id']); // 複合キーの追加（primary()に複数の引数を渡して、その組み合わせがUniqueであることを確かめる）
            $table->unsignedBigInteger('permission_id')->constrained()->onDelete('cascade');
            $table->unsignedBigInteger('role_id')->constrained()->onDelete('cascade');

            $table->foreign('permission_id')->references('id')->on('permissions');
            $table->foreign('role_id')->references('id')->on('roles');

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
        Schema::dropIfExists('permission_role');
    }
}
