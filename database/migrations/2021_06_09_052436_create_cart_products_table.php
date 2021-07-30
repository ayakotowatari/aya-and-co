
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateCartProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("cart_products", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('cart_id')->unsigned();
						$table->bigInteger('product_id')->unsigned();
						$table->integer('quantity');
						$table->integer('price');
						$table->timestamps();
						$table->softDeletes();
                        
						$table->foreign("cart_id")->references("id")->on("carts");
						$table->foreign("product_id")->references("id")->on("products");



						// ----------------------------------------------------
						// -- SELECT [cart_items]--
						// ----------------------------------------------------
						// $query = DB::table("cart_items")
						// ->leftJoin("carts","carts.id", "=", "cart_items.cart_id")
						// ->leftJoin("products","products.id", "=", "cart_items.product_id")
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
                Schema::dropIfExists("cart_products");
            }
        }
    