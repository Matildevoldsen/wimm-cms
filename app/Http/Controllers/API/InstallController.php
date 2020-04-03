<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController as BaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstallController extends BaseController {
    public function testDB(Request $request) {
        $this->addDB('DB_CONNECTION=' . $request->driver);
        $this->addDB('DB_PORT=' . $request->port);
        $this->addDB('DB_DATABASE=' . $request->db);
        $this->addDB('DB_USERNAME=' . $request->username);
        $this->addDB('DB_PASSWORD=' . $request->password);

        try {
            DB::connection()->getPdo();

            return response()->json(['data' => [
                'success' => true,
            ]]);
        } catch (\Exception $e) {
            return response()->json(['data' => [
                'success' => true,
                'errors' => $e->getMessage()
            ]]);
        }
    }
    }

    public function install(Request $request) {
        $this->addDB('DB_CONNECTION=' . $request->driver);
        $this->setEnvironmentValue('APP_NAME', $request->name);
        $this->setEnvironmentValue('APP_DESC', "\"" . $request->description . "\"");
    }

    public function addDB($val) {
        file_put_contents(app()->environmentFilePath(), $val.PHP_EOL , FILE_APPEND | LOCK_EX);
    }

    public function setEnvironmentValue($envKey, $envValue) {
        $envFile = app()->environmentFilePath();
        $str = file_get_contents($envFile);

        $oldValue = strtok($str, "{$envKey}=");

        $str = str_replace("{$envKey}={$oldValue}", "{$envKey}={$envValue}\n", $str);

        $fp = fopen($envFile, 'w');
        fwrite($fp, $str);
        fclose($fp);
    }
}
