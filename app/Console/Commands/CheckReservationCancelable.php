<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Reservation;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Console\Output\ConsoleOutput;

class CheckReservationCancelable extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:check-reservation-cancelable';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check reservations and update is_cancelable column if less than 2 hours';

    /**
     * Execute the console command.
     */
    public function handle ()
    {
        Reservation::where ( 'is_cancelable', true )
            ->whereRaw ( "CONCAT(date, ' ', time) < DATE_ADD(NOW(), INTERVAL 2 HOUR)" )
            ->update ( [ 'is_cancelable' => false ] );

        // $reservations   = Reservation::where ( 'is_cancelable', true )->get ();
        // $reservationIds = [];

        // foreach ( $reservations as $reservation )
        // {
        //     $reservationDateTime = Carbon::createFromFormat ( 'Y-m-d H', $reservation->date . ' ' . $reservation->time );

        //     if ( $reservationDateTime->isPast () || $reservationDateTime->diffInHours ( Carbon::now () ) < 2 )
        //     {
        //         $reservationIds[] = $reservation->id;
        //     }
        // }

        // Reservation::whereIn ( 'id', $reservationIds )->update ( [ 'is_cancelable' => false ] );
    }
}