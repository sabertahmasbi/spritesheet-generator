
# PHP Spritesheet generator

Simple php library that combine seperated images(png) to one spritesheet image and replace background color with transparent and generate css





## Installation

Install with composer

```bash
  composer require sabi/spritesheet-generator
```
    
## Tech Stack

**Server:** PHP


## Methods

#### __constructor

```php
  SpritesheetGenerator(tileWidth, tileHeight)
```

| Parameter | Type     | Description                |
| :-------- | :------- | :------------------------- |
| `tileWidth` | `integer` | **Required**. |
| `tileHeight` | `integer` | **Required**. |

#### add images paths

```php
  ->addImagesPaths(imagesPaths)
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `imagesPaths`      | `array` | **Required**. |

#### save generated spritesheet image

```php
  ->saveSpritesheetTo(srcSpritesheetPath)
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `srcSpritesheetPath`      | `string` | **Optional**. default is './sprite-sheet.png'|


#### save css stylesheet

```php
  ->saveStyleSheetTo(srcStylesheetPath, cssClassPrefix)
```

| Parameter | Type     | Description                       |
| :-------- | :------- | :-------------------------------- |
| `srcStylesheetPath`      | `string` | **Optional**. default is './sprite-styles.css'|
| `cssClassPrefix`      | `string` | **Optional**. default is 'sh-icon'|

#### generate images sprite sheet and css stylesheet

```php
  ->generateSheet()
```




## Usage/Examples

```php
<?php

require '../vendor/autoload.php';

use Saber\SpritesheetGenerator\SpritesheetGenerator;

$sg = new SpritesheetGenerator(48,48);
$sg->addImagesPaths([
    __DIR__.'/imgs/1.png',
    __DIR__.'/imgs/2.png',
    __DIR__.'/imgs/3.png',
    __DIR__.'/imgs/4.png'
])
->generateSheet()
->saveSpritesheetTo('./menu-icons.png')
->saveStyleSheetTo('./menu-icons.css');
```

