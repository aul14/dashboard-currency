@extends('layouts.app', ['class' => 'g-sidenav-show bg-gray-100'])

@section('content')
    @include('layouts.navbars.auth.topnav', ['title' => 'Dashboard', 'title_2' => 'Dashboard'])
    <div class="row mt-1 px-1">
        <div class="row justify-content-center my-3">
            <div class="card w-50">
                <div class="card-header pb-0 text-center">
                    <h4>Currency Converter</h4>
                </div>
                <div class="alert-message mb-2"></div>
                <div class="card-body px-0 pt-0 pb-0">
                    <input type="text" placeholder="Enter the amount to convert . . ." class="form-control amount-input" />
                    <div class="row">
                        <div class="mb-2">
                            <label for="from" class="form-label">From</label>
                            <select class="form-select from-dropdown" id="from">
                                <option disabled>Select a currency</option>
                            </select>
                        </div>
                        <div class="mb-2">
                            <label for="to" class="form-label">To</label>
                            <select class="form-select to-dropdown" id="to">
                                <option disabled>Select a currency</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <button class="btn w-100 btn-primary convert-btn">Convert</button>
                        </div>

                        <div class="mb-1">
                            <div class="alert alert-warning shadow-lg d-flex justify-content-center">
                                <div class="d-flex align-items-center">
                                    <span>
                                        <h3 class="text-bold mb-0 input-value">1.00</h3>
                                        <p class="text-sm text-center input-currency">USD</p>
                                    </span>
                                    <i class='ni ni-bold-right mx-6'></i>
                                    <span>
                                        <h3 class="text-bold mb-0 output-value">1.00</h3>
                                        <p class="text-sm text-center output-currency">IDR</p>
                                    </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <table id="conversionTable" class="table my-tableview my-table-striped table-hover w-100">
                    <thead>
                        <tr>
                            <th>Currency Code</th>
                            <th>Conversion Rate</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <div class="calendar"></div>
                <div class="box"></div>
            </div>
        </div>

    </div>
