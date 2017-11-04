<?php

namespace App\Http\Controllers;

use App\Services\ZeService;
use Develpr\AlexaApp\Facades\Alexa;
use Illuminate\Http\Request;

class ZoeController extends Controller
{
    public function range()
    {
        $service = new ZeService();
        $result = $service->getBatteryStatus(config('ze.username'), config('ze.password'));

        $rangeText = sprintf("Deine Zoe hat noch %d Kilometer Reichweite", floor($result->remaining_range));

        if ($result->charging) {
            $chargeText = ' und lädt gerade auf.';
        } else {
            $chargeText = ' und lädt gerade nicht auf.';
        }

        return Alexa::say($rangeText . $chargeText);

    }
}
