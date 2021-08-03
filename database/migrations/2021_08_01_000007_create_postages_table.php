
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreatePostagesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("postages", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('courier_id')->nullable()->unsigned();
						$table->string('prefecture',191)->nullable();
						$table->integer('postage');
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("courier_id")->references("id")->on("couriers");



						// ----------------------------------------------------
						// -- SELECT [postages]--
						// ----------------------------------------------------
						// $query = DB::table("postages")
						// ->leftJoin("couriers","couriers.id", "=", "postages.courier_id")
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
                Schema::dropIfExists("postages");
            }
        }
    