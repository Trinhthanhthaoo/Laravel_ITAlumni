<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddImageToMentorInfoTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('mentor_info', function (Blueprint $table) {
            $table->string('image')->nullable()->after('name'); // Cột hình ảnh có thể để trống
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
            $table->dropColumn('image'); // Xóa cột nếu rollback
        });
    }
}
