<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InquiryMail extends Mailable
{
    use Queueable, SerializesModels;
    // ビュー内で利用する変数を定義しています。
    public $email;
    public $name;
    public $relationship;
    public $content;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(array $data)
    {
        // コンストラクタに渡された引数をpublic変数に代入するコードを追加しています。
        foreach ($data as $key => $value) {
            $this->{$key} = $value;
        }
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        // メールの生成部分のコードになります。
        // subjectメソッドは件名を生成しています。
        // textメソッドは引数としてビューのパスを渡すことで、テキストメールとして本文を生成します。
        // メール本文に resources/views/emails/inquiry.blade.php の内容をセットする
        return $this->subject($this->name . 'さんにお知らせがあります')
            ->text('emails.inquiry');
    }
}
