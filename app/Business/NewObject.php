<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 3/10/2017
 * Time: 6:13 PM
 */

namespace App\Business;

//include "simple_html_dom.php";


class NewsObject
{
    public $source_url;
    public $title;
    public $title2;
    public $titleMain;
    public $post_thumbnail;
    public $excerpt;
    public $post_id;
    public $string_author;
    public $content;
    public $status;
    public $update_at;
    public $crawler_status;
    public $create_at;
    private $localPathToSaveImage;

    public function setLocalPathToSaveImage($path = 'yournews/images/download/')
    {
        $this->localPathToSaveImage = $path;
    }

    public function getLocalPathToSaveImage()
    {
        return $this->localPathToSaveImage;
    }

//    public function loadContent($link, $construcContent)
//    {
//        $post = file_get_html($link);
//        $content = $post->find($construcContent,0);
//
//        return $content;
//    }

    public function saveImage($imgLink)
    {
        //tải về file ảnh:
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
        curl_setopt($ch, CURLOPT_URL, $imgLink);
        $result = curl_exec($ch);
        curl_close($ch);

        $imageName = basename($imgLink);
        //nếu đã có file đó rồi thì thôi
        if (file_exists($imageName)) {
            unlink($imageName);
        } else {
            //đổi tên files ảnh:
            $newImageName = date("Y-m-d").$imageName;
            //lưu file:
            $fp = fopen($newImageName, 'w');
            if ($fp) {
                //ghi nội dung ảnh:
                fwrite($fp, $result);
                fclose($fp);

                //Di chuyển file ảnh sang thư mục khác:
                //set đường dẫn thư mục lưu:
                $this->setLocalPathToSaveImage();
                $u = $this->getLocalPathToSaveImage().$newImageName;
                if (rename($newImageName, $u)) {
                    return true;//trả về object.
                } else {
                    return false;//trả về object.
                }//endif-else.
            } else {
                return false;//trả về object.
            }//endif-else.
        }//endif-else.
    }
}