<?php

namespace App\Jobs;

use App\Email;
use Carbon\Carbon;
use FreshMail\RestApi;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendEmailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    private $data;
    private $recipient;
    private $template;
    private $subject;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($recipient, $template, $data = [], $subject = false)
    {
        $this->data = $data;
        $this->template = $template;
        $this->recipient = $recipient;
        $this->subject = $subject;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rest = new RestApi();
        $rest->setApiKey(config('freshmail.api'));
        $rest->setApiSecret(config('freshmail.secret'));

        $payload = [
            'subscriber' => $this->recipient,
            'subject'    => $this->subject ? $this->subject : config('emailTemplates.' . $this->template . '.subject'),
            'html'       => view('emails.templates.' . config('emailTemplates.' . $this->template . '.template'), $this->data)->render(),
            'from'       => config('freshmail.from'),
            'from_name'  => config('freshmail.from_name')
        ];
        try {
            $email = new Email;
            $email->recipient = $payload['subscriber'];
            $email->subject = $payload['subject'];
            $email->content = $payload['html'];
            $email->to_send_at = isset($this->data['to_send_at']) ? $this->data['to_send_at'] : Carbon::now();
            if (auth()->user()) {
                $email->user_id = auth()->user()->id;
            }
            $email->save();

            $response = $rest->doRequest('mail', $payload);

            $email->sent = 1;
            $email->vendor_response = json_encode($response);
            $email->sent_at = Carbon::now()->format('Y-m-d H:i:s');
            $email->update();

            \Log::debug('SendEmail - email sended', ['email' => $email]);
        } catch (\Exception $e) {
            \Log::error('Email send - error', ['msg' => $e->getMessage(), 'data' => $payload, 'error' => $rest->getRawResponse()]);
            $email->vendor_response = json_encode(['status'=>$e->getCode(),'message'=>$e->getMessage()]);
            $email->update();
        }
    }
}
