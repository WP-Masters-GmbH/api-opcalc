<x-front.layout title="{{ $title }}">
    <main class="mt-[68px]">
        <section class="section pt-16">
          <div>
            <p
              class="text-blue-primary font-medium text-md lg:text-xl capitalize text-center"
            >
              Market Research by OpCalc
            </p>
            <h1
              class="text-primary-dark text-3xl lg:text-7xl text-center font-semibold lg:leading-[90px] py-2"
            >
              We provide the numbers, you do the trading
            </h1>
            <p
              class="text-center text-primary-dark text-lg lg:text-xl font-medium"
            >
              Discovery insights, financials, stats, and trends in the stocks &
              options markets.
            </p>
          </div>
        </section>
        <section class="section pt-9 lg:pt-24">
          <div class="bg-not-white rounded-xl p-3 lg:p-6">
            <div
              class="flex gap-8 py-2 border-b-2 border-b-blue-primary flex-wrap"
            >
              <button data-table="1" class="rates-tab rates-tab_active">
                Highest IV options
              </button>
              <button data-table="2" class="rates-tab">
                Stocks by Market Cap
              </button>
              <button data-table="3" class="rates-tab">Upcoming earnings</button>
              <button data-table="4" class="rates-tab">
                Highest dividend paying stocks
              </button>
              <button data-table="5" class="rates-tab">
                Yesterday's biggest gainers
              </button>
            </div>
            <div class="rates-tables pt-3">
              <div id="table-1" class="rates-table rates-table_active">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left">
                    <thead class="text-xs text-black uppercase bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Symbol
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Market
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          IV
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Type
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Strike
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Price
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Expiry
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Earnings
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-normal"
                        >
                          ABC
                        </th>
                        <td class="px-6 py-2 text-black text-xs">$190.32</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          300%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          5.30%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">Call</td>
                        <td class="px-6 py-2 text-black text-xs">15</td>
                        <td class="px-6 py-2 text-black text-xs">1.50</td>
                        <td class="px-6 py-2 text-black text-xs">01/15/24</td>
                        <td class="px-6 py-2 text-black text-xs">05/30/24</td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-normal"
                        >
                          ABC
                        </th>
                        <td class="px-6 py-2 text-black text-xs">$190.32</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          300%
                        </td>
                        <td class="px-6 py-2 text-red-primary text-xs">-5.30%</td>
                        <td class="px-6 py-2 text-black text-xs">Call</td>
                        <td class="px-6 py-2 text-black text-xs">15</td>
                        <td class="px-6 py-2 text-black text-xs">1.50</td>
                        <td class="px-6 py-2 text-black text-xs">01/15/24</td>
                        <td class="px-6 py-2 text-black text-xs">05/30/24</td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-normal"
                        >
                          ABC
                        </th>
                        <td class="px-6 py-2 text-black text-xs">$190.32</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          300%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          5.30%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">Call</td>
                        <td class="px-6 py-2 text-black text-xs">15</td>
                        <td class="px-6 py-2 text-black text-xs">1.50</td>
                        <td class="px-6 py-2 text-black text-xs">01/15/24</td>
                        <td class="px-6 py-2 text-black text-xs">05/30/24</td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-normal"
                        >
                          ABC
                        </th>
                        <td class="px-6 py-2 text-black text-xs">$190.32</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          300%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          5.30%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">Call</td>
                        <td class="px-6 py-2 text-black text-xs">15</td>
                        <td class="px-6 py-2 text-black text-xs">1.50</td>
                        <td class="px-6 py-2 text-black text-xs">01/15/24</td>
                        <td class="px-6 py-2 text-black text-xs">05/30/24</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="table-2" class="rates-table">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left">
                    <thead class="text-xs text-black uppercase bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          ticker
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Market cap
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          52week hi/lo
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          last price
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          %Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Volume
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="table-3" class="rates-table">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left">
                    <thead class="text-xs text-black uppercase bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Symbol
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Market
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          EPS
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          ~est EPS
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Price Range
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Options Premium
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Simulate
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          $190.32
                        </td>
                        <td class="px-6 py-2 text-black text-xs">14.50</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          4.35
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          $180.00 : $200.35
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          6.37%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          <a
                            href=""
                            class="rounded-md text-white bg-dark-primary capitalize py-1 px-3 font-medium"
                            >simulate</a
                          >
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          $190.32
                        </td>
                        <td class="px-6 py-2 text-black text-xs">14.50</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          4.35
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          $180.00 : $200.35
                        </td>
                        <td class="px-6 py-2 text-red-primary text-xs">-6.37%</td>
                        <td class="px-6 py-2 text-black text-xs">
                          <a
                            href=""
                            class="rounded-md text-white bg-dark-primary capitalize py-1 px-3 font-medium"
                            >simulate</a
                          >
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          $190.32
                        </td>
                        <td class="px-6 py-2 text-black text-xs">14.50</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          4.35
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          $180.00 : $200.35
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          6.37%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          <a
                            href=""
                            class="rounded-md text-white bg-dark-primary capitalize py-1 px-3 font-medium"
                            >simulate</a
                          >
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          $190.32
                        </td>
                        <td class="px-6 py-2 text-black text-xs">14.50</td>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          4.35
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          $180.00 : $200.35
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          6.37%
                        </td>
                        <td class="px-6 py-2 text-black text-xs">
                          <a
                            href=""
                            class="rounded-md text-white bg-dark-primary capitalize py-1 px-3 font-medium"
                            >simulate</a
                          >
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="table-4" class="rates-table">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left">
                    <thead class="text-xs text-black uppercase bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          ticker
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Market cap
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          52week hi/lo
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          last price
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          %Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Volume
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <div id="table-5" class="rates-table">
                <div class="relative overflow-x-auto">
                  <table class="w-full text-sm text-left">
                    <thead class="text-xs text-black uppercase bg-white">
                      <tr>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          ticker
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Market cap
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          52week hi/lo
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          last price
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          %Change
                        </th>
                        <th
                          scope="col"
                          class="px-6 py-3 uppercase text-neutral pt-4 pb-8 text-xs font-extrabold"
                        >
                          Volume
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                      <tr class="even:bg-white odd:bg-gray-50 border-b">
                        <th
                          scope="row"
                          class="px-6 py-2 text-black text-xs font-bold"
                        >
                          AAPL
                        </th>
                        <td class="px-6 py-2 text-black text-xs font-bold">
                          795.648M
                        </td>
                        <td class="px-6 py-2 text-black text-xs">90.15B</td>
                        <td class="px-6 py-2 text-black text-xs">4.4800</td>
                        <td class="px-6 py-2 text-red-primary text-xs">
                          -2.2300
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          +4.88%
                        </td>
                        <td class="px-6 py-2 text-green-primary text-xs">
                          66.705M
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
            <a href="#more" class="view-more-link">View more</a>
          </div>
        </section>
        <section class="section py-[46px]">
          <form action="/">
            <div class="relative max-w-[820px] m-auto">
              <div class="flex flex-nowrap">
                <input
                  type="text"
                  name="search"
                  id="home-search"
                  class="bg-white py-4 pl-4 w-full rounded-tl-md rounded-bl-md"
                  placeholder="Search for data..."
                />
                <button
                  type="submit"
                  class="font-bold text-panel-white py-4 px-6 bg-sea-light rounded-tr-md rounded-br-md w-auto"
                >
                  Search
                </button>
              </div>
              <div class="absolute w-full z-[60] shadow-2xl search-hints">
                <div
                  class="w-full bg-gradient-to-tl from-sea-dark to-orange-dark font-semibold text-panel-white text-lg py-[7px] px-8"
                >
                  Popular searches
                </div>
                <div
                  class="pl-16 block bg-white pt-5 pb-4 rounded-bl-md rounded-br-md"
                >
                  <ul class="list-disc font-semibold text-lg search-variants">
                    <li class="cursor-pointer">Largest 1 year gains</li>
                    <li class="cursor-pointer">Highest IV options</li>
                    <li class="cursor-pointer">AAPL Options chain</li>
                    <li class="cursor-pointer">Upcoming earnings Feb 2024</li>
                  </ul>
                </div>
              </div>
            </div>
          </form>
        </section>
        <section
          class="w-full flex justify-center bg-gradient-to-tl from-sea-dark to-orange-dark"
        >
          <div class="py-16">
            <div class="relative">
              <div
                class="bg bg-black flex gap-[6px] pt-3 px-6 pb-4 w-[263px] rounded-md h-[70px] absolute -top-5 left-4 lg:top-[115px] lg:-left-[80px]"
              >
                <p class="text-white font-semibold">01</p>
                <p class="text-white">Add-free!</p>
              </div>
              <div
                class="bg bg-black flex gap-[6px] pt-3 px-6 pb-4 w-[263px] rounded-md h-[70px] absolute -bottom-5 right-4 lg:bottom-[90px] lg:-right-[70px]"
              >
                <p class="text-white font-semibold">02</p>
                <p class="text-white">3 tools included for the price of 1</p>
              </div>
              <img
                width="702"
                loading="lazy"
                height="423"
                class="w-full h-full"
                src="/images/mac-air.svg?11"
                alt="Mac profits"
              />
            </div>
            <div class="px-4 pt-8 lg:pt-0 lg:px-0 lg:max-w-[680px] m-auto">
              <h2 class="text-panel-white text-5xl font-semibold text-center">
                OpCalc Pro
              </h2>
              <p class="pt-3 text-panel-white text-center">
                At OpCalc we have been providing tools and resources to traders
                since 2008, we have now launched our Pro plan which includes our
                calculator (without ads), a trading journal to track your trades
                (even wheel strategies), and a backtester (that doesn’t cap you)
              </p>
              <div class="flex justify-center">
                <a
                  class="mt-3 capitalize inline-block bg-blue-light text-center font-bold text-white py-2 px-8 border border-dark-primary rounded-md"
                  >Get started</a
                >
              </div>
            </div>
          </div>
        </section>
        <section class="section py-[46px]">
          <div class="rounded-xl bg-white p-3 lg:p-6 flex flex-col gap-12">
            <div
              class="grid grid-cols-1 lg:grid-cols-2 gap-9 lg:gap-[125px] items-center p-3 lg:p-6"
            >
              <div>
                <img
                  src="/images/place1.jpeg?11"
                  loading="lazy"
                  width="510"
                  height="457"
                  class="w-[310px] h-[257px] lg:w-[510px] lg:h-[457px] rounded-xl"
                  alt="Placeholder1"
                />
              </div>
              <div class="group-even:-order-1">
                <p class="text-black text-xs font-semibold spacing-md leading-4">
                  Option Trading basics
                </p>
                <h3 class="text-black text-[32px] font-semibold leading-[41px]">
                  Option trading Glossary
                </h3>
                <p class="text-black leading-[25px]">
                  Let's be real, in the journey of options trading it can sound
                  daunting to learn about all this complicated terms like RHO,
                  Strike Prices, Iron Condors, intrinsic value, especially when we
                  are just looking to make extra profit.
                </p>
                <p class="text-black leading-[25px] mt-6">
                  Our option trading glossary not only gives you all the
                  definitions you need, but gives you examples of when to use
                  these in your actual trading activities.
                </p>
                <a href="" class="blue-button mt-8">Learn more</a>
              </div>
            </div>
            <div
              class="grid group grid-cols-1 lg:grid-cols-2 gap-9 lg:gap-[125px] items-center p-3 lg:p-6"
            >
              <div>
                <img
                  src="/images/place1.jpeg?11"
                  loading="lazy"
                  width="510"
                  height="457"
                  class="w-[310px] h-[257px] lg:w-[510px] lg:h-[457px] rounded-xl"
                  alt="Placeholder1"
                />
              </div>
              <div class="lg:group-even:-order-1">
                <p class="text-black text-xs font-semibold spacing-md leading-4">
                  Option Trading a-z guide
                </p>
                <h3 class="text-black text-[32px] font-semibold leading-[41px]">
                  Complete examples of all option strategies
                </h3>
                <p class="text-black leading-[25px]">
                  From beginner to advanced, from conservative to crazy, from cash
                  flow seeker to 10-baggers hunters, and everything in between.
                  For options there really are options for everyone (pun
                  intended).
                </p>
                <a href="" class="blue-button mt-8">Learn more</a>
              </div>
            </div>
          </div>
        </section>
      </main>
</x-front.layout>