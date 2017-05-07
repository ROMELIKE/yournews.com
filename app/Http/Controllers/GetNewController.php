<?php

namespace App\Http\Controllers;

use App\Business\GetContentBusiness;
use App\Business\GetNewsBusiness;
use App\Business\GetNewsBusinessImprove;
use Illuminate\Http\Request;
use DateTime;


class GetNewController extends Controller
{
    //
    public function getNews()
    {
        return view('user.getnews');
    }

    public function postNews(Request $request)
    {
        $listPage = $request->page;
        $bus = new GetNewsBusinessImprove();
        $result = $bus->insertNews($listPage);

        $bus2 = new GetContentBusiness();
        $result2 = $bus2->getContent();

        return $result;
    }
}
