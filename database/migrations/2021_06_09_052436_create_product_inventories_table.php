
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateProductInventoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("product_inventories", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('product_id')->nullable()->unsigned();
						$table->integer('quantity')->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("product_id")->references("id")->on("products");



						// ----------------------------------------------------
						// -- SELECT [product_inventories]--
						// ----------------------------------------------------
						// $query = DB::table("product_inventories")
						// ->leftJoin("products","products.id", "=", "product_inventories.product_id")
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
                Schema::dropIfExists("product_inventories");
            }
        }
    