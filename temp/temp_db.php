<?
function getPDO()
{	
	$PDO = new PDO("mysql:host=localhost;dbname=" . DB_NAME, DB_USER, DB_PASSWORD);  
	$PDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	return $PDO;
}



class Temp 
{
	public $DBH;

	function __construct()
	{
		$this->DBH = getPDO();
	}

	function getAll($query, $data = Array())
	{
		$STH = $this->DBH->prepare($query);
		$STH->execute($data);
		$ret = array();

		while($res = $STH->fetch(PDO::FETCH_ASSOC)){
			$ret[] = $res;
		}		
		
		return $ret;	
	}

	function insert($params)
	{
		$table = $params['table'];
		$fields = $params['fields'];
		$data = Array();
		$keys = Array();

		foreach($fields as $key => $value)
		{
			$data[':'.$key] = $value;
		}

		$STH = $this->DBH->prepare('INSERT INTO ' . $table . '(' . implode(",",array_keys($fields)) .') VALUES (' . implode(',',array_keys($data)) . ')');
		$STH->execute($data);

		return $this->DBH->lastInsertId();
	}
}


//go();

function go()
{
	$resize_data = Array();

	if(is_admin()) return false;

	require_once( ABSPATH . 'wp-admin/includes/image.php' );
	// $DB = new Temp;

	$arGalleries = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/wp-content/themes/yanni/galleries.json'));
	$arImages = json_decode(file_get_contents($_SERVER['DOCUMENT_ROOT'] .'/wp-content/themes/yanni/imgs.json'));

	$count_gals = 0;
	$count_imgs = 0;

	for($i = 0; $i < 100; $i++)
	{		
		$item = $arGalleries[$i];
		if(empty($item)) return false;

		switch($item->category_id)
		{
			case 2: $post_type = 'design'; break;
			case 3: $post_type = 'venue'; break;
			case 4: $post_type = 'recent'; break;
		}

		$PARENT_POST = wp_insert_post(array( 
			'post_title' => $item->name,
			'post_name' => $item->slug,
			'post_status' => 'publish',
			'post_author' => 1,
			'post_type' => $post_type,
		));

		$gal_imgs = array_filter($arImages, function($imag) use ($item)
		{
			return $imag->gallery_id == $item->id;
		});

		$cnt = count($gal_imgs);
		$id_s = Array();

		for($iv = 0; $iv < $cnt; $iv++)
		{
			$gal_img = array_shift($gal_imgs);
			/**
			* Добавляем аттачмент в Медиатеку
			*/			$filename = "/wp-content/uploads/gallery/" . $gal_img->file_name;

			$filetype = wp_check_filetype( basename( $filename ), null );
			$attachment = array(
				'post_title' => $gal_img->title,
				'post_content' => $gal_img->descr,
				'post_excerpt' => $gal_img->alt,
				'guid' => $filename,
				'post_name' => $gal_img->slug,
				'post_mime_type' => $filetype['type'],
				'post_status' => 'publish',
				'post_author' => 1,
				'post_type' => 'attachment'
			);

			/**
			* Метаданные аттачмента
			*/

			$attach_id = wp_insert_attachment( $attachment, $filename, $PARENT_POST );
			update_post_meta( $attach_id, "_venue", $gal_img->venue_id );
			$resize_data[$attach_id] = Array($attach_id, ABSPATH .$filename);

			/** 
			* Добавили айдишник аттача
			*/

			$id_s[] = $attach_id;

			$count_imgs++;
			file_put_contents(ABSPATH . "/wp-content/themes/yanni/counters/from_imgs.json", $count_imgs);
		}

		if(count($id_s) > 0)
		{
			/**
			* Делаем галерею в контенте поста-галереи
			*/

			wp_update_post(Array(
		        'ID' => $PARENT_POST,
		        'post_content' => '<p>[gallery link="file" columns="9" ids="' . implode(",",$id_s).'"]</p>'
			));


			/**
			* Делаем превьюшку поста-галереи
			*/
			set_post_thumbnail( $PARENT_POST, $id_s[0] );
		}

		$count_gals++;
		file_put_contents(ABSPATH . "/wp-content/themes/yanni/counters/from_gals.json", $count_gals);
	}

	file_put_contents(ABSPATH . "/wp-content/themes/yanni/counters/resize_data.json", json_encode(ksort($resize_data)));
}




?>