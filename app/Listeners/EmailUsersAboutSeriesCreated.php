<?php

namespace App\Listeners;

use App\Models\User;
use App\Mail\SeriesCreated as SeriesCreatedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\SeriesCreated as SeriesCreatedEvent;

class EmailUsersAboutSeriesCreated implements ShouldQueue
{
    /**
     * Handle the event.
     *
     * @param  SeriesCreatedEvent  $event
     * @return void
     */
    public function handle(SeriesCreatedEvent $event)
    {
        $userList = User::all();
        foreach ($userList as $index => $user) {
            $email = new SeriesCreatedMail(
                $event->seriesName,
                $event->seriesId,
                $event->seriesSeasonsQty,
                $event->seriesEpisodesPerSeason
            );
            $when = now()->addSeconds($index * 5);  // Delay email sending for each user
            Mail::to($user)->later($when, $email);
        }
    }
}
