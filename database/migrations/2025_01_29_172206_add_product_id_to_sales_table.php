<?php

use App\Models\Sale;
use App\Models\Product;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->foreignIdFor(\App\Models\Product::class, 'product_id')
                ->nullable()
                ->after('user_id');
        });

        // update existing rows with the correct product id
        $goldCoffee =Product::where('name', 'Gold Coffee')->first();
        if ($goldCoffee) {
            Sale::where('product_name', $goldCoffee->name)->update(['product_id' => $goldCoffee->id]);
        }

        // now drop the product_name column
        // and make product_id not nullable
        Schema::table('sales', function (Blueprint $table) {
            $table->dropColumn('product_name');
            $table->string('product_id')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function (Blueprint $table) {
            $table->dropConstrainedForeignId('product_id');
        });
    }
};