@endsection
@section('script')
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/plugins/bootstrap-datatable/js/dataTables.bootstrap4.min.js') }}"></script>

    <script>
        let CURRENCY_LIST = {
            "AED": "AE",
            "AFN": "AF",
            "XCD": "AG",
            "ALL": "AL",
            "AMD": "AM",
            "ANG": "AN",
            "AOA": "AO",
            "AQD": "AQ",
            "ARS": "AR",
            "AUD": "AU",
            "AZN": "AZ",
            "BAM": "BA",
            "BBD": "BB",
            "BDT": "BD",
            "XOF": "BE",
            "BGN": "BG",
            "BHD": "BH",
            "BIF": "BI",
            "BMD": "BM",
            "BND": "BN",
            "BOB": "BO",
            "BRL": "BR",
            "BSD": "BS",
            "NOK": "BV",
            "BWP": "BW",
            "BYR": "BY",
            "BZD": "BZ",
            "CAD": "CA",
            "CDF": "CD",
            "XAF": "CF",
            "CHF": "CH",
            "CLP": "CL",
            "CNY": "CN",
            "COP": "CO",
            "CRC": "CR",
            "CUP": "CU",
            "CVE": "CV",
            "CYP": "CY",
            "CZK": "CZ",
            "DJF": "DJ",
            "DKK": "DK",
            "DOP": "DO",
            "DZD": "DZ",
            "ECS": "EC",
            "EEK": "EE",
            "EGP": "EG",
            "ETB": "ET",
            "EUR": "FR",
            "FJD": "FJ",
            "FKP": "FK",
            "GBP": "GB",
            "GEL": "GE",
            "GGP": "GG",
            "GHS": "GH",
            "GIP": "GI",
            "GMD": "GM",
            "GNF": "GN",
            "GTQ": "GT",
            "GYD": "GY",
            "HKD": "HK",
            "HNL": "HN",
            "HRK": "HR",
            "HTG": "HT",
            "HUF": "HU",
            "IDR": "ID",
            "ILS": "IL",
            "INR": "IN",
            "IQD": "IQ",
            "IRR": "IR",
            "ISK": "IS",
            "JMD": "JM",
            "JOD": "JO",
            "JPY": "JP",
            "KES": "KE",
            "KGS": "KG",
            "KHR": "KH",
            "KMF": "KM",
            "KPW": "KP",
            "KRW": "KR",
            "KWD": "KW",
            "KYD": "KY",
            "KZT": "KZ",
            "LAK": "LA",
            "LBP": "LB",
            "LKR": "LK",
            "LRD": "LR",
            "LSL": "LS",
            "LTL": "LT",
            "LVL": "LV",
            "LYD": "LY",
            "MAD": "MA",
            "MDL": "MD",
            "MGA": "MG",
            "MKD": "MK",
            "MMK": "MM",
            "MNT": "MN",
            "MOP": "MO",
            "MRO": "MR",
            "MTL": "MT",
            "MUR": "MU",
            "MVR": "MV",
            "MWK": "MW",
            "MXN": "MX",
            "MYR": "MY",
            "MZN": "MZ",
            "NAD": "NA",
            "XPF": "NC",
            "NGN": "NG",
            "NIO": "NI",
            "NPR": "NP",
            "NZD": "NZ",
            "OMR": "OM",
            "PAB": "PA",
            "PEN": "PE",
            "PGK": "PG",
            "PHP": "PH",
            "PKR": "PK",
            "PLN": "PL",
            "PYG": "PY",
            "QAR": "QA",
            "RON": "RO",
            "RSD": "RS",
            "RUB": "RU",
            "RWF": "RW",
            "SAR": "SA",
            "SBD": "SB",
            "SCR": "SC",
            "SDG": "SD",
            "SEK": "SE",
            "SGD": "SG",
            "SKK": "SK",
            "SLL": "SL",
            "SOS": "SO",
            "SRD": "SR",
            "STD": "ST",
            "SVC": "SV",
            "SYP": "SY",
            "SZL": "SZ",
            "THB": "TH",
            "TJS": "TJ",
            "TMT": "TM",
            "TND": "TN",
            "TOP": "TO",
            "TRY": "TR",
            "TTD": "TT",
            "TWD": "TW",
            "TZS": "TZ",
            "UAH": "UA",
            "UGX": "UG",
            "USD": "US",
            "UYU": "UY",
            "UZS": "UZ",
            "VEF": "VE",
            "VND": "VN",
            "VUV": "VU",
            "YER": "YE",
            "ZAR": "ZA",
            "ZMK": "ZM",
            "ZWD": "ZW"
        }

        const amount_input = document.querySelector('.amount-input');
        const from_currency = document.querySelector('.from-dropdown');
        const to_currency = document.querySelector('.to-dropdown');
        const input_value = document.querySelector('.input-value');
        const output_value = document.querySelector('.output-value');
        const input_currency = document.querySelector('.input-currency');
        const output_currency = document.querySelector('.output-currency');
        const convert_btn = document.querySelector('.convert-btn');
        const alert_message = document.querySelector('.alert-message');


        //api url
        const API_KEY = '{{ env('API_KEY_EXCHANGERATE') }}';
        const api_url = `https://v6.exchangerate-api.com/v6/${API_KEY}/latest/`;

        window.addEventListener('load', setDefaultValues);

        $.fn.DataTable.ext.pager.numbers_length = 5;

        //values
        var from_value = '';
        var to_value = '';
        var amount = '';

        convert_btn.addEventListener('click', () => {
            from_value = from_currency.value;
            to_value = to_currency.value;
            amount = amount_input.value;
            if (amount == '' || from_value == '' || to_value == '') {
                showAlertMessage('Please fill all the fields', 'danger', 3000);
            } else if (amount == 0) {
                showAlertMessage('Please enter a valid amount', 'danger', 3000);
            } else if (from_value == to_value) {
                showAlertMessage('Please select different currencies', 'danger', 3000);
            } else {
                calculateConversion(from_value, to_value, amount);
                showAlertMessage('Conversion Successful', 'success', 3000);
            }
        });

        function formatToRupiah(amount) {
            return new Intl.NumberFormat('id-ID', {
                style: 'currency',
                currency: 'IDR'
            }).format(amount).replace('Rp', '').replace(/\,00$/, '');
        }

        //claculate the conversion
        function calculateConversion(from, to, amount) {
            const url = `${api_url}${from}`;
            fetch(url)
                .then(res => res.json())
                .then(data => {
                    const rate = data.conversion_rates[to];
                    const result = amount * rate;
                    $('#conversionTable').DataTable({
                        pagingType: 'full_numbers',
                        scrollY: "50vh",
                        scrollCollapse: true,
                        scrollX: true,
                        pageLength: 50,
                        lengthMenu: [50, 100, 200, 500],
                        destroy: true, // Destroy existing DataTable, if any
                        data: Object.entries(data.conversion_rates).map(([currencyCode, rate]) => {
                            return [currencyCode, formatToRupiah(amount * rate)];
                        }),
                        oLanguage: {
                            oPaginate: {
                                sNext: '<span class="ni ni-bold-right pgn-1" style="color: #5e72e4"></span>',
                                sPrevious: '<span class="ni ni-bold-left pgn-2" style="color: #5e72e4"></span>',
                                sFirst: '<span class="pgn-3" style="color: #5e72e4">First</span>',
                                sLast: '<span class="pgn-4" style="color: #5e72e4">Last</span>',
                            }
                        },
                        columns: [{
                                title: 'Currency Code'
                            },
                            {
                                title: 'Rate'
                            }
                        ]
                    });
                    output_value.innerHTML = formatToRupiah(result);
                    output_currency.innerHTML = to;
                    input_value.innerHTML = formatToRupiah(amount);
                    input_currency.innerHTML = from;
                });
        }

        //get the currency rates
        for ([key, value] of Object.entries(CURRENCY_LIST)) {
            from_currency.innerHTML += `<option value="${key}">${key}</option>`;
            to_currency.innerHTML += `<option value="${key}">${key}</option>`;
        }

        //set default values
        function setDefaultValues() {
            from_currency.value = 'USD';
            to_currency.value = 'IDR';
            amount_input.value = '1';
            input_value.innerHTML = '1';
            input_currency.innerHTML = 'USD';
            output_value.innerHTML = calculateConversion(from_currency.value, to_currency.value, amount_input.value);
            output_currency.innerHTML = 'IDR';
        }


        //show alert message
        function showAlertMessage(message, type, time) {
            alert_message.innerHTML = `
            <div class="alert alert-${type} alert-dismissible fade show" role="alert">
                ${message}
                <button type="button" class="btn-close" data-dismiss="alert" aria-label="Close"></button>
            </div>`;

            setTimeout(() => {
                alert_message.innerHTML = '';
            }, time);
        }
    </script>
@endsection
