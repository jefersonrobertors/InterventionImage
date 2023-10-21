<?php

declare(strict_types=1);

namespace core;

use Intervention\Image\Image;
use Intervention\Image\ImageManager;

final class UploadImage {

    private int $quality = 60;

    private Image $image;
    private ImageManager $manager;

    private string $path = '';

    private string $name = '';
    private string $tmp_name = '';

    public function __construct()
    {
        $this->manager = new ImageManager(['driver' => 'gd']);
    }

    public function make() : self {
        ['name' => $name, 'tmp_name' => $tmp_name] = $_FILES['image'];

        $this->name = $name;
        $this->tmp_name = $tmp_name;

        $this->image = $this->manager->make($tmp_name);
        return $this;
    }

    public function resize(int $width = null, int $height = null, bool $constraint = false)
    {
        if (!$constraint) {
            $this->image->resize($width, $height);
        } else {
            $this->image->resize($width, $height, function ($constraint) {
                $constraint->aspectRatio();
            });
        }

        return $this;
    }

    public function quality(int $quality)
    {
        $this->quality = $quality;
        return $this;
    }

    public function info() : array {
        return [
            'name' => $this->name,
            'tmp_name' => $this->tmp_name,
            'quality' => $this->quality,
            'path' => $this->path
        ];
    }

    public function fit(int $width, ?int $height = null, bool $constraint = false)
    {
        if (!$constraint) {
            $this->image->fit($width, $height);
        } else {
            $this->image->fit($width, $height, function ($constraint) {
                $constraint->upsize();
            });
        }

        return $this;
    }

    public function save() {
        $extension = @pathinfo($this->name, PATHINFO_EXTENSION);

        $newName = uniqid() . '.' . $extension;
        $this->path = "/uploads/{$newName}";

        $this->image->save(__DIR__ . "/../" . $this->path, $this->quality);
    }
}
?>