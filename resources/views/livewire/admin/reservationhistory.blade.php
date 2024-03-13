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
                        Payment
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
                     <th scope="col" class="px-6 py-3">
                           Date/Time
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
                       {{ $reservation->created_at->format('Y-m-d H:i:s') }}
                    </td>


                    <td class="px-6 py-4">
                        <span class="flex flex-col gap-2">
                           <button class="bg-green-500 hover:bg-green-600 text-white p-1 rounded"  wire:click="edit({{ $reservation->id }})">Update</button>

                        </span>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>


    <x-modal wire:model.defer="edit_modal">
        <x-card title="Edit Data">
            <div class="space-y-3">
              <div class="flex gap-2">
                <x-input label="Reservation ID" wire:model="reservationid" placeholder="" />
                <x-input label="Full Name" placeholder="" wire:model="fullname" />
              </div>
              <div class="flex gap-2">
                <x-input label="Location" wire:model="location" placeholder="" />
                <x-input label="Number" placeholder="" wire:model="number" />
              </div>
              <div class="flex gap-2">
                <x-input label="Cottage #" wire:model="cottagenumber" placeholder="" />
                <x-input label="Children" placeholder="" wire:model="children" />
              </div>
              <div class="flex gap-2">
                <x-input label="Payment" wire:model="paymenttype" placeholder="" />
              </div>
              <div class="flex gap-2">
                <x-input label="Adults" wire:model="adults" placeholder="" />
              </div>
              <div class="flex gap-2">
                <x-input label="Check In" wire:model="checkin" placeholder="" />
                <x-input label="Check Out" placeholder="" wire:model="checkout" />
              </div>
              <div class="flex gap-2">
                <x-input label="Total Bill" wire:model="totalbill" placeholder="" />
              </div>

               <div class="flex justify-around gap-2 ">
                <div>
                    <label for="">Prof Of Payment</label>
                    <img src="{{ asset(Storage::url($photopayment)) }}" alt="Valid ID" class="w-20 h-16 rounded">
                </div>
                <div>
                    <label for="">Valid ID</label>
                    <img src="{{ asset(Storage::url($photoid)) }}" alt="Valid ID" class="w-20 h-16 rounded">
                </div>
              </div>

            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close"  wire:click="back"/>
                    <x-button primary label="Submit" wire:click="submitEdit" spinner="submitEdit" />
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
     </script>

     <style>
         @media print {
            @page {
            size: landscape;
        }
             body > *:not(#printContent) {
                 display: none !important;
             }
         }
     </style>
</div>
