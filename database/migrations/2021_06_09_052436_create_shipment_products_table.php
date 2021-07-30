
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateShipmentProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("shipment_products", function (Blueprint $table) {

						$table->bigInteger('shipment_id')->unsigned();
						$table->bigInteger('order_product_id')->unsigned();
						$table->timestamps();
						$table->softDeletes();
						$table->unique(['shipment_id', 'order_product_id']);
                        
						$table->foreign("shipment_id")->references("id")->on("shipments");
						$table->foreign("order_product_id")->references("id")->on("order_products");



						// ----------------------------------------------------
						// -- SELECT [shipment_items]--
						// ----------------------------------------------------
						// $query = DB::table("shipment_items")
						// ->leftJoin("shipments","shipments.id", "=", "shipment_items.shipment_id")
						// ->leftJoin("order_items","order_items.id", "=", "shipment_items.order_item_id")
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
                Schema::dropIfExists("shipment_products");
            }
        }
    