
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGuestsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("guests", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->string('name',191);
						$table->string('kana',191);
                        $table->interger('address_type');
						$table->integer('zipcode');
						$table->string('prefecture',191);
						$table->string('city',191);
						$table->string('address_1',191);
						$table->string('address_2',191)->nullable();
						$table->string('building',191)->nullable();
						$table->string('phone',20);
						$table->string('email',191);
                        $table->string('delivery_time');
						$table->timestamps();
						$table->softDeletes();



						// ----------------------------------------------------
						// -- SELECT [guests]--
						// ----------------------------------------------------
						// $query = DB::table("guests")
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
                Schema::dropIfExists("guests");
            }
        }
    