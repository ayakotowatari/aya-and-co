
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateShipmentsTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("shipments", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('order_id')->unsigned();
						// $table->bigInteger('package_id')->unsigned();
						// $table->bigInteger('shipping_address_id')->unsigned();
						$table->string('scheduled_date',20)->nullable();; //from Vuetify calendar
						$table->string('actual_date',20)->nullable();; //from Vuetify calendar
						$table->string('delivery_time',191)->nullable();
                        $table->string('delivered_date',20)->nullable();
						$table->bigInteger('courier_id')->nullable()->unsigned();
						$table->integer('postage')->nullable();
						$table->bigInteger('status_id')->nullable()->unsigned();
						$table->timestamps();
						$table->softDeletes();

						$table->foreign("order_id")->references("id")->on("orders");
						// $table->foreign("package_id")->references("id")->on("packages");
						// $table->foreign("shipping_address_id")->references("id")->on("addresses");
						$table->foreign("courier_id")->references("id")->on("couriers");
                        $table->foreign("status_id")->references("id")->on("statuses");



						// ----------------------------------------------------
						// -- SELECT [shipments]--
						// ----------------------------------------------------
						// $query = DB::table("shipments")
						// ->leftJoin("orders","orders.id", "=", "shipments.order_id")
						// ->leftJoin("packages","packages.id", "=", "shipments.package_id")
						// ->leftJoin("packages","packages.id", "=", "shipments.package_id")
						// ->leftJoin("addresses","addresses.id", "=", "shipments.shipping_address_id")
						// ->leftJoin("couriers","couriers.id", "=", "shipments.courier_id")
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
                Schema::dropIfExists("shipments");
            }
        }
    