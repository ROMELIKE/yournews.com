<?php
/**
 * Created by PhpStorm.
 * User: ROME
 * Date: 3/22/2017
 * Time: 2:38 PM
 */

namespace App\Business;

use App\Models\Post;

//require "simple_html_dom.php";

class GetNewsBusinessImprove
{
    public function insertNews($arraySourcePage)
    {
        //phần này tách vào business:
        $model = new Post();
        $arrayToModel = [];
        foreach ($arraySourcePage as $sourcePage) {
            if ($sourcePage == 'zing') {
                //liệt kê ra các link cần lấy dữ liệu:
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

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;
                    $newObj->construcA = 'header p.title a';
                    $newObj->construcBox
                        = 'section.cate_content section.cate_content article';
                    $newObj->constructExcerpt = 'header p.summary';
                    $newObj->constructImg = 'div.cover>a>img';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://news.zing.vn'
                        .$news->source_url)->messageCode
                    ) {
                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url']
                            = 'http://news.zing.vn'.$news->source_url;
                        $arrayToModel['title'] = $news->title;
                        $arrayToModel['excerpt'] = $news->excerpt->innertext;
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

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
                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);
                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }//end if(trang nguồn là zing)
            elseif ($sourcePage == 'vnexpress') {
                //liệt kê ra các link cần lấy dữ liệu:
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

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = 'ul.list_news li div.block_image_news';
                    $newObj->construcA = 'a';
                    $newObj->constructImg = 'div.thumb a img';
                    $newObj->constructExcerpt = 'div.news_lead';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink($news->source_url)->messageCode
                    ) {
                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = $news->source_url;
                        $arrayToModel['title'] = $news->title;
                        $arrayToModel['excerpt']
                            = trim($news->excerpt->plaintext);
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

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
                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);
                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'vietnamnet') {
                //liệt kê ra các link cần lấy dữ liệu:
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

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = 'div.HomeBlockLeft ul.ListArticle li.item';
                    $newObj->construcA = 'a';
                    $newObj->constructImg = 'a img';
                    $newObj->constructExcerpt = 'p.Lead';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://vietnamnet.vn'
                        .$news->source_url)->messageCode
                    ) {

                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://vietnamnet.vn'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->title2;
                        $arrayToModel['excerpt']
                            = trim($news->excerpt->plaintext);
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

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

                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);

                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'dantri') {
                //liệt kê ra các link cần lấy dữ liệu:
                $arrayPageLink = [
                    'tinhyeu' => 'http://dantri.com.vn/tinh-yeu-gioi-tinh.htm',
                    'chuyenla' => 'http://dantri.com.vn/chuyen-la.htm',
                    'kinhdoanh' => 'http://dantri.com.vn/kinh-doanh.htm',
                    'thegioi' => 'http://dantri.com.vn/the-gioi.htm',
                    'xahoi' => 'http://dantri.com.vn/xa-hoi.htm',
                ];

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = "div#listcheckepl [data-boxtype='timelineposition']";
                    $newObj->construcA = 'a';
                    $newObj->constructImg = 'a img';
                    $newObj->constructExcerpt = 'div.fon5';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://dantri.com.vn/'
                        .$news->source_url)->messageCode
                    ) {

                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://dantri.com.vn/'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->title2;
                        $arrayToModel['excerpt']
                            = trim(substr($news->excerpt, 0, 150));
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

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

                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);

                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'bongdaplus') {
                //liệt kê ra các link cần lấy dữ liệu:
                $arrayPageLink = [
                    'vietnam' => 'http://bongdaplus.vn/tin-tuc/viet-nam/',
                    'anh' => 'http://bongdaplus.vn/tin-tuc/anh/',
                    'italy' => 'http://bongdaplus.vn/tin-tuc/italia/',
                    'gemany' => 'http://bongdaplus.vn/tin-tuc/duc/',
                    'france' => 'http://bongdaplus.vn/tin-tuc/phap/',
                    'uefa' => 'http://bongdaplus.vn/tin-tuc/champions-league/',
                    'chuyennhuong' => 'http://bongdaplus.vn/tin-tuc/chuyen-nhuong/',
                    'spain' => 'http://bongdaplus.vn/tin-tuc/tay-ban-nha/'
                ];

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = "div.nwslst ul li";
                    $newObj->construcA = 'a';
                    $newObj->constructTilte = 'a h4';
                    $newObj->constructImg = 'a img';
                    $newObj->constructExcerpt = '';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://bongdaplus.vn'
                        .$news->source_url)->messageCode
                    ) {

                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://bongdaplus.vn'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->titleMain->plaintext;
                        $arrayToModel['excerpt'] = $news->excerpt;
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

                        $catId = 6;

                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);

                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'afamily') {
                //liệt kê ra các link cần lấy dữ liệu:
                $arrayPageLink = [
                    'chuyenla' => 'http://afamily.vn/chuyen-la.chn',
                    'amthuc' => 'http://afamily.vn/an-ngon.chn',
                    'tinhyeu' => 'http://afamily.vn/tinh-yeu-hon-nhan.chn',
                    'doisong' => 'http://afamily.vn/doi-song.chn',
                ];

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = "div.list-news1 div.box-x2";
                    $newObj->construcA = 'a';
                    $newObj->constructTilte = 'a';
                    $newObj->constructImg = 'a img';
                    $newObj->constructExcerpt = 'div p';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://afamily.vn'
                        .$news->source_url)->messageCode
                    ) {
                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://afamily.vn'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->titleMain->title;
                        $arrayToModel['excerpt'] = $news->excerpt->plaintext;
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

                        //xét link để lấy chuyên mục:
                        if ($thePageLink
                            == 'http://afamily.vn/chuyen-la.chn'
                        ) {
                            $catId = 20;
                        } elseif ($thePageLink
                            == 'http://afamily.vn/an-ngon.chn'
                        ) {
                            $catId = 10;
                        }elseif ($thePageLink
                            == 'http://afamily.vn/tinh-yeu-hon-nhan.chn'
                        ) {
                            $catId = 23;
                        }elseif ($thePageLink
                            == 'http://afamily.vn/doi-song.chn'
                        ) {
                            $catId = 5;
                        }

                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);

                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'cafef') {
                //liệt kê ra các link cần lấy dữ liệu:
                $arrayPageLink = [
                    'thoisu' => 'http://cafef.vn/thoi-su.chn',
                    'chungkhoan' => 'http://cafef.vn/thi-truong-chung-khoan.chn',
                    'bdsan' => 'http://cafef.vn/bat-dong-san.chn',
                    'doanhnghiep' => 'http://cafef.vn/doanh-nghiep.chn',
                    'vimo' => 'http://cafef.vn/vi-mo-dau-tu.chn',
                    'hanghoa' => 'http://cafef.vn/hang-hoa-nguyen-lieu.chn',
                    'doisong' => 'http://cafef.vn/song.chn',
//                    'amthuc' => 'http://www.amthuc365.vn/am-thuc.html',
                ];

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = "div.list_left_cate ul.list li";
                    $newObj->construcA = 'a';
                    $newObj->constructTilte = 'a';
                    $newObj->constructImg = 'a img';
                    $newObj->constructExcerpt = 'p.sapo';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();
                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://cafef.vn/'.$news->source_url)) {
                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://cafef.vn/'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->titleMain->title;
                        $arrayToModel['excerpt'] = $news->excerpt->plaintext;
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

                        //xét link để lấy chuyên mục:
                        if ($thePageLink
                            == 'http://cafef.vn/thoi-su.chn'
                        ) {
                            $catId = 1;
                        } elseif ($thePageLink
                            == 'http://cafef.vn/thi-truong-chung-khoan.chn'
                        ) {
                            $catId = 19;
                        }elseif ($thePageLink
                            == 'http://cafef.vn/bat-dong-san.chn'
                        ) {
                            $catId = 19;
                        }elseif ($thePageLink
                            == 'http://cafef.vn/vi-mo-dau-tu.chn'
                        ) {
                            $catId = 8;
                        }elseif ($thePageLink
                            == 'http://cafef.vn/doanh-nghiep.chn'
                        ) {
                            $catId = 8;
                        }elseif ($thePageLink
                            == 'http://cafef.vn/hang-hoa-nguyen-lieu.chn'
                        ) {
                            $catId = 19;
                        }elseif ($thePageLink
                            == 'http://cafef.vn/song.chn'
                        ) {
                            $catId = 5;
                        }elseif ($thePageLink
                            == 'http://www.amthuc365.vn/am-thuc.html'
                        ) {
                            $catId = 10;
                        }

                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);
                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
            elseif ($sourcePage == 'laodong') {
                //liệt kê ra các link cần lấy dữ liệu:
                $arrayPageLink = [
                    'dulich' => 'http://laodong.com.vn/du-lich-kham-pha/',
                    'kinhte' => 'http://laodong.com.vn/kinh-te/',
                    'thoisu' => 'http://laodong.com.vn/thoi-su-xa-hoi/',
                    'kinhte' => 'http://laodong.com.vn/kinh-te/',
                ];

                //duyệt từng link 1:
                foreach ($arrayPageLink as $thePageLink) {
                    //tạo ra đối tượng crawler:
                    $newObj = new CrawlerObject();

                    //cấu hình properties cho đối tượng đó:
                    $newObj->linkPage = $thePageLink;

                    $newObj->construcBox
                        = "div.list-article article.story";
                    $newObj->construcA = 'figure.cover a';
                    $newObj->constructTilte = 'figure.cover a';
                    $newObj->constructImg = 'img';
                    $newObj->constructExcerpt = 'header div.summary';

                    //chạy phương thức getlink -> ra được đối tượng news:
                    $news = $newObj->getLink();

                    //kiểm tra sự tồn tài của link:
                    if ($model->checkSameLink('http://laodong.com.vn'.$news->source_url)->messageCode) {
                        //cấu hình mảng arrayToModel để chuẩn bị lưu thông tin:
                        $date = date("Y-m-d H:i:s");
                        $arrayToModel['create_at'] = $date;
                        $arrayToModel['source_url'] = 'http://laodong.com.vn'
                            .$news->source_url;
                        $arrayToModel['title'] = $news->titleMain->title;
                        $arrayToModel['excerpt'] = $news->excerpt->plaintext;
                        $arrayToModel['crawler_status'] = 1;
                        $arrayToModel['post_thumbnail'] = $news->post_thumbnail;

                        //xét link để lấy chuyên mục:
                        if ($thePageLink
                            == 'http://laodong.com.vn/du-lich-kham-pha/'
                        ) {
                            $catId = 17;
                        }elseif ($thePageLink
                            == 'http://laodong.com.vn/thoi-su-xa-hoi/'
                        ) {
                            $catId = 1;
                        }elseif ($thePageLink
                            == 'http://laodong.com.vn/kinh-te/'
                        ){
                            $catId = 8;
                        }
                        //sử dụng phương thức trong model, để thêm vào 1 bản ghi:
                        $result = $model->insertNew($arrayToModel, $catId);
                    }//end if(tồn tại link)
                }//end foreach duyệt từng link.
            }
        }
    }
}
