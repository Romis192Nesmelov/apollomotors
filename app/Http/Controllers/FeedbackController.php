<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Action;

class FeedbackController extends Controller
{
    use HelperTrait;

    public function sendRequest(Request $request)
    {
        return $this->sendMessage('request', $this->validate($request, [
            'name' => 'required|min:3|max:255',
            'phone' => $this->validationPhone,
            'type' => 'required|in:request_for_consultation,online_registration_for_the_promotion,online_appointment_for_repair,online_appointment_for_maintenance,online_appointment_for_online_appointment_for_spare',
            'action_id' => 'nullable|exists:actions,id',
            'comment' => 'max:400',
            'i_agree' => 'required|accepted'
        ]), $request->ajax());
    }

    public function sendMessage($template, array $fields, $isAjax, $pathToFile=null)
    {
        if (isset($fields['action_id']) && $fields['action_id']) {
            $fields['action'] = strip_tags(Action::where('id',$fields['action_id'])->pluck('text')->first());
        }

        Mail::send('emails.'.$template, $fields, function($message) use ($pathToFile) {
            $message->subject(trans('content.website_message').env('APP_NAME'));
            $message->to(env('MAIL_TO'));
            if ($pathToFile) $message->attach($pathToFile);
        });
        $message = trans('content.we_will_contact_you');
        return $isAjax
            ? response()->json(['success' => true, 'message' => $message])
            : redirect()->back()->with('message', $message);
    }
}
