@extends('layouts.clients')
@section('customcss')
    {{-- <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.1.1/flowbite.min.css" rel="stylesheet" /> --}}
    <style>
        ol,
        ul {
            padding-left: 0 !important;
        }

        .after\:content-\[\'\'\]:after {
            --tw-content: "";
            content: var(--tw-content);
        }

        .after\:border-blue-100:after {
            --tw-border-opacity: 1;
            border-color: rgb(225 239 254/var(--tw-border-opacity));
            content: var(--tw-content);
        }

        .after\:border-cyan-100:after {
            --tw-border-opacity: 1;
            border-color: rgb(147 197 253/var(--tw-border-opacity));
            content: var(--tw-content);
        }

        .after\:border-b:after {
            border-bottom-width: 1px;
            content: var(--tw-content);
        }

        .after\:border-4:after {
            border-width: 4px;
            content: var(--tw-content);
        }

        .after\:w-full:after {
            content: var(--tw-content);
            width: 100%;
        }

        .after\:h-1:after {
            content: var(--tw-content);
            height: .25rem;
        }

        .after\:inline-block:after {
            content: var(--tw-content);
            display: inline-block;
        }
    </style>
@endsection
@section('content')
    <div class="main_content">
        <div class="mcontainer">
            @livewire('clients.profile.introduction')
        </div>
    </div>
@endsection
@section('js')
    <script>
        const dateRangePickerEl = document.getElementById('dateRangePickerId');
        if (dateRangePickerEl) {
            const dateRangeValue = dateRangePickerEl.value;
            const now = new Date();
            const options = {
                accentColor: '#0090FC',
                isDark: false,
                zIndex: 9999,
                customClass: ['font-poppins'],
                onChange: (calendarify) => console.log(
                    calendarify),
                quickActions: false,
                startDate: dateRangeValue ? new Date(dateRangeValue) : now,
                locale: {
                    format: "DD-MM-YYYY",
                    lang: {
                        code: 'vn',
                        months: ["T1", "T2", "T3", "T4", "T5", "T6", "T7", "T8", "T9", "T10", "T11", "T12"],
                        weekdays: ["CN", "T2", "T3", "T4", "T5", "T6", "T7"],
                    }
                }
            }
            const calendarify = new Calendarify('#dateRangePickerId', {
                ...options
            })
            calendarify.init()
        }


        const host = "http://127.0.0.1:8000/proxy?url=https://provinces.open-api.vn/api/";

        var callAPI = (api) => {
            return $.get(api)
                .done((response) => {
                    if (response) {
                        renderData(response, "city1");
                        renderData(response, "city");
                    }
                });
        };

        callAPI('http://127.0.0.1:8000/proxy?url=https://provinces.open-api.vn/api/?depth=1');

        var callApiDistrict = (api, targetSelect) => {
            return $.get(api)
                .done((response) => {
                    if (isValidJson(response)) {
                        response = JSON.parse(response);
                    }
                    renderData(response.districts, targetSelect);
                });
        };

        function isValidJson(str) {
            try {
                JSON.parse(str);
                return true;
            } catch (e) {
                return false;
            }
        }

        var callApiWard = (api, targetSelect) => {
            return $.get(api)
                .done((response) => {
                    if (isValidJson(response)) {
                        response = JSON.parse(response);
                    }
                    renderData(response.wards, targetSelect);
                });
        };

        var renderData = (data, select) => {
            let row = '<option disabled value="" hidden>Select</option>';
            if (data && typeof data == 'string') {
                var dataArray = JSON.parse(data);
                if (Array.isArray(dataArray)) {
                    dataArray.sort((a, b) => a.name.localeCompare(b.name));
                    $.each(dataArray, function(index, element) {
                        row += '<option data-id="' + element.code + '" value="' + element.name + '">' +
                            element
                            .name + '</option>';
                    });
                }
            } else {
                $.each(data, function(index, element) {
                    row += '<option data-id="' + element.code + '" value="' + element.name + '">' +
                        element
                        .name +
                        '</option>';
                });
            }
            $("#" + select).html(row);
        };

        $("#city, #city1, #district, #district1, #ward, #ward1").change(function() {
            const selectedId = $(this).find(':selected').data('id');
            const selectName = $(this).attr("id");
            if ((selectName === "city" || selectName === "city1") && selectedId) {
                callApiDistrict(host + "p/" + selectedId + "?depth=2", selectName === "city" ? "district" :
                    "district1");
            } else if ((selectName === "district" || selectName === "district1") && selectedId) {
                callApiWard(host + "d/" + selectedId + "?depth=2", selectName === "district" ? "ward" :
                    "ward1");
            }
        });
    </script>
@endsection
