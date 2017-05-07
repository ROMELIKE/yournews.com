<?php
namespace App\Business;

use App\Models\Post;
use DateTime;
use League\Flysystem\Exception;

require "simple_html_dom.php";

class GetNewsBusiness
{
    public function insertNews($arraySourcePage)
    {
        //phần này tách vào business:
        $model = new Post();
        $arrayToModel = [];

        foreach ($arraySourcePage as $sourcePage) {
            if ($sourcePage == 'vnexpress') {

                $arrayPageLink
                    = [
                    'thegioi' => 'http://vnexpress.net/tin-tuc/the-gioi',
                    'thoisu' => 'http://vnexpress.net/tin-tuc/thoi-su',
                    'phapluat' => 'http://vnexpress.net/tin-tuc/phap-luat',
                    'giaoduc' => 'http://vnexpress.net/tin-tuc/giao-duc',
                    'dulich' => 'http://dulich.vnexpress.net/',
                    'xe' => 'http://vnexpress.net/tin-tuc/oto-xe-may',
                    'sohoa' => 'http://sohoa.vnexpress.net/',
                    'khoahoc' => 'http://vnexpress.net/tin-tuc/khoa-hoc',
                ];

                foreach ($arrayPageLink as $thePageLink) {
                    //lấy tin tuần tự theo các link page (vnexpress):
                    $page
                        = file_get_html($thePageLink);
                    //lấy ra mảng các box tin.
                    $arraybox
                        = $page->find('ul.list_news li div.block_image_news');
                    foreach ($arraybox as $box) {
                        //lấy từng thẻ a.
                        $a = $box->find('a', 0);
                        $href = $a->href;
                        //Check the same link:
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->innertext;
                            $img = $box->find('div.thumb a img', 0)->src;
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u, file_get_contents($img));

                            $excerpt = $box->find('div.news_lead', 0);
                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div.fck_detail', 0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/the-gioi'
                                ) {
                                    $catId = 2;//chuyên mục thế giới.
                                } elseif ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/thoi-su'
                                ) {
                                    $catId = 1;//chuyên mục thời sự.
                                } elseif ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/phap-luat'
                                ) {
                                    $catId = 14;//chuyên mục pháp luật.
                                } elseif ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/giao-duc'
                                ) {
                                    $catId = 16;//chuyên mục giáo dục.
                                } elseif ($thePageLink
                                    == 'http://dulich.vnexpress.net/'
                                ) {
                                    $catId = 17;//chuyên mục duc lịch.
                                } elseif ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/oto-xe-may'
                                ) {
                                    $catId = 15;//chuyên mục ô tô xe máy.
                                } elseif ($thePageLink
                                    == 'http://sohoa.vnexpress.net/'
                                ) {
                                    $catId = 24;//chuyên mục số hóa.
                                } elseif ($thePageLink
                                    == 'http://vnexpress.net/tin-tuc/khoa-hoc'
                                ) {
                                    $catId = 4;//chuyên mục khoa học.
                                }

                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch.
                        }//end if-check same link.
                    } //end foreach- $box as $item.
                }//end foreach- $arrayPage as $thisPage

            }//end if- $item = 'vnexpress'.

            elseif ($sourcePage == 'vietnamnet') {

                $arrayPageLink
                    = [
                    'batdongsan' => 'http://vietnamnet.vn/vn/bat-dong-san/',
                    'suckhoe' => 'http://vietnamnet.vn/vn/suc-khoe/',
                    'congnghe' => 'http://vietnamnet.vn/vn/cong-nghe/',
                    'kinhdoanh' => 'http://vietnamnet.vn/vn/kinh-doanh/',
                    'giaitri' => 'http://vietnamnet.vn/vn/giai-tri/',
                    'thegioi' => 'http://vietnamnet.vn/vn/the-gioi/',
                    'phapluat' => 'http://vietnamnet.vn/vn/phap-luat/',
                    'giaoduc' => 'http://vietnamnet.vn/vn/giao-duc/',
                    'amthuc' => 'http://vietnamnet.vn/vn/doi-song/am-thuc/',
                ];
                foreach ($arrayPageLink as $thePageLink) {
                    $page
                        = file_get_html($thePageLink);
                    $arrayBox
                        = $page->find('div.HomeBlockLeft ul.ListArticle li.item');
                    foreach ($arrayBox as $box) {
                        $a = $box->find('a', 0);
                        $href = 'http://vietnamnet.vn'.$a->href;
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->title;
                            $img = $box->find('a img', 0)->src;
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u, file_get_contents($img));

                            $excerpt = $box->find('p.Lead', 0);
                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div#ArticleContent', 0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'http://vietnamnet.vn/vn/bat-dong-san/'
                                ) {
                                    $catId = 22;//chuyên mục bất động sản.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/suc-khoe/'
                                ) {
                                    $catId = 7;//chuyên mục sức khỏe.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/cong-nghe/'
                                ) {
                                    $catId = 24;//chuyên mục công nghệ.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/kinh-doanh/'
                                ) {
                                    $catId = 19;//chuyên mục kinh doanh.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/giai-tri/'
                                ) {
                                    $catId = 21;//chuyên mục giải trí.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/the-gioi/'
                                ) {
                                    $catId = 2;//chuyên mục thế giới.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/phap-luat/'
                                ) {
                                    $catId = 14;//chuyên mục pháp luật.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/giao-duc/'
                                ) {
                                    $catId = 16;//chuyên mục giáo dục.
                                } elseif ($thePageLink
                                    == 'http://vietnamnet.vn/vn/doi-song/am-thuc/'
                                ) {
                                    $catId = 10;//chuyên mục ẩm thực.
                                }

                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch
                        }//end if
                    }//end foreach box
                }//end foreach pagelink

            } elseif ($sourcePage == 'dantri') {
                $arrayPageLink = [
                    'tinhyeu' => 'http://dantri.com.vn/tinh-yeu-gioi-tinh.htm',
                    'chuyenla' => 'http://dantri.com.vn/chuyen-la.htm',
                    'kinhdoanh' => 'http://dantri.com.vn/kinh-doanh.htm',
                    'thegioi' => 'http://dantri.com.vn/the-gioi.htm',
                    'xahoi' => 'http://dantri.com.vn/xa-hoi.htm',
                ];
                foreach ($arrayPageLink as $thePageLink) {
                    //lấy tin thuộc chuyên mục:"tình yêu" dantri
                    $page
                        = file_get_html($thePageLink);
                    $box
                        = $page->find("div#listcheckepl [data-boxtype='timelineposition']");
                    foreach ($box as $item) {
                        $a = $item->find('a', 0);
                        $href = 'http://dantri.com.vn/'.$a->href;
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->title;
                            $img = $item->find('a img', 0)->src;
                            //lưu ảnh vào folder:
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u, file_get_contents($img));

                            $des = $item->find('div.fon5', 0);
                            $excerpt = substr($des, 0, 150);

                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div.detail-content', 0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'http://dantri.com.vn/tinh-yeu-gioi-tinh.htm'
                                ) {
                                    $catId = 23;//chuyên mục tình yêu.
                                } elseif ($thePageLink
                                    == 'http://dantri.com.vn/chuyen-la.htm'
                                ) {
                                    $catId = 20;//chuyên mục chuyện lạ.
                                } elseif ($thePageLink
                                    == 'http://dantri.com.vn/kinh-doanh.htm'
                                ) {
                                    $catId = 19;//chuyên mục kinh doanh.
                                } elseif ($thePageLink
                                    == 'http://dantri.com.vn/the-gioi.htm'
                                ) {
                                    $catId = 2;//chuyên mục thế giới.
                                } elseif ($thePageLink
                                    == 'http://dantri.com.vn/xa-hoi.htm'
                                ) {
                                    $catId = 1;//chuyên mục thời sự.
                                }
                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch
                        }
                    }
                }

            } elseif ($sourcePage == 'zing') {
                $arrayPageLink = [
                    'thoisu' => 'http://news.zing.vn/thoi-su.html',
                    'thegioi' => 'http://news.zing.vn/the-gioi.html',
                    'phapluat' => 'http://news.zing.vn/phap-luat.html',
                    'giaitri' => 'http://news.zing.vn/giai-tri.html',
                    'amnhac' => 'http://news.zing.vn/am-nhac.html',
                    'phimanh' => 'http://news.zing.vn/phim-anh.html',
                    'thoitrang' => 'http://news.zing.vn/thoi-trang.html',
                    'suckhoe' => 'http://news.zing.vn/suc-khoe.html',
                    'quansu' => 'http://news.zing.vn/quan-su-the-gioi.html',
                    'amthuc' => 'http://news.zing.vn/am-thuc.html',
                ];

                foreach ($arrayPageLink as $thePageLink) {
                    $page = file_get_html($thePageLink);
                    $box
                        = $page->find('section.cate_content section.cate_content article');
                    foreach ($box as $item) {
                        $a = $item->find('header a', 0);
                        $href = 'http://news.zing.vn/'.$a->href;
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->innertext;
                            $img = $item->find('div.cover>a>img', 0)->src;
                            //lưu ảnh vào folder:
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u, file_get_contents($img));
                            $excerpt = $item->find('header p.summary', 0);

                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div.the-article-body',
                                    0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'http://news.zing.vn/thoi-su.html'
                                ) {
                                    $catId = 1;//chuyên mục thời sự.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/the-gioi.html'
                                ) {
                                    $catId = 2;//chuyên mục thế giới.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/phap-luat.html'
                                ) {
                                    $catId = 14;//chuyên mục pháp luật.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/giai-tri.html'
                                ) {
                                    $catId = 21;//chuyên mục giải trí.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/am-nhac.html'
                                ) {
                                    $catId = 13;//chuyên mục âm nhạc.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/phim-anh.html'
                                ) {
                                    $catId = 12;//chuyên mục phim ảnh.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/thoi-trang.html'
                                ) {
                                    $catId = 9;//chuyên mục thời trang.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/suc-khoe.html'
                                ) {
                                    $catId = 7;//chuyên mục sức khỏe.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/quan-su-the-gioi.html'
                                ) {
                                    $catId = 3;//chuyên mục quân sự.
                                } elseif ($thePageLink
                                    == 'http://news.zing.vn/am-thuc.html'
                                ) {
                                    $catId = 10;//chuyên mục ẩm thực.
                                }

                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch
                        }//end if: check exist URL
                    }//end foreach box
                }//end foreach pagelink
            } elseif ($sourcePage == 'kenh14') {


            } elseif ($sourcePage == 'tinhte') {
                $arrayPageLink = ['congnghe' => 'https://tinhte.vn/'];
                foreach ($arrayPageLink as $thePageLink) {
                    $page = file_get_html($thePageLink);
                    $box
                        = $page->find('div#WidgetPageContents div.promote');
                    foreach ($box as $item) {

                        $a = $item->find('div.thread-title a', 0);
                        $href = 'https://tinhte.vn/'.$a->href;
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->innertext;
                            //lưu ảnh vào folder:
                            $img = $item->find('div.thread-image',
                                0)->attr['data-src'];
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u,file_get_contents($img));
                            $excerpt = $item->find('div.post-body a',
                                0)->innertext;
                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div.messageContent article',
                                    0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'https://tinhte.vn/'
                                ) {
                                    $catId = 24;//chuyên mục công nghệ
                                }
                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch
                        }
                    }
                }
            } elseif ($sourcePage == 'bongdaplus') {
                $arrayPageLink = [
                    'vietnam' => 'http://bongdaplus.vn/tin-tuc/viet-nam/',
                    'anh'=>'http://bongdaplus.vn/tin-tuc/anh/',
                    'italy'=>'http://bongdaplus.vn/tin-tuc/italia/',
                    'gemany'=>'http://bongdaplus.vn/tin-tuc/duc/',
                    'france'=>'http://bongdaplus.vn/tin-tuc/phap/',
                    'uefa'=>'http://bongdaplus.vn/tin-tuc/champions-league/',
                    'chuyennhuong'=>'http://bongdaplus.vn/tin-tuc/chuyen-nhuong/',
                    'spain'=>'http://bongdaplus.vn/tin-tuc/tay-ban-nha/'
                ];
                foreach ($arrayPageLink as $thePageLink) {
                    $page = file_get_html($thePageLink);
                    $box
                        = $page->find('div.nwslst ul li');
                    foreach ($box as $item) {

                        $a = $item->find('a', 0);
                        $href = 'http://bongdaplus.vn'.$a->href;
                        if ($model->checkSameLink($href)->messageCode) {
                            $title = $a->find('h4', 0)->innertext;
                            //lưu ảnh vào folder:
                            $img = $a->find('img', 0)->src;
                            $u = 'yournews/images/post/'.basename($img);
                            file_put_contents($u,file_get_contents($img));
                            $excerpt = $item->plaintext;
                            try {
                                $post = file_get_html($href);
                                $content = $post->find('div.ncont div.content', 0);
                                $date = date("Y-m-d H:i:s");

                                $arrayToModel['create_at'] = $date;
                                $arrayToModel['source_url'] = $href;
                                $arrayToModel['content'] = $content;
                                $arrayToModel['title'] = $title;
                                $arrayToModel['excerpt'] = $excerpt;
                                $arrayToModel['status'] = 1;
                                $arrayToModel['post_thumbnail'] = $img;

                                if ($thePageLink
                                    == 'https://tinhte.vn/'
                                ) {
                                    $catId = 24;//chuyên mục công nghệ
                                }
                                $result = $model->insertNew($arrayToModel,
                                    $catId);

                            } catch (\Exception $ex) {

                            }//end catch
                        }
                    }
                }
            } elseif ($sourcePage == 'afamily') {
                $arrayPageLink = [
                    'chuyenla' => 'http://afamily.vn/chuyen-la.chn',
                    'amthuc'=>'http://afamily.vn/an-ngon.chn',
                    'tinhyeu'=>'http://afamily.vn/tinh-yeu-hon-nhan.chn',
                    'doisong'=>'http://afamily.vn/doi-song.chn',
                ];

                //lấy chuyên mục chuyện lạ :afamily:
                $chuyenla = file_get_html('http://afamily.vn/chuyen-la.chn');
                $box = $chuyenla->find('div.list-news1 div.box-x2');
                foreach ($box as $item) {
                    $a = $item->find('a', 0);
                    $href = 'http://afamily.vn'.$a->href;
                    $title = $a->title;
                    $img = $a->find('img', 0);
                    $u = 'yournews/images/post/'.basename($img);
                    //file_put_contents($u,file_get_contents($img));
                    $excerpt=$item->find('div p',0);
                    $post = file_get_html($href);
                    $content = $post->find('div.detail_content', 0);

                }
            } elseif ($sourcePage == '24h') {


            } elseif ($sourcePage == 'cafef') {
//                //lấy tin thuộc chuyên mục:"thời sự" cafef

                $thoisu = file_get_html('http://cafef.vn/thoi-su.chn');
                $box = $thoisu->find('div.list_left_cate ul.list li');
                foreach ($box as $item) {
                    $a = $item->find('a', 0);
                    $title = $a->title;
                    $href = 'http://cafef.vn/'.$a->href;
                    $img = $a->find('img', 0)->src;
                    $u = 'yournews/images/post/'.basename($img);
                   //file_put_contents($u,file_get_contents($img));
                    $excerpt=$item->find('p.sapo',0);
                    $post = file_get_html($href);
                    $content = $post->find('div.newsbody',0);
                    $date = new DateTime();
                }
            } elseif ($sourcePage == 'laodong') {

                //lấy tin tức thuộc chuyên mục:"duclich" laodong
                $dulich
                    = file_get_html('http://laodong.com.vn/du-lich-kham-pha/');
                $box = $dulich->find('div.list-article article.story');
                foreach ($box as $item) {
                    $a = $item->find('figure.cover a', 0);
                    $href = 'http://laodong.com.vn'.$a->href;
                    $title = $a->title;
                    $img = $a->find('img', 0);
                    $u = 'yournews/images/post/'.basename($img);
                    //file_put_contents($u,file_get_contents($img));
                    $excerpt = $item->find('header div.summary', 0)->plaintext;
                    $post = file_get_html($href);
                     $content = $post->find("div.article-content div.content div.cms-body",
                1);
                }


////                lấy tin tức thuộc chuyên mục:"văn hóa" laodong
//                $vanhoa
//                    = file_get_html('http://laodong.com.vn/du-lich-kham-pha/');
//                $box = $vanhoa->find('div.list-article article.story');
//                foreach ($box as $item) {
//                    $a = $item->find('figure.cover a', 0);
//                    $href = 'http://laodong.com.vn'.$a->href;
//                    $title = $a->title;
//                    $img = $a->find('img', 0);
//                    $u = 'yournews/images/post/'.basename($img);
//                    //file_put_contents($u,file_get_contents($img));
//                    $excerpt = $item->find('header div.summary', 0)->plaintext;
//                    $post = file_get_html($href);
//                     $content = $post->find("div.article-content div.content div.cms-body",
//                1);
//                }


////                lấy tin tức thuộc chuyên mục:"kinh tế" laodong
//                $kinhte
//                    = file_get_html('http://laodong.com.vn/kinh-te/');
//                $box = $kinhte->find('div.list-article article.story');
//                foreach ($box as $item) {
//                    $a = $item->find('figure.cover a', 0);
//                    $href = 'http://laodong.com.vn'.$a->href;
//                    $title = $a->title;
//                    $img = $a->find('img', 0);
//                    $u = 'yournews/images/post/'.basename($img);
//                    //file_put_contents($u,file_get_contents($img));
//                    $excerpt = $item->find('header div.summary', 0)->plaintext;
//                    $post = file_get_html($href);
//                     $content = $post->find("div.article-content div.content div.cms-body",
//                1);
//                }


//                lấy tin tức thuộc chuyên mục:"thời sự" laodong
//                $thoisu
//                    = file_get_html('http://laodong.com.vn/thoi-su-xa-hoi/');
//                $box = $thoisu->find('div.list-article article.story');
//                foreach ($box as $item) {
//                    $a = $item->find('figure.cover a', 0);
//                    $href = 'http://laodong.com.vn'.$a->href;
//                    $title = $a->title;
//                    $img = $a->find('img', 0);
//                    $u = 'yournews/images/post/'.basename($img);
//                    //file_put_contents($u,file_get_contents($img));
//                    $excerpt = $item->find('header div.summary', 0)->plaintext;
//                    $post = file_get_html($href);
//                    $content = $post->find("div.article-content div.content div.cms-body",
//                        1);
//                }

////                lấy tin tức thuộc chuyên mục:"thế giới" laodong
//                $thegioi
//                    = file_get_html('http://laodong.com.vn/kinh-te/');
//                $box = $thegioi->find('div.list-article article.story');
//                foreach ($box as $item) {
//                    $a = $item->find('figure.cover a', 0);
//                    $href = 'http://laodong.com.vn'.$a->href;
//                    $title = $a->title;
//                    $img = $a->find('img', 0);
//                    $u = 'yournews/images/post/'.basename($img);
//                    //file_put_contents($u,file_get_contents($img));
//                    $excerpt = $item->find('header div.summary', 0)->plaintext;
//                    $post = file_get_html($href);
//                    $content = $post->find("div.article-content div.content div.cms-body",
//                        1);
//                }


            }
        }//end foreach


    }
}