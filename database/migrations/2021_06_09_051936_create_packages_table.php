
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreatePackagesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("packages", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();;
						$table->string('name',191)->nullable();
						$table->string('slug',191)->nullable();
						$table->string('details',191)->nullable();
						$table->text('description')->nullable();
						$table->integer('sustainability_rating')->nullable();
						$table->integer('price')->nullable();
                        $table->string('image',191)->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [packages]--
						// ----------------------------------------------------
						// $query = DB::table("packages")
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
                Schema::dropIfExists("packages");
            }
        }
    