<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class NoticeSeeder extends Seeder
{
	public function run()
	{
		$model = model('Notice');
		
		$model->insert([
			 'n_subject' => static::faker()->name,
			 'n_body'=> static::faker()->text,
			 'n_status' => 2,
			 'n_signed_by' => 1,
		      'n_by'=> 1
			
		]);
		
		$model->insert([
			'n_subject' => static::faker()->name,
			'n_body'=> static::faker()->text,
			'n_status' => 2,
			'n_signed_by' => 1,
			'n_by'=> 1
		
		]);
		
		$model->insert([
			'n_subject' => static::faker()->name,
			'n_body'=> static::faker()->text,
			'n_status' => 3,
			'n_signed_by' => 1,
			'n_by'=> 1
		
		]);
		
		$model->insert([
			'n_subject' => static::faker()->name,
			'n_body'=> static::faker()->text,
			'n_status' => 3,
			'n_signed_by' => 1,
			'n_by'=> 1
		
		]);
	}
}
