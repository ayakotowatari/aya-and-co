
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGshipmentProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("gshipment_products", function (Blueprint $table) {

						$table->bigInteger('gshipment_id')->unsigned();
						$table->bigInteger('gorder_product_id')->unsigned();
						$table->timestamps();
						$table->softDeletes();
						$table->unique(['gshipment_id', 'gorder_product_id']);

						$table->foreign("gshipment_id")->references("id")->on("gshipments");
						$table->foreign("gorder_product_id")->references("id")->on("gorder_products");



						// ----------------------------------------------------
						// -- SELECT [guest_shipment_items]--
						// ----------------------------------------------------
						// $query = DB::table("guest_shipment_items")
						// ->leftJoin("guest_shipments","guest_shipments.id", "=", "guest_shipment_items.guest_shipment_id")
						// ->leftJoin("guest_order_items","guest_order_items.id", "=", "guest_shipment_items.guest_order_item_id")
						// ->get();
						// dd($query); //For checking



                });
            }

            /**
             * Reverse the migrations.
             *
             * @return void
             */
            public function down()
            {
                Schema::dropIfExists("gshipment_products");
            }
        }
    