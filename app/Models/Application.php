<?php
namespace App\Models;

use Illuminate\Foundation\Application as ApplicationBase;

class Application extends ApplicationBase
{
    public function publicPath()
    {
        return $this->basePath.'/../';
    }
}