<?php

namespace Sai\SpritesheetGenerator;

use Exception;
use PSpell\Config;

class SpritesheetGenerator
{
    private $srcImagePaths;
    private $tileHeight;
    private $tileWidth;
    private $mapImage;
    private $srcSpritesheetPath;
    private $css;
    private $css_prefix;

    public function __construct(int $tileWidth, int $tileHeight)
    {
        if (!extension_loaded('gd')) {
            throw (new Exception("PHP GD library not loaded!\n please enable it in php.ini"));
        }

        $this->tileWidth = $tileWidth;
        $this->tileHeight = $tileHeight;
        $this->css_prefix = 'sh-icon';
    }

    public function addImagesPaths(array $imagesPaths)
    {
        $this->srcImagePaths = $imagesPaths;
        return $this;
    }


    public function saveSpritesheetTo(string $srcSpritesheetPath = 'sprite-sheet.png')
    {
        $this->srcSpritesheetPath = $srcSpritesheetPath;
        imagepng($this->mapImage, $srcSpritesheetPath);
        return $this;
    }

    public function saveStyleSheetTo(string $srcStylesheetPath = 'sprite-styles.css', string $cssClassPrefix = null)
    {
        if ($cssClassPrefix)
            $this->css_prefix = $cssClassPrefix;
        $this->css .= ".{$this->css_prefix} {
                width: {$this->tileWidth}px; 
                height: {$this->tileHeight}px;
                background: url('{$this->srcSpritesheetPath}');
            }\n";
        file_put_contents($srcStylesheetPath, $this->css);
        return $this;
    }

    public function generateSheet()
    {

        $mapWidth =  $this->tileWidth * count($this->srcImagePaths);

        $this->mapImage = imagecreatetruecolor($mapWidth, $this->tileHeight);
        imagealphablending($this->mapImage, false);
        imagesavealpha($this->mapImage, true);
        $col = imagecolorallocatealpha($this->mapImage, 255, 255, 255, 127);
        imagefill($this->mapImage, 0, 0, $col);

        foreach ($this->srcImagePaths as $index => $srcImagePath) {
            $x = ($index % 12) * ($this->tileWidth);
            $y = floor($index / 12) * ($this->tileWidth);
            $tileImg = imagecreatefrompng($srcImagePath);

            imagecopy($this->mapImage, $tileImg, $x, $y, 0, 0, $this->tileWidth, $this->tileHeight);
            imagedestroy($tileImg);

            $this->css .= '.' . $this->css_prefix . '-' . $index . '{background-position:-' . $x . 'px ' . $y . "px}\n";
        }
        return $this;
    }
}
