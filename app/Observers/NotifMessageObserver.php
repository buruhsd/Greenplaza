<?php
namespace App\Observers;
use App\Models\Message;
use App\User;
use App\Notifications\NewMessage;
class NotifMessageObserver
{
    //listen to creating config
    public function created(Message $item)
    {
        $this->setLog("created", $item);
    }
    public function updated(Message $item)
    {
        $this->setLog("updated", $item);
    }
    public function deleted(Message $item)
    {
        $this->setLog("deleted", $item);
    }
    public function restored(Message $item)
    {
        $this->setLog("restored", $item);
    }
    private function setLog($type, $item)
    {
        switch ($type) {
            case 'created':
                $data['title'] = 'Pesan Masuk';
                $data['route'] = route('member.message.index', ['status'=>'from']);
                $data['status'] = 200;
                $data['message'] = str_limit($item->message_text, 50);
                $author = $item->from;
                $user = $item->to;
                $user->notify(new NewMessage($item,$author,$data));
            break;
            default:
            break;
        }
    }
}