<?php

namespace App\Observers;

use App\Models\User;
use App\Models\product;
use Illuminate\Support\Facades\Auth;
use App\Notifications\ProductNotification;
use Illuminate\Support\Facades\Notification;

class ProductObserver
{
    /**
     * Handle the product "created" event.
     */
    public function created(product $product): void
    {
        $user = auth()->user();
        $users = User::where('id', '!=', auth()->id())->get();
        if ($users->isNotEmpty()) {
            Notification::send($users, new ProductNotification(
                $product->id,
                $product->name,
            ));
        }
    }

    /**
     * Handle the product "updated" event.
     */
    public function updated(product $product): void
    {
        //
    }

    /**
     * Handle the product "deleted" event.
     */
    public function deleted(product $product): void
    {
        //
    }

    /**
     * Handle the product "restored" event.
     */
    public function restored(product $product): void
    {
        //
    }

    /**
     * Handle the product "force deleted" event.
     */
    public function forceDeleted(product $product): void
    {
        //
    }
}
