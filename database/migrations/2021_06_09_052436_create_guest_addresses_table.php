
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGuestAddressesTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("guest_addresses", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('guest_id')->unsigned();
                        $table->interger('type');
						$table->string('name',191);
						$table->string('kana',191);
						$table->integer('zipcode');
						$table->string('prefecture',191);
						$table->string('city',191);
						$table->string('address_1',191);
						$table->string('address_2',191)->nullable();
						$table->string('building',191)->nullable();
						$table->integer('phone');
                        $table->string('delivery_time');
                        $table->integer('postage')->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("guest_id")->references("id")->on("guests");

						// ----------------------------------------------------
						// -- SELECT [guest_addresses]--
						// ----------------------------------------------------
						// $query = DB::table("guest_addresses")
						// ->leftJoin("guests","guests.id", "=", "guest_addresses.guest_id")
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
                Schema::dropIfExists("guest_addresses");
            }
        }
    