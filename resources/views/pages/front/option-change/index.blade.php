<x-front.layout title="{{ $title }}">
<main class="mt-[68px]">
    <section class="section pt-24">
        <h1 class="text-primary-dark text-semibold text-4xl lg:text-5xl">{ticker} Option chains(put and call)</h1>
        <p class="text-primary-dark text-xl mt-6">
            {{ $randomFact }}
        </p>
    </section>
    <section class="section pt-16">
        <div class="bg-white rounded-sm pt-[9px] px-9 pb-44 mb-4">
            <div>
                <p class="text-primary-dark font-semibold">Underlying stock:</p>
                <p class="text-green-primary font-semibold">$180.37 +1.70 (0.90%)</p>
            </div>
            <p class="pt-5 text-red-secondary font-semibold">Select option</p>
            <div class="flex gap-6 pt-5 flex-col lg:flex-row">
                <div class="flex flex-wrap gap-y-2 gap-x-2">
                    <div class="bg-panel-gray px-4 py-5 w-full lg:w-auto">
                        <p class="text-white font-bold text-center lg:text-start">2024</p>
                    </div>
                    <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                        <div class="bg-panel-white px-9 py-1 text-center">
                            March
                        </div>
                        <div class="flex">
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                                21
                            </div>
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                                21
                            </div>
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                                21
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                        <div class="bg-panel-white px-9 py-1 text-center">
                            Apr
                        </div>
                        <div class="flex">
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                                21
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                        <div class="bg-panel-white px-9 py-1 text-center">
                            May
                        </div>
                        <div class="flex">
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                               23
                            </div>
                        </div>
                    </div>
                </div>
                <div class="flex flex-wrap gap-y-2 gap-x-2">
                    <div class="bg-panel-gray px-4 py-5 w-full lg:w-auto">
                        <p class="text-white font-bold text-center lg:text-start">2025</p>
                    </div>
                    <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                        <div class="bg-panel-white px-9 py-1 text-center">
                            Apr
                        </div>
                        <div class="flex">
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                                21
                            </div>
                        </div>
                    </div>
                    <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                        <div class="bg-panel-white px-9 py-1 text-center">
                            May
                        </div>
                        <div class="flex">
                            <div class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer">
                               23
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-6 bg-panel-white py-2 px-6 flex gap-5 flex-col lg:flex-row">
                <div class="flex gap-1 flex-col">
                    <p class="text-primary-dark font-semibold">Underlying</p>
                    <input type="text" placeholder="{ticker}" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                </div>
                <div class="flex gap-1 flex-col">
                    <p class="text-primary-dark font-semibold">Range</p>
                    <select name="range" id="range" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                        <option value="-">Near the many</option>
                        <option value="-">Near the many</option>
                        <option value="-">Near the many</option>
                    </select>
                </div>
                <div class="flex gap-1 flex-col">
                    <p class="text-primary-dark font-semibold">Option Type(s)</p>
                    <select name="option-types" id="option-types" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                        <option value="-">Calls&puts</option>
                        <option value="-">Near the many</option>
                        <option value="-">Near the many</option>
                    </select>
                </div>
            </div>
            <div class="mt-6 flex flex-col lg:flex-row gap-2 lg:gap-0">
                <div class="table1 grow">
                    <h3 class="text-center text-primary-dark font-semibold py-3">Calls</h3>
                    <table class="w-full ">
                        <thead>
                            <tr class="border-2 border-panel-gray">
                                <th class="text-center">Last</th>
                                <th class="text-center">Bid</th>
                                <th class="text-center">Mid</th>
                                <th class="text-center">Ask</th>
                                <th class="text-center">Vol.</th>
                                <th class="text-center">Open Int</th>
                            </tr>
                        </thead>
                        <tbody class="py-2 border-l-2  border-b-2 border-r-2 border-panel-gray">
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 ">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <div class="table2 shrink-0">
                    <h3 class="text-center text-primary-dark font-semibold py-3 px-5">Apr. 23 2024</h3>
                    <table class="w-full">
                        <thead>
                            <tr class="border-t-2 border-l-2 border-r-2 lg:border-l-0 lg:border-r-0 border-b-2 border-panel-gray">
                                <th class="text-center">Strike</th>
                            </tr>
                        </thead>
                        <tbody class="py-2 border-b-2 border-l-2 border-r-2 lg:border-l-0 lg:border-r-0 border-panel-gray">
                            <tr><td class="px-9 text-center">100</td></tr>
                            <tr><td class="px-9 text-center">120</td></tr>
                            <tr><td class="px-9 text-center">120</td></tr>
                            <tr><td class="px-9 text-center">120</td></tr>
                            <tr><td class="px-9 text-center">120</td></tr>
                            <tr><td class="px-9 text-center">120</td></tr>
                        </tbody>
                    </table>
                </div>
                <div class="table3 grow">
                    <h3 class="text-center text-primary-dark font-semibold py-3">Puts</h3>
                    <table class="w-full">
                        <thead>
                            <tr class="border-2 border-panel-gray">
                                <th>Last</th>
                                <th>Bid</th>
                                <th>Mid</th>
                                <th>Ask</th>
                                <th>Vol.</th>
                                <th>Open Int</th>
                            </tr>
                        </thead>
                        <tbody class="py-2 border-l-2 border-b-2 border-r-2 border-panel-gray">
                            <tr class="px-5 py-2">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 ">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                            <tr class="px-5 py-2 bg-panel-white">
                                <td class="text-center">0.35</td>
                                <td class="text-center">0.30</td>
                                <td class="text-center">0.25</td>
                                <td class="text-center">0.20</td>
                                <td class="text-center">50</td>
                                <td class="text-center">80</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</main>
</x-front.layout>
