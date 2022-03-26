<?php

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
        Schema::create('transaction', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('meja_id');
            $table->string('transaction_id');
            $table->unsignedBigInteger('product_id')->nullable();
            $table->string('product_name');
            $table->string('customer_name');
            $table->string('buy_price');
            $table->string('quantity');
            $table->enum('method', ['cash', 'midtrans']);
            $table->string('total_price');
            $table->enum('status', ['1', '2', '3']);
            $table->string('buy_date');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDeleteCascade();
            $table->foreign('product_id')->references('id')->on('product')->onDelete('sett null');
            $table->foreign('meja_id')->references('id')->on('meja')->onDeleteCascade();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Schema::drop('Transaction');
        Schema::disableForeignKeyConstraints();
        Schema::dropIfExists('transaction');
        Schema::enableForeignKeyConstraints();

        // Schema::table('transactions', function (Blueprint $table) {
        //     $table->dropForeign(['transaction_product_id_foreign']);
        //     $table->foreign('product_id')
        //         ->references('id')->on('product')
        //         ->onDelete('cascade')
        //         ->change();
        // });
    }
};
