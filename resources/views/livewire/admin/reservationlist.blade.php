<div>
    <div class="flex gap-2 mt-2">
        <x-input label="" placeholder="Search..." wire:model="search" />
    <div>
        <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
    </div>
    </div>
    <div class="flex justify-end mt-4 h-10 ">
        <button id="printButton" class="bg-gray-600 text-white hover:bg-gray-500 w-32 rounded-xl">Print</button>
      </div>
    <div id="printContent" class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Reservation Code
                     </th>
                    <th scope="col" class="px-6 py-3">
                       Full Name
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Location
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cottage Number
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Payment Type
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Children
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Adults
                     </th>
                     <th scope="col" class="px-6 py-3">
                        Check In
                      </th>
                      <th scope="col" class="px-6 py-3">
                        Check Out
                      </th>

                      <th scope="col" class="px-6 py-3">
                        Total Bill
                      </th>

                      <th scope="col" class="px-6 py-3">
                     POP
                      </th>

                      <th scope="col" class="px-6 py-3">
                      ID
                         </th>

                    <th scope="col" class="px-6 py-3 text-center">
                     Action
                      </th>

                </tr>
            </thead>
            <tbody>
                @foreach($reserv as $reservation)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->reservationid }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $reservation->fullname }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->location }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->number }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->cottagenumber }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->paymenttype }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->children }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->adults }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->checkin }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->checkout }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $reservation->totalbill }}
                    </td>

                    <td class="px-6 py-4">
                        <img src="{{ asset(Storage::url($reservation->photopayment)) }}" alt="Proof of Payment" class="w-20 h-16 rounded">

                    </td>
                    <td class="px-6 py-4">

                        <img src="{{ asset(Storage::url($reservation->photoid)) }}" alt="Valid ID" class="w-20 h-16 rounded">

                    </td>

                    <td class="px-6 py-4">
                        <span class="flex flex-col gap-2">
                           <button class="bg-green-500 hover:bg-green-600 text-white p-1 rounded" wire:click="confirm({{ $reservation->id }})">Done</button>
                          <button  class="bg-gray-600 hover:bg-gray-500 text-white rounded p-1 w-32 "wire:click="openReceiptModal({{ $reservation->id }})" >View/Print</button>
                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>

    <x-modal wire:model.defer="reciept_modal">
        <x-card title="Receipt">
            <div class="space-y-3"  id="modalContent">
                <div class="flex flex-col justify-center items-center">
                    <div>  <img src="{{ asset('images/logo.png') }}" alt="Violation Photo" class="w-16 h-16"></div>
                    <div>
                        <span class="text-xl font-black"> MONTE VECENTEU RESORT</span>
                    </div>
                </div>
                @if($currentReservation)
                    <div class="flex justify-evenly mt-4">
                        <div>Reservation Code: <span class="underline">{{ $currentReservation->reservationid }}</span></div>
                        <div>Date: <span id="currentDate" class="underline">{{ $currentDate }}</span></div>
                    </div>

                    <div class="flex justify-around mt-4">
                        <span>Name: {{ $currentReservation->fullname }}</span>
                        <span>Cottage Number: {{ $currentReservation->cottagenumber }}</span>
                        <span>Payment Status: {{ $currentReservation->paymenttype }}</span>
                    </div>
                @else
                    <div class="text-red-500">Reservation not found.</div>
                @endif
            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Print Receipt"  onclick="printModalContent()" />
                </div>
            </x-slot>
        </x-card>
    </x-modal>

     <script>
        function printPage() {
         var printContent = document.getElementById("printContent").innerHTML;
         var originalContent = document.body.innerHTML;


         var header = "<h1 style='text-align: center;'>REPORTS</h1>";
         printContent = header + printContent;

         document.body.innerHTML = printContent;
         window.print();
         document.body.innerHTML = originalContent;
     }

         document.getElementById("printButton").addEventListener("click", printPage);

         function printModalContent() {
        var modalContent = document.getElementById('modalContent').innerHTML;
        var originalContent = document.body.innerHTML;

        // Add modal content to body to print
        document.body.innerHTML = modalContent;


        // Trigger browser's print functionality
        window.print();

        // Restore original content
        document.body.innerHTML = originalContent;
    }




     </script>



     <style>
         @media print {
             body > *:not(#printContent) {
                 display: none !important;
             }
         }
     </style>
</div>
