<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateIklan extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sys_iklan', function($table) {
            $table->string('iklan_title')->nullable()->after('iklan_user_id')->comment('judul iklan');
            $table->string('iklan_image')->nullable()->after('iklan_title')->comment('gambar iklan banner');
            $table->string('iklan_status')->default(0)->after('iklan_image')->comment('status iklan 0 tidak aktif, 1 aktif');
            $table->integer('iklan_category_id')->default(0)->after('iklan_status')->comment('category iklan #sys_category');
            $table->string('iklan_link')->nullable()->after('iklan_category_id')->comment('link out #pincode active');
            $table->string('iklan_use')->default('0000-00-00 00:00:00')->after('iklan_link')->comment('tanggal dipakai');
            $table->string('iklan_done')->default('0000-00-00 00:00:00')->after('iklan_use')->comment('tanggal selesai');
            $table->string('iklan_content')->default(0)->after('iklan_done')->comment('content iklan baris');
        });
        Schema::table('log_iklan', function($table) {
            $table->string('iklan_jenis')->nullable()->after('iklan_iklan_id')->comment('jenis iklan (banner, baris, dll)');
            $table->string('iklan_title')->nullable()->after('iklan_jenis')->comment('judul iklan');
            $table->string('iklan_image')->nullable()->after('iklan_title')->comment('gambar iklan banner');
            $table->string('iklan_status')->default(0)->after('iklan_image')->comment('status iklan 0 tidak aktif, 1 aktif');
            $table->integer('iklan_category_id')->default(0)->after('iklan_status')->comment('id category iklan #sys_category');
            $table->string('iklan_category')->nullable()->after('iklan_category_id')->comment('category iklan #sys_category');
            $table->string('iklan_link')->nullable()->after('iklan_category')->comment('link out #pincode active');
            $table->string('iklan_use')->default('0000-00-00 00:00:00')->after('iklan_link')->comment('tanggal dipakai');
            $table->string('iklan_done')->default('0000-00-00 00:00:00')->after('iklan_use')->comment('tanggal selesai');
            $table->string('iklan_content')->default(0)->after('iklan_done')->comment('content iklan baris');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sys_iklan', function($table) {
            $table->dropColumn('iklan_title');
            $table->dropColumn('iklan_image');
            $table->dropColumn('iklan_status');
            $table->dropColumn('iklan_category_id');
            $table->dropColumn('iklan_link');
            $table->dropColumn('iklan_use');
            $table->dropColumn('iklan_done');
            $table->dropColumn('iklan_content');
        });
        Schema::table('log_iklan', function($table) {
            $table->dropColumn('iklan_jenis');
            $table->dropColumn('iklan_title');
            $table->dropColumn('iklan_image');
            $table->dropColumn('iklan_status');
            $table->dropColumn('iklan_category_id');
            $table->dropColumn('iklan_category');
            $table->dropColumn('iklan_link');
            $table->dropColumn('iklan_use');
            $table->dropColumn('iklan_done');
            $table->dropColumn('iklan_content');
        });
    }
}
