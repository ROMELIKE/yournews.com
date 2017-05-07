<?php

namespace App\Http\Controllers;

use App\Business\CrawlerObject;
use App\Business\NewsObject;
use App\Models\Post;
use App\YourNewsBusiness\ResultObject;
use Illuminate\Http\Request;
use Session;
use DB;
use Mail;
use Hash;

class TestController extends Controller
{
    //
    public function test()
    {
        $model = new Post();
        //lấy ra danh sách những bài viết null content:
        $list = $model->getPostNullContent();
        foreach ($list->result as $item) {
            $new = new CrawlerObject();
            echo $item->source_url.'<br>';
            if (strpos($item->source_url, 'video.vnexpress.net')!==false)
            {   $constructContent = 'div#videoContainter video#media-video';}
            elseif (strpos($item->source_url, 'dulich.vnexpress.net')!==false)
            {   $constructContent = 'div.block_ads_connect block_content_slide_showdetail';}
            elseif (strpos($item->source_url, 'sohoa.vnexpress.net')!==false)
            {   $constructContent = 'div#article_content';}
            elseif (strpos($item->source_url, 'vnexpress.net/projects')!==false)
            {   $constructContent = 'div.wrapper';}
            elseif (strpos($item->source_url, 'vnexpress.net')!==false)
            {   $constructContent = 'div.fck_detail';}
            elseif (strpos($item->source_url, 'news.zing.vn')!==false)
            {   $constructContent = 'div.the-article-body';}
            elseif (strpos($item->source_url, 'vietnamnet.vn/')!==false)
            {   $constructContent = 'div#ArticleContent';}
            elseif (strpos($item->source_url, 'dantri.com.vn')!==false)
            {   $constructContent = 'div.detail-content';}
            elseif (strpos($item->source_url, 'tinhte.vn/')!==false)
            {   $constructContent = 'div.messageContent article';}
            elseif (strpos($item->source_url, 'bongdaplus.vn')!==false)
            {   $constructContent = 'div.ncont div.content';}
            elseif (strpos($item->source_url, 'afamily.vn')!==false)
            {   $constructContent = 'div.detail_content';}
            elseif (strpos($item->source_url, 'cafef.vn')!==false)
            {   $constructContent = 'div.newsbody';}
            elseif (strpos($item->source_url, 'laodong.com.vn')!==false)
            {   $constructContent = 'div.article-content div.content div.cms-body';}
            elseif (strpos($item->source_url, 'baomoi24g.net')!==false)
            {   $constructContent = 'div.article_content'; }
            elseif (strpos($item->source_url, '24h.com')!==false)
            {   $constructContent = 'div.text-conent'; }
            elseif (strpos($item->source_url, 'kenh14.vn')!==false)
            {   $constructContent = 'div.knc-content';}
            elseif (strpos($item->source_url, 'blogtamsu.vn')!==false)
            {   $constructContent = 'div#remain_detail';
            }
            else {
                $constructContent = '';
            }
            try {
                $content = $new->loadContent($item->source_url, $constructContent);
            } catch (\Exception $ex) {
                $content = null;
            }
            $saveContent = $model->updateContent($item->source_url, $content);
        }
    }
}
