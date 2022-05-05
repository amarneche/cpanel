<?php 
namespace Amarneche\CpanelApi\Facades;

use Illuminate\Support\Facades\Facades;



class Cpanel extends Facade {
    protected static function getFacadeAccessor()
    {
        return 'cpanel';
    }
}