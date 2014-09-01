<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShema extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('roles', function($table){
			$table->increments('id');
			$table->string('name',50);
			$table->string('description',50)->nullable();
		});

		Schema::create('types_projects', function($table){
			$table->increments('id');
			$table->string('name',50);
			$table->string('description',50)->nullable();
		});

		Schema::create('types_activities', function($table){
			$table->increments('id');
			$table->string('name',50);
			$table->string('description',50)->nullable();
		});

		Schema::create('customers', function($table){
			$table->increments('id');
			$table->string('name',255);
			$table->string('rif',15)->nullable();
			$table->string('email',50);
			$table->string('phone',15)->nullable();
			$table->string('locality',255);
			$table->string('logo',255)->nullable();
			$table->string('phone_contact',15);
			$table->string('person_contact',255);
		});

		Schema::create('users', function($table){
	        $table->increments('id');
	        $table->integer('role_id')->unsigned();
	        $table->string('email',50)->unique();
	        $table->string('password',255);
	        $table->integer('status');
	        $table->integer('flag');
	        $table->string('remember_token',100)->nullable();
	        $table->timestamps();
    	});

    	Schema::create('employees', function($table){
	        $table->integer('user_id')->unique()->unsigned();
	        $table->string('first_name',100);
	        $table->string('last_name',100);
	        $table->string('ident_card',15);
	        $table->string('phone_local',15)->nullable();
	        $table->string('phone_cel',15)->nullable();
	        $table->string('address',255)->nullable();
	        $table->string('civil_status',15)->nullable();
	        $table->date('date_birth')->nullable();
	        $table->string('sex',15)->nullable();
	        $table->string('profession',100)->nullable();
	        $table->string('specialty',100)->nullable();
	        $table->string('photo',255)->nullable();
	        $table->string('curriculum',255)->nullable();
	        $table->primary('user_id');
    	});

    	Schema::create('projects', function($table){
	        $table->increments('id');
	        $table->integer('user_id')->unsigned();
	        $table->integer('types_project_id')->unsigned();
	        $table->integer('customer_id')->unsigned();
	        $table->string('description',255);
	        $table->string('status',50);
	        $table->double('amount_contract');
	        $table->string('document_budget',255)->nullable();
	        $table->string('name',255);
	        $table->string('locality',255);
	        $table->timestamp('date_create');
	        $table->timestamp('date_end')->nullable();
    	});

    	Schema::create('activities', function($table){
	        $table->increments('id');
	        $table->integer('types_activitie_id')->unsigned();
	        $table->integer('project_id')->unsigned();
	        $table->integer('user_id')->unsigned();
	        $table->string('description',255);
	        $table->string('status',50);
	        $table->timestamp('date_create');
	        $table->timestamp('date_proposal');
	        $table->timestamp('date_end')->nullable();
    	});

    	Schema::create('records', function($table){
	        $table->increments('id');
	        $table->integer('project_id')->unsigned();
	        $table->string('status',50);
	        $table->string('comment',255);
	        $table->timestamp('date_create');
    	});

    	Schema::create('documents_projects', function($table){
	        $table->increments('id');
	        $table->integer('project_id')->unsigned();
	        $table->string('attached',255);
	        $table->string('description',255);
	        $table->timestamps();
    	});

    	Schema::create('documents_activities', function($table){
	        $table->increments('id');
	        $table->integer('activitie_id')->unsigned();
	        $table->string('attached',255);
	        $table->string('description',255);
	        $table->timestamps();
    	});

    	Schema::create('project_user', function($table){
			$table->integer('project_id')->unsigned();
			$table->integer('user_id')->unsigned();
			$table->timestamp('date_create');
			$table->primary(array('project_id', 'user_id'));
		});

		Schema::table('users', function($table) {
        	$table->foreign('role_id')->references('id')->on('roles');
    	});

    	Schema::table('projects', function($table) {
        	$table->foreign('types_project_id')->references('id')->on('types_projects');
        	$table->foreign('customer_id')->references('id')->on('customers');
        	$table->foreign('user_id')->references('id')->on('users');
    	});

    	Schema::table('activities', function($table) {
        	$table->foreign('types_activitie_id')->references('id')->on('types_activities');
        	$table->foreign('project_id')->references('id')->on('projects');
        	$table->foreign('user_id')->references('id')->on('users');
    	});

    	Schema::table('employees', function($table) {
        	$table->foreign('user_id')->references('id')->on('users');
    	});

    	Schema::table('records', function($table) {
        	$table->foreign('project_id')->references('id')->on('projects');
    	});

    	Schema::table('documents_projects', function($table) {
        	$table->foreign('project_id')->references('id')->on('projects');
    	});

    	Schema::table('documents_activities', function($table) {
        	$table->foreign('activitie_id')->references('id')->on('activities');
    	});

    	Schema::table('project_user', function($table) {
        	$table->foreign('project_id')->references('id')->on('projects');
        	$table->foreign('user_id')->references('id')->on('users');
    	});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('users', function($table) {
                $table->dropForeign('users_role_id_foreign');
        });

        Schema::table('projects', function($table) {
                $table->dropForeign('projects_types_project_id_foreign');
                $table->dropForeign('projects_customer_id_foreign');
                $table->dropForeign('projects_user_id_foreign');
        });

        Schema::table('activities', function($table) {
                $table->dropForeign('activities_types_activitie_id_foreign');
                $table->dropForeign('activities_project_id_foreign');
                $table->dropForeign('activities_user_id_foreign');
        });

        Schema::table('employees', function($table) {
                $table->dropForeign('employees_user_id_foreign');
        });

        Schema::table('records', function($table) {
                $table->dropForeign('records_project_id_foreign');
        });

        Schema::table('documents_projects', function($table) {
                $table->dropForeign('documents_projects_project_id_foreign');
        });

        Schema::table('documents_activities', function($table) {
                $table->dropForeign('documents_activities_activitie_id_foreign');
        });

        Schema::table('project_user', function($table) {
                $table->dropForeign('project_user_project_id_foreign');
                $table->dropForeign('project_user_user_id_foreign');
        });
		
		Schema::dropIfExists('roles');

		Schema::dropIfExists('types_projects');

		Schema::dropIfExists('types_activities');

		Schema::dropIfExists('customers');

		Schema::dropIfExists('users');

		Schema::dropIfExists('employees');

		Schema::dropIfExists('projects');

		Schema::dropIfExists('activities');

		Schema::dropIfExists('records');

		Schema::dropIfExists('documents_projects');

		Schema::dropIfExists('documents_activities');

		Schema::dropIfExists('project_user');


	}

}
