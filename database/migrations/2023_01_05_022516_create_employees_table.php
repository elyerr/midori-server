<?php

use App\Enum\EnumType;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100);
            $table->string('last_name', 100);
            $table->string('email', 100)->unique();
            $table->string('password');
            $table->enum('document_type', EnumType::documento_type());
            $table->string('document_number', 12);
            $table->string('country', 100);
            $table->string('department', 100);
            $table->string('address', 150);
            $table->string('phone', 15);
            //$table->rememberToken();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('employees');
    }
};
