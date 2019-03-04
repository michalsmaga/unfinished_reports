@extends('layouts.app')

@section('content')

<div class="container" style="max-width: 1800px;" xmlns="http://www.w3.org/1999/html"
     xmlns="http://www.w3.org/1999/html">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">

<!--                FIRST PAGE-->

                @if (isset($info))

                    <h3>{{ $info }}</h3>
                    <a href="{{ url('/home') }}" class="btn btn-xs btn-info pull-right">Back</a>

                @else

                <div class="card-header">{{ $report_name }}</div>

                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Vessel Name: {{ $vessel->name }}</div>
                    <div class="card-header" style="float:left;">VMS unit ID No.: XXXXXXXX</div>
                    <div class="card-header" style="float:left;">VMS Type: {{ $vessel->device }}</div>
                    <div class="card-header" style="float:left;">Area No.: XXXXXXXXXX</div>
                </div>

                <div id="mapid" style="height: 500px;">

                </div>

                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Period: {{ $date_from }} SAST - {{ $date_to }} SAST</div>
                </div>
                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Voyage start: {{ $voyage_start }} SAST</div>
                    <div class="card-header" style="float:left;">Total time underway: {{ $total_time_underway }} </div>
                </div>
                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Voyage end: {{ $voyage_end }} SAST</div>
                    <div class="card-header" style="float:left;">Time stationary: {{ $stops_total_time }} </div>
                </div>
                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Voyage length: {{ $distance }} </div>
                    <div class="card-header" style="float:left;">No. of stops: {{ $stops_over_10_minutes }}</div>
                </div>

                @if ($image !== 'NULL')

                    <div id="image" style="padding:5px; position:absolute; top:400px; left:620px; height:400px; width:400px; z-index:1000; background-color: white; border-style: solid; border-width: 1px; border-color: grey;">
                        <img src="{{ $image }}" alt="Vessel image" width="390" height="390">
                    </div>

                @endif



<!--                SECOND PAGE-->

                <br><br><br><br>

<!--                Following 4 lines are repeated from first page-->

                <div style="display: inline;">
                    <div class="card-header" style="float:left;">Vessel Name: {{ $vessel->name }}</div>
                    <div class="card-header" style="float:left;">VMS unit ID No.: XXXXXXXX</div>
                    <div class="card-header" style="float:left;">VMS Type: {{ $vessel->device }}</div>
                    <div class="card-header" style="float:left;">Area No.: XXXXXXXXXX</div>
                </div>

                <table border="1" style="text-align: center;">
                    <thead>
                        <tr>
                            <th>Data point</th>
                            <th>Date/Time SAST</th>
                            <th colspan="2">
                                <table border="1">
                                    <tr>
                                        <th colspan="2">Position</th>
                                    </tr>
                                    <tr>
                                        <th>Latitude</th>
                                        <th>Longitude</th>
                                    </tr>
                                </table>
                            </th>
                            <th>Course True Bearing</th>
                            <th>Distance NM from Previous Position</th>
                            <th>Speed Knots</th>
                            <th>VMS Power Status</th>
                        </tr>
                    <thead>

                        @foreach($points as $no => $point)

                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $point->dt_tracker }}</td>
                                <td>{{ $point->lat_ddm['deg'] }}&#176;{{ $point->lat_ddm['min'] }}{{ $point->lat_ddm['abbreviation'] }}'</td>
                                <td>{{ $point->lng_ddm['deg'] }}&#176;{{ $point->lng_ddm['min'] }}{{ $point->lng_ddm['abbreviation'] }}'</td>
                                <td>{{ $point->angle }}</td>
                                <td>{{ $point->distance }}</td>
                                <td>{{ $point->speed }}</td>
                                <td>ON</td>
                            </tr>

                        @endforeach

                </table>



                <div class="card-header">* All speeds are actual at the date and time of the position/data point.</div>
                <div class="card-header">** All times displayed are local SAST time (UCT+2).</div>

<!--                THIRD PAGE-->

                <div style="height:800px; width:1200px; background-color: white; border-style: solid; border-width: 1px; border-color: grey;">
                    <h3>Operators Entries:</h3>

                </div>

                <script language="JavaScript">

                    //                    PAST A MAP

                    var mymap = L.map('mapid').setView([50.000, 0.00], 13);
                    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token={accessToken}', {
                        attribution: 'Map data &copy; <a href="https://www.openstreetmap.org/">OpenStreetMap</a> contributors, <a href="https://creativecommons.org/licenses/by-sa/2.0/">CC-BY-SA</a>, Imagery © <a href="https://www.mapbox.com/">Mapbox</a>',
                        maxZoom: 18,
                        id: 'mapbox.streets',
                        accessToken: 'pk.eyJ1IjoibWljaGFsc21hZ2EiLCJhIjoiY2pzbjFkN2dkMDZ3czN6cXhtbXV1OWYzZSJ9.gdLwOgcUfye6XONfclzBDA'
                    }).addTo(mymap);

                    //                    DRAW A LINE

                    var points = [];

                    @foreach($points as $no => $point)

                        var point_{{ $no }} = new L.LatLng({{ $point->lat }}, {{ $point->lng }});

                        points.push(point_{{ $no }});

                        var circle = L.circle([{{ $point->lat }}, {{ $point->lng }}], {
                            color: 'red',
                            fillColor: '#f03',
                            fillOpacity: 1,
                            radius: 10
                        }).bindTooltip("{{ $no }}", {permanent: true, className: "my-label", offset: [0, 0] }).addTo(mymap);

                    @endforeach

                    var firstpolyline = new L.Polyline(points, {
                        color: 'red',
                        weight: 3,
                        opacity: 0.5,
                        smoothFactor: 1
                    });
                    firstpolyline.addTo(mymap);
                    var bounds = new L.LatLngBounds(points);
                    mymap.fitBounds(bounds);

//                    NOW PRINT PAGE AS PDF

                    function printPDF() {
                        var doc = new jsPDF();
                        var source = window.document.getElementsByTagName("body")[0];
                        doc.fromHTML(
                            source,
                            15,
                            15,
                        );

                        doc.output("dataurlnewwindow");
                    }

                </script>

                <input type="button" onclick="printPDF()" value="PRINT PDF"/>
                <a href="{{ url('/home') }}" class="btn btn-xs btn-info pull-right">Back</a>

                @endif

            </div>
        </div>
    </div>
</div>
@endsection
