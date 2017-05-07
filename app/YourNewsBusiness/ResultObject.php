<?php
namespace App\YourNewsBusiness;

class ResultObject {

    /** @var string message */
    public $message;

    /** @var int code */
    public $messageCode;

    /** @var int number of results */
    public $numberOfResult;

    /** @var mixed result content everything of return data, eg: array, object.... */
    public $result;

} // end class
class Message {

    const GENERAL_ERROR = 0;

    const SUCCESS = 1;
}