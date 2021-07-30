
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreatePackageInventoriesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("package_inventories", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('package_id')->nullable()->unsigned();
						$table->integer('quantity')->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("package_id")->references("id")->on("packages");



						// ----------------------------------------------------
						// -- SELECT [package_inventories]--
						// ----------------------------------------------------
						// $query = DB::table("package_inventories")
						// ->leftJoin("packages","packages.id", "=", "package_inventories.package_id")
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
                Schema::dropIfExists("package_inventories");
            }
        }
    