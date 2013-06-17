<?php

class Image {
	
	public $width;
	public $height;
	public $image_type;
	public $raw_image;
	
	private $image_path;
	
	private $convert_attributes = array();
	
	public function __construct($image, $convert_attributes = array()) 
	{
		
		$this->construct_from_file($image);
		
		$this->image_path = $image;
		$this->convert_attributes = $convert_attributes;
		
	}
	
	public function display($type = 'image/jpeg') 
	{

	}

	/**
	 * @param int $width
	 * @param int $height
	 * @return Image
	 */
	public function resize($width, $height)
	{
		if (!intval($height))
		{
			$ratio =  $width / $this->width;
			$last_y = $this->height * $ratio;
			$last_x = $width;
		}
		elseif (!intval($width))
		{
			$ratio = $height / $this->height;
			$last_x = $this->width * $ratio;
			$last_y = $height;
		}

		elseif ($width > $this->width && $height > $this->height)
		{
			return $this;
		}

		else 
		{
			if ($this->width > $this->height)
			{
				$last_x = $width;
				$last_y = $width / ($this->width / $this->height);
				if ($last_y > $height)
				{
					$last_y = $height;
					$last_x = $height / ($this->height / $this->width);
				}
			}
			else
			{
				$last_y = $height;
				$last_x = $height / ($this->height / $this->width);
				if ($last_x > $width)
				{
					$last_x = $width;
					$last_y = $width / ($this->width / $this->height);
				}
			}
		}
		
//		$raw_command = sprintf('convert -thumbnail %dx%d -sharpen 1 %s %%s', $last_x, $last_y, $this->image_path);
//		$raw_command = sprintf('convert -resize %dx%d -sharpen 1 %s %%s', $last_x, $last_y, $this->image_path);		
		$raw_command = sprintf('convert -resize %dx%d %s %%s', $last_x, $last_y, $this->image_path);
		$convert_options = array($raw_command);
		
		$resized_image = new Image($this->image_path, $convert_options);
		$resized_image->width = $last_x;
		$resized_image->height = $last_y;
		return $resized_image;
	}
	
	public function rotate($angle)
	{
	    $raw_command = sprintf('convert %%1$s -rotate %d %%1$s', $angle);
	    
	    $convert_options = array($raw_command);
	    
	    $rotate_image = new Image($this->image_path, $convert_options);
		$rotate_image->width = $last_x;
		$rotate_image->height = $last_y;
		return $rotate_image;
	}
	
	public function add_watermark ($watermark_path, $position_id)
	{

		if ($position_id < 1) {
			$position_id = 1;
		} elseif ($position_id > 25) {
			$position_id = 25;
		}
		
		$size = getimagesize($watermark_path);
		
		$position_x = (($position_id%5 == 0) ? 5 : $position_id%5) - 1;
		$position_y = intval(($position_id -1) / 5);
		
		$step_x = intval(($this->width - $size[0]) / 4);
		$step_y = intval(($this->height - $size[1]) / 4);
		
		$raw_command = 'composite -geometry '  . '+' .$step_x*$position_x . '+' . $step_y*$position_y . ' -quality 95 ' . $watermark_path . ' ' . $this->image_path . ' %s';
		
		$this->convert_attributes[100] = $raw_command;
/*
		list($logox, $logoy, $type, $attr) = getimagesize($watermark_path);
		$imgx = $this->width;
		$imgy = $this->height;
		$imgx -= $logox;
		$imgy -= $logoy;
		$raw_command = 'composite -geometry +' . $imgx . '+' . $imgy . ' -quality 70 ' . $watermark_path . ' ' . $this->image_path . ' %s' ;
		$this->convert_attributes[100] = $raw_command;
*/
	}
	
	public function save($path)
	{
		if (sizeof($this->convert_attributes) != 0)
		{
			foreach ($this->convert_attributes as $raw_command)
			{
				$command = sprintf($raw_command, $path);
				exec($command);
			}
		}
		else 
		{
			copy($this->image_path, $path);
		}
		
	}
	
	private function construct_from_file ($image_path) 
	{
		if (is_file($image_path)) 
		{
			$image_data = getimagesize($image_path);
			
			$this->width = $image_data[0];
			$this->height = $image_data[1];
			$this->image_type = $image_data['mime'];
	
		} else {
			throw new ImageException('Given path is not valid Image : '. $image_path);
		}
	}
	
}

class ImageException extends Exception {}

?>