
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateGshipmentsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("gshipments", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('gorder_id')->unsigned();
						$table->bigInteger('package_id')->nullable()->unsigned();
						$table->bigInteger('guest_address_id')->unsigned();
						$table->string('shipment_date',191)->nullable();
						$table->string('delivery_time',191)->nullable();
						$table->bigInteger('courier_id')->nullable()->unsigned();
						$table->integer('postage')->nullable();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("gorder_id")->references("id")->on("gorders");
						$table->foreign("package_id")->references("id")->on("packages");
						$table->foreign("guest_address_id")->references("id")->on("guest_addresses");
						$table->foreign("courier_id")->references("id")->on("couriers");



						// ----------------------------------------------------
						// -- SELECT [guest_shipments]--
						// ----------------------------------------------------
						// $query = DB::table("guest_shipments")
						// ->leftJoin("guest_orders","guest_orders.id", "=", "guest_shipments.guest_order_id")
						// ->leftJoin("packages","packages.id", "=", "guest_shipments.package_id")
						// ->leftJoin("guest_addresses","guest_addresses.id", "=", "guest_shipments.guest_address_id")
						// ->leftJoin("couriers","couriers.id", "=", "guest_shipments.courier_id")
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
                Schema::dropIfExists("gshipments");
            }
        }
    