
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateOrdersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("orders", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
						$table->bigInteger('user_id')->nullable()->unsigned();
                        $table->bigInteger('guest_id')->nullable()->unsigned();
						// $table->bigInteger('address_id')->nullable()->unsigned();
                        // $table->bigInteger('guest_address_id')->nullable()->unsigned();
                        $table->string('delivery_name',191);
                        $table->string('delivery_kana',191);
                        $table->integer('delivery_zipcode');
                        $table->string('delivery_prefecture',11);
                        $table->string('delivery_city',191);
                        $table->string('delivery_address_1',191);
                        $table->string('delivery_address_2',191)->nullable();
                        $table->string('delivery_building',191)->nullable();
                        $table->string('delivery_phone',20);
                        $table->string('delivery_time',191);
                        $table->text('message')->nullable();
                        $table->integer('postage')->nullable();
                        $table->integer('item_total')->nullable();
						$table->integer('total')->nullable();
						$table->string('transaction_id',191)->nullable(); //for stripe
						$table->bigInteger('status_id')->unsigned();
						$table->text('note')->nullable();
                        $table->timestamps();
						$table->softDeletes();

						$table->foreign("user_id")->references("id")->on("users");
                        $table->foreign("guest_id")->references("id")->on("guests");
						// $table->foreign("address_id")->references("id")->on("addresses");
                        // $table->foreign("guest_address_id")->references("id")->on("guest_addresses");
                        $table->foreign("status_id")->references("id")->on("statuses");



						// ----------------------------------------------------
						// -- SELECT [orders]--
						// ----------------------------------------------------
						// $query = DB::table("orders")
						// ->leftJoin("users","users.id", "=", "orders.user_id")
						// ->leftJoin("addresses","addresses.id", "=", "orders.billing_address_id")
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
                Schema::dropIfExists("orders");
            }
        }
    