<?php

return array(

	'name' 				=> 'Ti Kwen Pam Mizik',
	'url'				=> $_ENV['SITE_URL'],
	'description' 		=> 'Rezo Sosyal Mizik Ayisyen',
	'mp3_upload_path' 	=> 'uploads/mp3s',
	'image_upload_path' => 'uploads/images',
	'twitter'			=> 'tkpmizik',
	'404img'			=> '/images/404.png',

	'validate'			=> [
		'name'		=> [
			'required' 	=> 'Non an obligatwa. Fòk ou mete li.',
			'min'		=> 'Fòk non an pa pi piti pase 6 karaktè. Ajoute plis pase 6.'
		],
		'email'		=> [
			'required'	=> 'Imel la obligatwa. Fòk ou mete li.',
			'email'		=> 'Imel ou antre pa bon. Fòk ou mete yon bon imel.',
			'different'	=> 'Ou pa dwe antre menm bagay pou w non ou kòm imel. Fòk ou mete yon lòt imel oubyen chanje non ou.'
		],
		'password'		=> [
			'required'	=> 'Modpas la obligatwa. Fòk ou mete li.',
			'same'		=> 'Dezyèm modpas ou mete a pa menm ak premye a. Fòk tou 2 menm.',
			'min'		=> 'Fòk modpas la pa pi piti pase 6 karaktè. Ajoute plis pase 6.'
		],
		'image'		=> [
			'image.required' 	=> 'Fòk ou chwazi yon imaj pou asosye ak mizik la.',
			'image.image'		=> 'Fòk ou chwazi yon bon imaj.'
		],
		'telephone'	=> [
			'numeric'	=> 'Fòk nimewo telefòn ou antre a gen chif sèlman. Li pa dwe gen espas oubyen lòt karaktè.'
		],
		'mp3'		=> [
			'required'	=> 'Fòk ou chwazi yon fichye MP3.'
		]
	],

	'message'		=> [
		'konekte'	=>	'Fòk ou konekte pou w aksede ak paj ou vle a.',
		'admin'		=> 'Ou pa otorize pou w aksede ak paj ou vle a.'
	]
);