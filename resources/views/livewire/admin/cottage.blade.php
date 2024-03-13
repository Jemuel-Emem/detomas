<div>
    <div class="flex gap-2 mt-2">
        <x-input label="" placeholder="Search..." wire:model="search" />
    <div>
        <x-button  label="Search " wire:click.prevent="asss" class="bg-green-700 text-white hover:bg-green-900" />
    </div>

    <button class="bg-blue-700 text-white hover:bg-blue-900 w-36 rounded"  wire:click="add">Add Cottage </button>
    </div>
    <div class="relative overflow-x-auto mt-4">
        <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400">
            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                <tr>
                    <th scope="col" class="px-6 py-3">
                       Cottage Number
                     </th>
                     <th scope="col" class="px-6 py-3">
                        Cottage Code
                      </th>
                    <th scope="col" class="px-6 py-3">
                      Cottage Description
                    </th>
                    <th scope="col" class="px-6 py-3">
                       Cottage Price
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Cottage Photo
                     </th>
                     <th scope="col" class="px-6 py-3">
                        Status
                     </th>

                </tr>
            </thead>
            <tbody>
                @foreach($reserv as $cot)
                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $cot->id }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $cot->cottagecode }}
                    </td>
                    <td class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                        {{ $cot->description }}
                    </td>
                    <td class="px-6 py-4">
                        {{ $cot->price }}
                    </td>

                    <td class="px-6 py-4">
                        <img src="{{ asset(Storage::url($cot->cottagephoto)) }}" alt="Valid ID" class="w-20 h-16 rounded">
                    </td>

                    <td class="px-6 py-4">
                        {{ $cot->status}}
                    </td>
                </tr>


            @endforeach
            </tbody>

            <tfoot>
                <tr>
                    <td colspan="3">
                        <div class="mt-4">
                            {{ $reserv->links() }}
                        </div>
                    </td>
                </tr>
            </tfoot>
        </table>
    </div>


    <x-modal wire:model.defer="open_modal">
        <x-card title="Add Cottages">
            <div class="space-y-3">
                <div class="flex gap-2">
                    <x-input label="Cottage Code" placeholder="" wire:model="cottagecode" />
                  </div>
              <div class="flex gap-2">
                <x-input label="Description" placeholder="" wire:model="description" />
              </div>
              <div class="flex gap-2">

                <x-input label="Price" placeholder="" wire:model="price" />
              </div>
              <label class="block mb-3 text-sm md:text-base font-medium text-gray-600"
              name="email">
              Photo
          </label>
          <input type="file" wire:model="cottagephoto" accept="image/*" required>


            </div>

            <x-slot name="footer">
                <div class="flex justify-end gap-x-4">
                    <x-button flat label="Cancel" x-on:click="close" />
                    <x-button primary label="Submit" wire:click="submit"  />
                </div>
            </x-slot>
        </x-card>
    </x-modal>
</div>
