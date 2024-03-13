<?php

namespace App\Livewire\Admin;


use App\Models\Reservation as reservation;
use App\Models\ReservationList as reservationlist;
use App\Models\CancelledList as cancelledlist;
use App\Models\Cottage;
use App\Models\Totalincome as totalincome;
use Livewire\Component;
use Livewire\WithPagination;
class Pending extends Component
{
    use  WithPagination;

    public $search;
   public $edit_modal =false;
    public function render()
    {
        $search = '%' . $this->search . '%';

    return view('livewire.admin.pending', [
        'reserv' => Reservation::where('reservationid', 'like', $search)->paginate(10),
    ]);

    }
    public function asss()
    {

        $this->resetPage();
    }

    public function cancelthis(){
        $this->edit_modal= true;
    }
    public function confirm($Id){
        $reservation = Reservation::find($Id);

        if ($reservation) {

            reservationlist::create([
                'reservationid' => $reservation->reservationid,
                'fullname' => $reservation->fullname,
                'location' => $reservation->location,
                'number' => $reservation->number,
                'cottagenumber' => $reservation->cottagenumber,
                'paymenttype' => "Fully Paid",
                'children' => $reservation->children,
                'adults' => $reservation->adults,
                'checkin' => $reservation->checkin,
                'checkout' => $reservation->checkout,
                'totalbill' => $reservation->totalbill,
                'photopayment' => $reservation->photopayment,
                'photoid' => $reservation->photoid,

            ]);
            totalincome::create([
                'income' => $reservation->totalbill,
            ]);
            $this->updateCottageStatus($reservation->cottagenumber);
            $reservation->delete();

            $this->resetPage();
        }

    }

    private function updateCottageStatus($cottageCode)
    {
       // dd('Provided Cottage Code:', $cottageCode);

    $cottage = Cottage::where('cottagecode', $cottageCode)->first();

    // Add debug statement to check if the cottage is found
    // dd('Cottage found:', $cottage);

    if ($cottage) {
        $cottage->update([
            'status' => 'not available',
        ]);

    } else {
        dd('Cottage not found.');
    }
}


    public function cancell($Id){
        $reservation = Reservation::find($Id);

        if ($reservation) {

            cancelledlist::create([
                'reservationid' => $reservation->reservationid,
                'fullname' => $reservation->fullname,
                'location' => $reservation->location,
                'number' => $reservation->number,
                'cottagenumber' => $reservation->cottagenumber,
                'paymenttype' => $reservation->paymenttype,
                'children' => $reservation->children,
                'adults' => $reservation->adults,
                'checkin' => $reservation->checkin,
                'checkout' => $reservation->checkout,
                'totalbill' => $reservation->totalbill,
                'photopayment' => $reservation->photopayment,
                'photoid' => $reservation->photoid,

            ]);


            $reservation->delete();

            $this->resetPage();
            $this->edit_modal=false;
        }

    }
}
