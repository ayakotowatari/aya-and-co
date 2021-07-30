
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGorderProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("gorder_products", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('gorder_id')->unsigned();
						$table->bigInteger('product_id')->unsigned();
						$table->integer('quantity')->nullable();
						$table->integer('price')->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("gorder_id")->references("id")->on("gorders");
						$table->foreign("product_id")->references("id")->on("products");



						// ----------------------------------------------------
						// -- SELECT [guest_order_products]--
						// ----------------------------------------------------
						// $query = DB::table("guest_order_products")
						// ->leftJoin("guest_orders","guest_orders.id", "=", "guest_order_products.guest_order_id")
						// ->leftJoin("products","products.id", "=", "guest_order_products.product_id")
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
                Schema::dropIfExists("gorder_products");
            }
        }
    