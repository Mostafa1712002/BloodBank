<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDonationRequestsTable extends Migration {

	public function up()
	{
		Schema::create('donation_requests', function(Blueprint $table) {
			$table->increments('id');
			$table->timestamps();
			$table->string('patient_name');
			$table->string('patient_phone')->unique();
			$table->integer('city_id')->unsigned();
			$table->integer('client_id')->unsigned();
			$table->string('hospital_name');
			$table->integer('blood_type_id')->unsigned();
			$table->integer('patient_age')->unsigned();
			$table->integer('bags_num');
			$table->string('hospital_address');
			$table->decimal('latitude', 10,8);
			$table->decimal('longitude', 10,8);
            $table -> integer("governorate_id")->unsigned();
		});
	}

	public function down()
	{
		Schema::drop('donation_requests');
	}
}
