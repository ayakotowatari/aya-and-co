
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGordersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("gorders", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('guest_id')->unsigned();
						$table->bigInteger('billing_address_id')->unsigned();
						$table->integer('total')->nullable();
						$table->string('transaction_id',191)->nullable(); //for stripe
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("guest_id")->references("id")->on("guests");
						$table->foreign("billing_address_id")->references("id")->on("guest_addresses");



						// ----------------------------------------------------
						// -- SELECT [guest_orders]--
						// ----------------------------------------------------
						// $query = DB::table("guest_orders")
						// ->leftJoin("guests","guests.id", "=", "guest_orders.guest_id")
						// ->leftJoin("guest_addresses","guest_addresses.id", "=", "guest_orders.billing_address_id")
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
                Schema::dropIfExists("gorders");
            }
        }
    