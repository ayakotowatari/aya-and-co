
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateOrderProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("order_products", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('order_id')->unsigned();
						$table->bigInteger('product_id')->unsigned();
						$table->integer('quantity')->nullable();
						$table->integer('price')->nullable();
						$table->timestamps();

						$table->foreign("order_id")->references("id")->on("orders");
						$table->foreign("product_id")->references("id")->on("products");



						// ----------------------------------------------------
						// -- SELECT [order_items]--
						// ----------------------------------------------------
						// $query = DB::table("order_items")
						// ->leftJoin("orders","orders.id", "=", "order_items.order_id")
						// ->leftJoin("products","products.id", "=", "order_items.product_id")
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
                Schema::dropIfExists("order_products");
            }
        }
    