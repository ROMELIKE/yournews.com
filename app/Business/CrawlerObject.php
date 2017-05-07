<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 3/10/2017
 * Time: 8:17 PM
 */

namespace App\Business;


use App\Models\Post;

include "simple_html_dom.php";
//
class CrawlerObject
{
    public $linkPage;
    public $construcBox;
    public $construcA;
    public $constructImg;
    public $constructExcerpt;
    public $constructTilte;


    //$construct...: là cấu trúc html dom.

    public function getLink()
    {
        $tin = file_get_html($this->linkPage);
        $model = new Post();

        //constructBox: ct html lấy ra 1 box tin:
        $box = $tin->find($this->construcBox);

        foreach ($box as $item) {
            $news = new NewsObject();
            //constructA, constructImg, constructExcerpt là ct html, so sánh vs constructBox.
            $a = $item->find($this->construcA, 0);
            $news->source_url = $a->href; //lấy href.

            //check exist link:

            $news->title = $a->plaintext; //lấy title.
            $news->title2 = $a->title; //lấy title.
            $news->titleMain = $item->find($this->constructTilte,
                0); //lấy title chính, sau phải sửa toàn bộ theo title này
            $img = $item->find($this->constructImg, 0);

            //lấy thumbnail.
            $news->post_thumbnail = date("Y-m-d").basename($img->src);

            //tải ảnh về:
            $news->saveImage($img->src);

            if (!empty($this->constructExcerpt)) {
                $excerpt = $item->find($this->constructExcerpt, 0);
            } else {
                $excerpt = $item->plaintext;
            }

            $news->excerpt = $excerpt; //lấy excerpt.
            return $news; //trả về đối tượng news
        }
    }
    public function loadContent($link, $construcContent)
    {
        $post = file_get_html($link);
        $content = $post->find($construcContent,0);

        return $content;
    }
}