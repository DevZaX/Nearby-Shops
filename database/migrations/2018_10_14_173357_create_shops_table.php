<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateShopsTable extends Migration
{
   
    public function up()
    {
        Schema::create('shops', function($collection)
{
    $collection->geospatial('coordinates', '2d');
});
    }

}
