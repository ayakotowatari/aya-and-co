
    <?php
        use Illuminate\Support\Facades\Schema;
        use Illuminate\Database\Schema\Blueprint;
        use Illuminate\Database\Migrations\Migration;
        
        class CreateUsersTable extends Migration
        {
            /**
             * Run the migrations.
             *
             * @return void
             */
            public function up()
            {
                Schema::create("users", function (Blueprint $table) {

						$table->bigIncrements('id')->unsigned();
                        $table->bigInteger('user_type_id')->unsigned()->nullable();
						$table->string('name',191);
                        $table->string('kana',191);
                        $table->integer('zipcode');
						$table->string('prefecture',11);
						$table->string('city',191);
						$table->string('address_1',191);
						$table->string('address_2',191)->nullable();
						$table->string('building',191)->nullable();
						$table->string('phone',20);
						$table->string('email',191);
						$table->timestamp('email_verified_at')->nullable();
						$table->string('password',191);
						$table->integer('life')->nullable(); //0: 退会, 1: 現在会員
						$table->string('remember_token',100)->nullable();
						$table->timestamps();
						$table->softDeletes();
                        $table->unique('email');

                        $table->foreign("user_type_id")->references("id")->on("user_types");



						// ----------------------------------------------------
						// -- SELECT [users]--
						// ----------------------------------------------------
						// $query = DB::table("users")
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
                Schema::dropIfExists("users");
            }
        }
    