<x-front.layout title="{{ $title }}" script="option-chain">
    <main class="mt-[68px]">
        <section class="section pt-24">
            <h1 class="text-primary-dark text-semibold text-4xl lg:text-5xl">{{ $symbol }} Option chains(put and call)</h1>
            <p class="text-primary-dark text-xl mt-6">
                Fun fact: {{ $fact }}
            </p>
        </section>
        <section class="section pt-16">
            <div class="bg-white rounded-sm pt-[9px] px-9 pb-44 mb-4">
                <div>
                    <p class="text-primary-dark font-semibold">Underlying stock:</p>
                    <p class="@if((float)$currentStockInfo->change > 0) text-green-primary @endif font-semibold" @if((float)$currentStockInfo->change < 0) style="color:red !important" @endif >${{ $currentStockInfo->price }} <span
                    @if((float)$currentStockInfo->change < 0)
                        style="color:red !important"
                    @endif >{{ $currentStockInfo->change }} ({{ $currentStockInfo->percent }})<span></p>
                </div>
                <p class="pt-5 text-red-secondary font-semibold">Select option</p>
                <div class="flex gap-6 pt-5 flex-col lg:flex-row">

                    @foreach ($dates->toArray() as $year => $months)
                    <div class="flex flex-wrap gap-y-2 gap-x-2">
                        <div class="bg-panel-gray px-4 py-5 w-full lg:w-auto">
                            <p class="text-white font-bold text-center lg:text-start">{{ $year }}</p>
                        </div>
                        @foreach ($months as $month => $days)
                            <div class="flex flex-col border-r-4 border-l-4 border-t-4 border-b-4 border-panel-gray">
                                <div class="bg-panel-white px-9 py-1 text-center">
                                    {{ $month }}
                                </div>
                                <div class="flex">
                                    @foreach ($days as $key => $day)
                                        <a href="{{ $day['link'] }}" class="px-5 py-1 border-r-2 border-panel-white w-full text-center cursor-pointer @if($day['date'] === $startDate) bg-panel-gray border-none text-white @endif">
                                            {{ $day['day'] }}
                                        </a>
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>
                    @endforeach

                </div>
                <div class="mt-6 bg-panel-white py-2 px-6 flex gap-5 flex-col lg:flex-row options-chain-filters">
                    {{-- <div class="flex gap-1 flex-col">
                        <p class="text-primary-dark font-semibold">Underlying</p>
                        <input type="text" placeholder="{ticker}" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                    </div> --}}
                    <div class="flex gap-1 flex-col">
                        <p class="text-primary-dark font-semibold">Underlying</p>
                        <select name="underlying" id="underlying" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                            <option value="-">Select a symbol</option>
                            @foreach ($symbols as $symbolTarget)
                                <option value="{{ route('option-chain-symbol', ['symbol' => $symbolTarget]) }}">{{ $symbolTarget }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="flex gap-1 flex-col">
                        <p class="text-primary-dark font-semibold">Range</p>
                        <select name="range" id="range" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                            <option value="-">All</option>
                            <option value="near">Near the money</option>
                            <option value="in">In the money</option>
                            <option value="out">Out of the money</option>
                        </select>
                    </div>
                    <div class="flex gap-1 flex-col">
                        <p class="text-primary-dark font-semibold">Option Type(s)</p>
                        <select name="option-types" id="option-types" class="border border-primary-dark bg-white px-2 py-1 inline-block h-[34px]">
                            <option value="all">Calls & Puts</option>
                            <option value="calls">Calls only</option>
                            <option value="puts">Puts only</option>
                        </select>
                    </div>
                </div>
                <div class="mt-6 flex flex-col lg:flex-row gap-2 lg:gap-0 options">
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
                                @foreach ($calls->toArray() as $callRow)
                                    <tr data-type="{{ $callRow->optionRange }}" class="px-5 py-2 @if($callRow->optionRange === 'in') bg-panel-white @elseif($callRow->optionRange === 'near') bg-panel-white/30 @endif">
                                        <td class="text-center">{{ $callRow->price ? "$$callRow->price" : '$0.00' }}</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">{{ $callRow->volume ?  number_format($callRow->volume, 0, ".", ",") : '---' }}</td>
                                        <td class="text-center">{{ $callRow->openInt ?  number_format($callRow->openInt, 0, ".", ",") : '---' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    <div class="table2 shrink-0">
                        <h3 class="text-center text-primary-dark font-semibold py-3 px-5">{{ $usFormatedStartDate }}</h3>
                        <table class="w-full">
                            <thead>
                                <tr class="border-t-2 border-l-2 border-r-2 lg:border-l-0 lg:border-r-0 border-b-2 border-panel-gray">
                                    <th class="text-center">Strike</th>
                                </tr>
                            </thead>
                            <tbody class="py-2 border-b-2 border-l-2 border-r-2 lg:border-l-0 lg:border-r-0 border-panel-gray">
                                @foreach ($strikes->toArray() as $strike)
                                    @if(!empty($strike))
                                        <tr><td class="px-9 text-center">${{ $strike }}</td></tr>
                                    @endif
                                @endforeach
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
                                @foreach ($puts->toArray() as $callRow)
                                    <tr data-type="{{ $callRow->optionRange }}" class="px-5 py-2 @if($callRow->optionRange === 'in') bg-panel-white @elseif($callRow->optionRange === 'near') bg-panel-white/30 @endif">
                                        <td class="text-center">{{ $callRow->price ? "$$callRow->price" : '$0.00' }}</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">---</td>
                                        <td class="text-center">{{ $callRow->volume ?  number_format($callRow->volume, 0, ".", ",") : '---' }}</td>
                                        <td class="text-center">{{ $callRow->openInt ?  number_format($callRow->openInt, 0, ".", ",") : '---' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </section>
    </main>
    </x-front.layout>
