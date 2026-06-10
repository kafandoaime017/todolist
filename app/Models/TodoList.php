<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DateTime;
use App\Models\User;
use App\Models\Item;
use App\Services\EmailSenderService;


class TodoList extends Model
{
    private array $items=[];
    private  ?DateTime $lastItemCreatedAt=null;

    public function __construct(private User $user){}


    public function add(Item $item):void
    {
        if(!$this->user->isValid()){
            throw new \Exception("User invalid.");
        }   

        if(count($this->items) >= 10){
            throw new \Exception("Cannot add more than 10 items to the todo list.");
        }

        if($this->lastItemCreatedAt){
           $diff=$item->createdAt->getTimestamp() - $this->lastItemCreatedAt->getTimestamp();
           if ($diff < 1800){
              throw new \Exception("Cannot add more than one item within 30 minutes.");
           }
        }

        foreach ($this->items as $existingItem) {
            if ($existingItem->name === $item->name) {
                throw new \Exception("Name must be unique.");
            }
        }

        $this->items[]=$item;
        $this->lastItemCreatedAt=$item->createdAt;

        if(count($this->items) ===8){
           app(EmailSenderService::class)->send(
                $this->user->email,
                "Votre Todolist est presque pleine",
           );
        }
    }

    public function getItems():array
    {
        return $this->items;
    }
}
