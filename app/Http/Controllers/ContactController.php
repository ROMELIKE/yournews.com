<?php

namespace App\Http\Controllers;

use App\Business\ContactBusiness;
use App\Business\UserBusiness;
use App\Http\Requests\ContactRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;

class ContactController extends Controller
{
    //
    public function getContact()
    {
        //get user-infomation
        $id = Session::get('user_id');

        $bus = new UserBusiness();
        $user = $bus->getUserInfo($id);

        if ($user->messageCode) {
            //return view
            $thisUser = $user->result;

            return view('user.contact', compact(['data', 'thisUser']));
        } else {
            return redirect()->back()->with([
                'flash_level' => 'warning',
                'flash_massage' => $user->message
            ]);
        }
    }

    public function postContact(ContactRequest $request)
    {
        //send user's email-->to me!!
        $data = [
            'username' => $request->username,
            'content' => $request->message,
            'email' => $request->email
        ];
        //call to business:
        $bus = new ContactBusiness();
        $mail = $bus->postContact($data);

        if ($mail->messageCode) {
            return redirect()->route('getindex')->with([
                'flash_level' => 'success',
                'flash_message' => 'Thank for your feedback, we will reply soon!'
            ]);
        } else {
            return redirect()->route('getcontact')->with([
                'flash_level' => 'warning',
                'flash_message' => 'Sorry, but you could not send this Email!'
            ]);
        }
    }
}
