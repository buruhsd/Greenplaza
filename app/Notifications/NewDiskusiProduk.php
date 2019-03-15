<?php
namespace App\Notifications;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Produk_discuss;
use App\User;
class NewDiskusiProduk extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    protected $diskusi,$user,$data;
    public function __construct(Produk_discuss $item,User $user,array $data)
    {
        $this->diskusi = $item;
        $this->user = $user;
        $this->data = $data;
    }
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }
    
    public function toArray($notifiable)
    {
        return [
            'user_id' => $this->user->id,
            'user_name' => $this->user->name,
            'item' => $this->diskusi->toArray(),
            'data' => $this->data
        ];
    }    
}