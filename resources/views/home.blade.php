@extends('layouts.main')

@section('content')
<style type="text/css">
.gchart {
    width:50%;
    margin:10% auto;
    background:#e6e6e6;
}
#chart_wrap {
    border:1px solid gray;
    position: relative;
    padding-bottom: 100%;
    height: 0;
    overflow:hidden;
}
#chart {
    position: absolute;
    top: 0;
    left: 0;
    width:100%;
    height:100%;
}
</style>

<div class="content">
    <div class="title">Laravel 5</div>

    <div class="gchart">
	    <div id="chart_wrap">
	    	<div id="chart"></div>
	    </div>
		<p id="canvas_size"></p>
	</div>
</div>
@endsection

@section('scripts')
<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
<script type="text/javascript" src="https://www.google.com/jsapi"></script>
<script>
google.load("visualization", "1", {
    packages: ["corechart"]
});
google.setOnLoadCallback(initChart);
 
$(window).on("throttledresize", function (event) {
    initChart();
});
 
function initChart() {
    var options = {
	    legend:'none',
        width: '100%',
        height: '100%',
        pieSliceText: 'percentage',
        colors: ['#0598d8', '#f97263'],
        chartArea: {
            left: "3%",
            top: "3%",
            height: "94%",
            width: "94%"
        }
    };
 
    var data = google.visualization.arrayToDataTable([
        ['Gender', 'Overall'],
        ['M', 110],
        ['F', 20]
    ]);
    drawChart(data, options)
}
 
function drawChart(data, options) {
    var chart = new google.visualization.PieChart(document.getElementById('chart'));
    chart.draw(data, options);
}
</script>
@endsection