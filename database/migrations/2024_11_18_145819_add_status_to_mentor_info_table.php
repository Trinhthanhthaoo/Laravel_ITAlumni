<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStatusToMentorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_info', function (Blueprint $table) {
            $table->string('status', 50)->default('PENDING')->after('achievements'); // Giá trị mặc định là PENDING
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
            $table->dropColumn('status');
        });
    }
}
