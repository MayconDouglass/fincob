<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateContasTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('contas', function(Blueprint $table)
		{
			$table->integer('id', true);
			$table->char('tipo', 1)->comment('D = Despesas
R = Receitas T=Transferencias');
			$table->string('titulo', 100);
			$table->float('valor', 10, 0);
			$table->boolean('efetivado')->nullable();
			$table->integer('parcela')->nullable();
			$table->dateTime('data_conta')->nullable();
			$table->dateTime('data_efetivacao')->nullable();
			$table->dateTime('vencimento')->nullable();
			$table->integer('categoria_fk')->index('categorias');
			$table->integer('pasta_fk')->index('pastas');
		});
	}


	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('contas');
	}

}
