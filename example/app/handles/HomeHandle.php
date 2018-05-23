<?php

namespace App\Handles;

use App\User;
use ThreeFrame\BaseHandle;
use ThreeFrame\Request;

class HomeHandle extends BaseHandle
{
    public function Index()
    {

        $this->respView(200, "test",["a"=>'b']);
    }

    public function Show($id)
    {
        $this->respJson(200, $id);
    }

    public function Store()
    {

        $this->respJson(200, ["code" => 200, "msg" => "Store"]);
    }

    public function Update()
    {

        $this->respJson(200, ["code" => 200, "msg" => "Update"]);
    }

    public function Destroy($id)
    {
        $this->respJson(200, ["code" => 200, "msg" => "Destroy"]);
    }
}