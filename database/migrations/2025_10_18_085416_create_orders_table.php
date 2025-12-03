<?php
// database/migrations/xxxx_xx_xx_create_orders_table.php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
  public function up(): void
  {
    Schema::create('orders', function (Blueprint $table) {
      $table->id();
      $table->string('order_number')->unique()->after('id');
      $table->foreignId('user_id')->constrained()->onDelete('cascade');
      $table->string('guest_name')->nullable();
      $table->string('guest_email')->nullable();
      $table->string('guest_phone')->nullable();
      $table->text('shipping_address');
      $table->string('payment_method');
      $table->string('razorpay_payment_id')->nullable();
$table->string('razorpay_order_id')->nullable();
$table->string('razorpay_signature')->nullable();

      $table->decimal('subtotal', 10, 2);
      $table->decimal('cod_charges', 10, 2)->nullable()->after('subtotal')->comment('Extra charge for COD orders');
      $table->decimal('total', 10, 2);
      $table->string('status')->default('pending');
       $table->string('refund_status')->nullable()->after('status');
      $table->string('courier_name')->nullable();
      $table->string('tracking_number')->nullable();
      $table->string('courier_link')->nullable();
      $table->string('invoice_pdf')->nullable();

      $table->timestamps();
    });
  }

  public function down(): void
  {
    Schema::dropIfExists('orders');
  }
};
