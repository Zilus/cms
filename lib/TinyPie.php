<?php
/*
	Created by David Frendin, 2011
	Published at http://www.phpclasses.org/
	
	This class is considered public domain by author as is.
	
	:: Version history
	1.0.1 Fixed issues with possible file locks and real numbers, credits to Jaroslav
	1.0.0 Initial release
	
	:: Usage
	See samples included with this package, or download them from phpclasses.
	
	:: Contact the author
	david.frendin@gmail.com
*/
class TinyPie
{
	/*
		Private properties
	*/
	private $values;
	private $width;
	private $height;
	private $gdimage;
	
	/*
		Constructor
	*/
	public function __construct($size)
	{
		$this->width = $size;
		$this->height = $size;
		$this->gdimage = imagecreatetruecolor($this->width, $this->height);
		imagealphablending($this->gdimage, true);
		$this->values = array();
	}
	
	/*
		Destructor
	*/
	public function __destruct()
	{
		imagedestroy($this->gdimage);
	}
	
	/*
		Static method of GetAsImg 
	*/
	public static function QuickImg($size, $values)
	{
		$g = new TinyPie($size);
		foreach ($values as $value)
		{
			$g->AddValue($value[0], $value[1]);
		}
		return $g->GetAsImg();
	}

	/*
		Static method of GetAsDiv
	*/
	public static function QuickDiv($size, $values)
	{
		$g = new TinyPie($size);
		foreach ($values as $value)
		{
			$g->AddValue($value[0], $value[1]);
		}
		return $g->GetAsDiv();
	}
	
	/*
		Add values to graph, includes numeric value and a color representation
	*/
	public function AddValue($value, $color)
	{
		$c = imagecolorallocate($this->gdimage, hexdec(substr($color, 0, 2)), hexdec(substr($color, 2, 2)), hexdec(substr($color, 4, 2)));
		$this->values[] = array((int)$value, $c);
	}
	
	/*
		Generate a div-element with background style set to base64 of image
	*/
	public function GetAsDiv()
	{
		return '<div style="background: #fff url(data:image/png;base64,' . $this->GetBase64Image() . ') no-repeat; width: ' . $this->width . 'px; height: ' . $this->height . 'px;"></div>';
	}

	/*
		Generate a img-element with url set to base64 of image
	*/
	public function GetAsImg()
	{
		return '<img src="data:image/png;base64,' . $this->GetBase64Image() . '" width="' . $this->width . '" height="' . $this->height . '" alt="" />';
	}
	
	/*
		Generate a img-element By Zilus
	*/
	public function GetImg()
	{
		return 'data:image/png;base64,' . $this->GetBase64Image() . '';
	}
	
	/*
		Save image to disk instead of generating html elements
	*/
	public function SaveToFile($filename)
	{
		$this->InternalRendering();
		imagepng($this->gdimage, $filename);
	}
	
	/*
		Determine the sum of all values
	*/
	private function SumValues()
	{
		$sum = 0;
		foreach ($this->values as $value)
		{
			$sum = (int)$sum + (int)$value[0];
		}
		return (int)$sum;
	}
	
	/*
		Save temporary image to disk and return its contents as a base64 string
	*/
	private function GetBase64Image()
	{
		$tempfile = str_replace (' ', '_', microtime());
		$this->SaveToFile($tempfile);
		$imgbinary = fread(fopen($tempfile, "r"), filesize($tempfile));
		@unlink ($tempfile);
		return base64_encode($imgbinary);
	}
	/*
		The actual code that renders the graph
	*/
	private function InternalRendering()
	{
		$black = imagecolorallocate($this->gdimage, 0, 0, 0);
		imagecolortransparent($this->gdimage, $black);

		$sum = $this->SumValues();
		$totalcovered = 0;
		foreach ($this->values as $value)
		{
			$step = round((((int)$value[0] / $sum) * 360));
			$color = (int)$value[1];
			imagefilledarc($this->gdimage, $this->width * 0.5, $this->height * 0.5, $this->width-1, $this->height-1, $totalcovered, $step + (int)$totalcovered, $color, IMG_ARC_PIE);
			$totalcovered = $totalcovered + $step;
		}
		imageantialias($this->gdimage, true);
	}
}