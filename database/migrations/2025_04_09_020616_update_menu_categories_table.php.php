// database/migrations/YYYY_MM_DD_update_menu_categories_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateMenuCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            if (!Schema::hasColumn('menu_categories', 'menu_type_id')) {
                $table->foreignId('menu_type_id')->after('id')->constrained()->onDelete('cascade');
            }
            if (!Schema::hasColumn('menu_categories', 'display_order')) {
                $table->integer('display_order')->default(0);
            }
        });
    }

    public function down()
    {
        Schema::table('menu_categories', function (Blueprint $table) {
            $table->dropForeign(['menu_type_id']);
            $table->dropColumn(['menu_type_id', 'display_order']);
        });
    }
}