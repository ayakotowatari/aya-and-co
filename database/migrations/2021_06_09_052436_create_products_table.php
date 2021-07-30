
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateProductsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("products", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->integer('sku')->nullable();
						$table->string('name',191)->nullable();
						$table->string('slug',191)->nullable();
						$table->string('details',191)->nullable();
						$table->text('description')->nullable();
                        $table->string('season',191)->nullable();
						$table->string('size',11)->nullable();
						$table->integer('price')->nullable();
						$table->bigInteger('category_id')->nullable()->unsigned();
						$table->bigInteger('brand_id')->nullable()->unsigned();
						$table->string('image',191)->nullable();
						$table->integer('inventory',11)->nullable();
                        $table->bigInteger('status_id')->unsigned();
						$table->timestamps();
						$table->softDeletes();
                        $table->unique('slug');

						$table->foreign("category_id")->references("id")->on("product_categories");
						$table->foreign("brand_id")->references("id")->on("brands");
                        $table->foreign("status_id")->references("id")->on("statuses");


						// ----------------------------------------------------
						// -- SELECT [products]--
						// ----------------------------------------------------
						// $query = DB::table("products")
						// ->leftJoin("product_categories","product_categories.id", "=", "products.category_id")
						// ->leftJoin("brands","brands.id", "=", "products.brand_id")
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
                Schema::dropIfExists("products");
            }
        }
    