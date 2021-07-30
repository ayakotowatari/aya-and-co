
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateProductCategoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("product_categories", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('name',191)->nullable();
                        $table->string('subtitle',191)->nullable();
                        $table->string('details', 191)->nullable();
						$table->text('description')->nullable();
                        $table->string('season', 191)->nullable();
                        $table->text('ingredients')->nullable();
                        $table->string('image',191)->nullable();
                        $table->bigInteger('status_id')->unsigned();
						$table->timestamps();
						$table->softDeletes();

                        $table->foreign("status_id")->references("id")->on("statuses");



						// ----------------------------------------------------
						// -- SELECT [product_categories]--
						// ----------------------------------------------------
						// $query = DB::table("product_categories")
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
                Schema::dropIfExists("product_categories");
            }
        }
    