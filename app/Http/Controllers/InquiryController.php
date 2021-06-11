<?php

namespace App\Http\Controllers;

use App\Http\Requests\InquiryRequest;
use App\Mail\InquiryMail;            // 追加
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Models\Inquiry;

class InquiryController extends Controller
{
    public function index()
    {
        // return 'hello world!';
        return view('index');
    }
    public function postInquiry(InquiryRequest $request)
    {
        // return 'ok';
        $validated = $request->validated();

        $request->session()->put('inquiry', $validated);
        return redirect(route('confirm'));
    }
    public function showConfirm(Request $request)
    {
        $sessionData = $request->session()->get('inquiry');
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        $message = view('emails.inquiry', $sessionData);
        return view('confirm', ['message' => $message]);
    }
    public function postConfirm(Request $request)
    {
        // セッションデータを取得したあと、forgetメソッドでセッションデータを削除しています。
        // これは送信後、セッションデータを残したままですと、トップページに戻った場合に入力内容が復元されてしまう事を防ぐためになります。
        $sessionData = $request->session()->get('inquiry');
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        $request->session()->forget('inquiry');
        Inquiry::create($sessionData);
        // toメソッドをメールの送信先アドレスを指定しますので、セッションに保存しているメールアドレスを使っています。
        // sendメソッドの引数はMailableクラスのインスタンスを指定しますので、本パート前半で作成したInquiryMailクラスを作成し、引数として指定します。
        Mail::to($sessionData['email'])
            ->send(new InquiryMail($sessionData));
            return redirect(route('sent'))->with('sent_inquiry', true);
    }

    public function showSentMessage(Request $request)
    {
        $request->session()->keep('sent_inquiry');
        $sessionData = $request->session()->get('sent_inquiry');
        if (is_null($sessionData)) {
            return redirect(route('index'));
        }
        return view('sent');
    }
}
