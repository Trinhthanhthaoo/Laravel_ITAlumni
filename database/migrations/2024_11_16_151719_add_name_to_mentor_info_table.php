<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNameToMentorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_info', function (Blueprint $table) {
            $table->string('name', 255)->after('id')->nullable(); // Thêm cột 'name' sau 'id'
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('mentor_info', function (Blueprint $table) {
            $table->dropColumn('name'); // Xóa cột 'name' nếu rollback
        });
    }
}
