// database/migrations/YYYY_MM_DD_update_restaurants_table.php
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateRestaurantsTable extends Migration
{
    public function up()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            if (!Schema::hasColumn('restaurants', 'user_id')) {
                $table->foreignId('user_id')->constrained();
            }
            if (!Schema::hasColumn('restaurants', 'slug')) {
                $table->string('slug')->unique();
            }
            if (!Schema::hasColumn('restaurants', 'background_color')) {
                $table->string('background_color')->default('#ffffff');
            }
            if (!Schema::hasColumn('restaurants', 'text_color')) {
                $table->string('text_color')->default('#000000');
            }
            if (!Schema::hasColumn('restaurants', 'button_color')) {
                $table->string('button_color')->default('#3490dc');
            }
            if (!Schema::hasColumn('restaurants', 'logo')) {
                $table->string('logo')->nullable();
            }
        });
    }

    public function down()
    {
        Schema::table('restaurants', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn(['user_id', 'slug', 'background_color', 'text_color', 'button_color', 'logo']);
        });
    }
}