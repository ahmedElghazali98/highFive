<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStoreTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('store_item', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('store_id'); //المخزن
            $table->Integer('item_id'); //الصنف
            $table->double('quantity'); // الكمية
            $table->double('min_quantity'); // حد الأدنى
            $table->double('max_quantity'); // الحد الأقصى
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
        });

        Schema::create('store_item_transaction_log', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('store_id'); //المخزن
            $table->Integer('item_id'); //الصنف
            $table->Integer('transaction_id'); //رقم الفاتورة
            $table->Integer('transaction_type'); //نوع الحركة
            $table->double('quantity'); // الكمية سالب و موجب
            $table->double('price'); // السعر
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
        });

        Schema::create('store_bills', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('store_id'); //المخزن
            $table->Integer('bill_no'); //رقم تسلسلي للفاتورة
            $table->string('statement'); //البيان
            $table->Integer('type'); //نوع الفاتورة
            $table->double('total_price'); // الاجمالي
            $table->double('discount'); // الخصم
            $table->Integer('supplier_id'); // المورد
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
        });

        Schema::create('store_bills_details', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('bill_id'); // رقم الفاتورة
            $table->Integer('item_id'); //الصنف
            $table->double('quantity'); // الكمية
            $table->double('price'); // السعر
            $table->Integer('tax_id'); // الضريبة
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
        });

        Schema::create('tax_category', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('name'); // اسم الضريبة
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('taxes', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->string('name'); // اسم الضريبة
            $table->Integer('category'); // تصنيف الضريبة
            $table->Integer('parent_id')->nullable();
            $table->double('rate'); // النسبة
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
            $table->timestamps();
            $table->softDeletes();
        });

        Schema::create('store_tax_bill', function (Blueprint $table) {
            $table->charset = 'utf8';
            $table->collation = 'utf8_general_ci';
            $table->Increments('id');
            $table->Integer('bill_id'); // رقم الفاتورة
            $table->Integer('tax_id'); // رقم الضريبة من جدول taxes
            $table->double('total'); // قيمة الفاتورة دون الضريبة
            $table->double('tax_amount'); // قيمة الفاتورة
            $table->Integer('user_id'); // المستخدم
            $table->Integer('company_id'); // الشركة
            $table->Integer('serial'); //
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
        Schema::dropIfExists('store_item');
        Schema::dropIfExists('store_item_transaction_log');
        Schema::dropIfExists('store_bills');
        Schema::dropIfExists('store_bills_details');
        Schema::dropIfExists('tax_category');
        Schema::dropIfExists('taxes');
        Schema::dropIfExists('store_tax_bill');
    }
}
