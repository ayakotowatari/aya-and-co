
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateBrandsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("brands", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('name',191)->nullable();
						$table->string('slug',191)->nullable();
						$table->text('description')->nullable();
                        $table->string('image',191)->nullable();
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [brands]--
						// ----------------------------------------------------
						// $query = DB::table("brands")
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
                Schema::dropIfExists("brands");
            }
        }
    