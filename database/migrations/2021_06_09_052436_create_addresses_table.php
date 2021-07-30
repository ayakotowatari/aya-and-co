
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateAddressesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("addresses", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('user_id')->unsigned();
                        $table->interger('type');
						$table->string('name',191);
						$table->string('kana',191);
						$table->integer('zipcode');
						$table->string('prefecture',11);
						$table->string('city',191)->nullable();
						$table->string('address_1',191);
						$table->string('address_2',191)->nullable();
						$table->string('building',191)->nullable();
						$table->string('phone', 20);
                        $table->string('delivery_time',191)->nullable();
                        $table->integer('postage')->nullable();
						$table->integer('life')->nullable();
						$table->timestamps();
						$table->softDeletes();
						

                    //*********************************
                    // Foreign KEY [ Uncomment if you want to use!! ]
                    //*********************************
                        $table->foreign("user_id")->references("id")->on("users");



						// ----------------------------------------------------
						// -- SELECT [addresses]--
						// ----------------------------------------------------
						// $query = DB::table("addresses")
						// ->leftJoin("users","users.id", "=", "addresses.user_id")
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
                Schema::dropIfExists("addresses");
            }
        }
    