<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number');
            $table->date('invoice_date')->nullable();
            $table->date('due_date')->nullable();
            $table->string('product');
            $table->unsignedBigInteger('department_id');
            $table->foreign('department_id')->references('id')->on('departments')->onDelete('CASCADE');
            $table->decimal('collection_amount')->nullable();
            $table->decimal('commission_value');
            $table->decimal('discount');
            $table->string('tax_rate');
            $table->decimal('tax_value',8,2);
            $table->decimal('total',8,2);
            $table->enum('status', ['paid','unpaid','partly paid'])->default('unpaid');
            $table->integer('status_value')->default(2);
            $table->text('note')->nullable();
            $table->date('payment_date')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('invoices');
    }
}
