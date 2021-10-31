<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->cascadeOnDelete();
            $table->string('type');
            $table->string('project_name')->nullable();
            $table->timestamp('appointment')->nullable();
            $table->string('status');
            $table->longText('cover_sheet');
            $table->longText('fee_receipt');
            $table->longText('contract');
            $table->longText('construction_permit');
            $table->longText('title_deed');
            $table->longText('map');
            $table->longText('plan')->nullable();
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
        Schema::dropIfExists('requests');
    }
}
