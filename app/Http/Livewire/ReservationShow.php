<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Reservation;

class ReservationShow extends Component
{

    public $reservations;

    public function mount()
    {
        $this->refreshReservations();
    }

    public function refreshReservations()
    {
        $this->reservations = Reservation::all();
    }

    public function render()
    {
        return view('livewire.reservation-show', ['reservations' => $this->reservations])
            ->with('reservations', $this->reservations);
    }

    protected $listeners = ['refreshReservations'];

    public function getListeners()
    {
        return [
            'echo:reservations,ReservationUpdated' => 'refreshReservations',
        ];
    }
}
